<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\ClassModal;
use App\Models\Department;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\ClassRoutine;
use App\Models\ExamList;
use App\Models\ExamSchedule;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\SessionModel;
use App\Models\Student;
use App\Models\Syllabus;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TeacherAdditionalInfo;
use Intervention\Image\Facades\Image;

use App\Traits\UserRollPermissionTrait;
use App\Traits\ReuseSectionComponentTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BackendController extends Controller
{
    use UserRollPermissionTrait;
    use ReuseSectionComponentTrait;

    public function __construct()
    {
        $this->module_name = 'users';
    }

    /*=========================================================
                    User Section
    ===========================================================*/


    public function admin_parent_search(Request $request)
    {
        $data = User::where('user_role', 4)->where('name', 'LIKE', $request->parent_name . '%')->get();
        // dd($data);
        $output = '';
        if (count($data) > 0) {
            $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
            foreach ($data as $row) {
                $output .= '<li class="list-group-item" data-id="' . $row->id . '">' . $row->name . '</li>';
            }
            $output .= '</ul>';
        } else {
            $output .= '<li class="list-group-item">' . 'No Data Found' . '</li>';
        }
        return $output;
    }
    protected function auto_classload_for_adduser($checked = null)
    {
        $classes = ClassModal::get();
        $departments = Department::get();
        return view('backend.dashboard.adduser_response', [
            'classes' => $classes,
            'checked' => $checked,
            'departments' => $departments,
        ]);
    }
    public function index()
    {
        // dd(11);
        $classes = ClassModal::get();
        $departments = Department::get();
        $sections = Section::get();
        $subjects = Subject::get();
        $classrooms = Classroom::get();
        $teachers = User::where('user_role', 6)->get();
        $exam_lists = ExamList::get();
        $feetypes = FeeType::get();
        $sessions = SessionModel::get();

        $students = User::where('user_role', 4)->count();
        $parents = User::where('user_role', 5)->count();
        $staff = User::where('user_role', 7)->count();
        $operators = User::where('user_role', 8)->count();


        return view('backend.index',
            compact('classes', 'departments', 'sections', 'subjects', 'classrooms',
             'teachers', 'exam_lists', 'feetypes', 'sessions', 'students', 'parents', 'staff', 'operators'),
        );
    }
    public function add_user_modal()
    {
        return $this->auto_classload_for_adduser(1);
    }
    public function admin_save_class(Request $request)
    {
        $this->reuse_class($request);
        return $this->auto_classload_for_adduser(2);
    }
    public function admin_save_parent(Request $request)
    {
        //create_parent_user
        $this->create_parent_user($request);
        return $this->auto_classload_for_adduser(2);
    }
    public function admin_save_section(Request $request)
    {
        $this->reuse_section($request);
        return $this->auto_classload_for_adduser(2);
    }
    public function admin_save_student(Request $request)
    {
        //create_student_user
        $this->create_student_user($request);
        return response()->json('Student inserted successfully!!');
        // return $this->auto_classload_for_adduser(2);
    }
    protected function departmentImageUpload($request)
    {
        // echo 11; die();
        $departmentImage = $request->file('department_image');

        $image = Image::make($departmentImage);
        $fileType = $departmentImage->getClientOriginalExtension();
        $imageName = 'department_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/department/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        $thumbnailOne = $directory . "thumbnail/200x200/" . $imageName;
        $image->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnailOne);

        $thumbnailTwo = $directory . "thumbnail/600x600/" . $imageName;
        $image->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnailTwo);

        return $imageName;
    }
    public function admin_save_department(Request $request)
    {

        $request->validate([
            'department_name' => 'required|unique:departments,department_name',
            'description' => 'required',
            'department_image' => 'file|max:2048|dimensions:max_width=1024,max_height=1024',
        ]);

        // dd($_POST);

        $department = new Department();
        $department->department_name = $request->department_name;
        $department->description = $request->description;
        $department->department_image =  $this->departmentImageUpload($request);
        $department->department_status = $request->department_status;

        // dd($department);

        $department->save();

        return response()->json(['success' => 'Department has been added successfully !!']);
    }
    public function admin_save_teacher(Request $request)
    {
        //create_teacher_user
        $this->create_teacher_user($request);
        return $this->auto_classload_for_adduser();
    }
    public function admin_save_staff(Request $request)
    {
        //create_staff_user
        $this->create_staff_user($request);
        return $this->auto_classload_for_adduser();
    }
    public function admin_save_operator(Request $request)
    {
        //create_operator_user
        $this->create_operator_user($request);
        return $this->auto_classload_for_adduser();
    }

    /*=========================================================
                    Attendence Section
    ===========================================================*/

    public function admin_showstudent_attendencelist(Request $request)
    {

        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'attendence_date' => 'required',
        ]);

        $attendence_date = $request->attendence_date;
        $newDate = date('Y-m-d', strtotime($attendence_date . ' - 6 days'));
        $class_id = $request->class_id;
        $section_id = $request->section_id;

        $students = Student::with(['student_single_attendence' => function ($q) use ($attendence_date, $newDate) {
            $q->where('attendence_date', $attendence_date);
        }])->with(['student_attendence' => function ($q) use ($attendence_date, $newDate) {
            $q->where('attendence_date', '<=', $attendence_date)
                ->where('attendence_date', '>=', $newDate)
                ->orderBy('attendence_date', 'asc');
        }])->where(['class_id' => $class_id, 'section_id' => $section_id])->get();

        return view('backend.attendence.student.student_attendence_list_data', compact('students', 'attendence_date'));
    }
    public function admin_showteacher_attendencelist(Request $request)
    {
        $attendence_date = $request->attendence_date;
        $newDate = date('Y-m-d', strtotime($attendence_date . ' - 6 days'));

        $teachers = TeacherAdditionalInfo::with(
            ['teacher_single_attendence' => function ($q) use ($attendence_date, $newDate) {
                $q->where('attendence_date', $attendence_date);
            }]
        )->with([
            'teacher_attendence' => function ($q) use ($attendence_date, $newDate) {
                $q->where('attendence_date', '<=', $attendence_date)
                    ->where('attendence_date', '>=', $newDate)
                    ->orderBy('attendence_date', 'asc');
            }
        ])->get();

        // dd($teachers);

        return view('backend.attendence.teacher.teacher_attendence_list_data', compact('teachers', 'attendence_date'));
    }

    /*=========================================================
                    Class Routine Section
    ===========================================================*/
    public function open_routine_modal()
    {
        $classroutines = ClassRoutine::with('subject', 'teacher', 'room')->get();
        $classes = ClassModal::get();
        $sections = Section::get();
        $teachers = User::where('user_role', 6)->get();
        $subjects = Subject::get();
        $classrooms = Classroom::get();
        // dd($subjects);
        return view('backend.dashboard.routine_response', [
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'classrooms' => $classrooms,
            'classroutines' => $classroutines,
        ]);
    }
    public function add_routine_class(Request $request)
    {
        $this->reuse_class($request);
        return $this->open_routine_modal();
    }
    public function add_routine_section(Request $request)
    {
        // dd($_POST);
        $this->reuse_section($request);
        // return $this->section_response();
        return $this->open_routine_modal();
    }
    public function admin_save_subject(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_name' => 'required',
            'subject_code' => 'required',
        ]);
        Subject::create($request->all());
        return $this->open_routine_modal();
    }
    public function admin_save_classroom(Request $request)
    {
        $this->reuse_classroom($request);
        return $this->open_routine_modal();
    }
    public function routine_save_teacher(Request $request)
    {
        //create_teacher_user
        $this->create_teacher_user($request);
        return $this->open_routine_modal();
    }
    /*=========================================================
                    Exam Schedule Section
    ===========================================================*/
    
    public function open_examschedule_modal()
    {
        $exam_lists = ExamList::get();
        $classes = ClassModal::get();
        $classrooms = Classroom::get();
        $subjects = Subject::get();
        return view('backend.dashboard.exam_schedule_response', [
            'classes' => $classes,
            'subjects' => $subjects,
            'exam_lists' => $exam_lists,
            'classrooms' => $classrooms,
        ]);
    }
    public function exam_save_examschedule(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'note' => 'required'
        ]);
        
        // dd($_POST);
        ExamList::create($request->all());
        return $this->open_examschedule_modal();
    }
    public function class_save_examschedule(Request $request)
    {
        $this->reuse_class($request);
        return $this->open_examschedule_modal();
    }
    public function save_examschedule_section(Request $request)
    {
        // dd($_POST);
        $this->reuse_section($request);
        return $this->open_examschedule_modal();
    }
    public function classroom_save_examschedule(Request $request)
    {
        $this->reuse_classroom($request);
        return $this->open_examschedule_modal();
    }
    public function save_examschedule_subject(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_name' => 'required',
            'subject_code' => 'required',
        ]);
        // dd($_POST);
        Subject::create($request->all());
        return $this->open_examschedule_modal();
    }
    public function save_examschedule_info(Request $request)
    {
        $request->validate([
            'exam_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'class_room_id' => 'required',
            'subject_id' => 'required',
            'exam_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        ExamSchedule::create($request->all());
        return $this->open_examschedule_modal();
    }

    /*=========================================================
                    Syllabus Section
    ===========================================================*/
    public function open_syllabus_modal()
    {
        $classes = ClassModal::get();
        $sections = Section::get();
        $subjects = Subject::get();
        return view('backend.dashboard.syllabus_response', [
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
        ]);
    }
    public function save_syllabus_class(Request $request)
    {
        $this->reuse_class($request);
        return $this->open_syllabus_modal();
    }
    public function save_syllabus_section(Request $request)
    {
        $this->reuse_section($request);
        return $this->open_syllabus_modal();
    }
    public function save_syllabus_subject(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_name' => 'required',
            'subject_code' => 'required',
        ]);
        // dd($_POST);
        Subject::create($request->all());
        return $this->open_syllabus_modal();
    }

    protected function syllabusImageUpload($request, $syllabusId){
        $syllabusImages = $request->file('syllabus_image');

        if ($request->hasFile('syllabus_image')) {
            foreach($syllabusImages as $image){
                $name = 'syllabus_'.time().'_'.rand(10000, 999999).'.'.$image->extension();
                $image->move(public_path().'/images/syllabus_image/', $name);
                
                DB::table('syllabus_images')->insert([
                    'syllabus_id' => $syllabusId,
                    'syllabus_images' => $name,
                ]);
            }
        }
    }
    public function save_syllabus_info(Request $request){

        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'syllabus_title' => 'required',
            // 'syllabus_image' => 'required|mimes:doc,docx,pdf',
        ]);

        // dd($_POST);

        
        $syllabus = new Syllabus();
        $syllabus->syllabus_title = $request->syllabus_title;
        $syllabus->class_id = $request->class_id;
        $syllabus->section_id = $request->section_id;
        $syllabus->subject_id = $request->subject_id;
        $syllabus->save();

        $this->syllabusImageUpload($request, $syllabus->id);
        return $this->open_syllabus_modal();
    }

    /*=========================================================
                    Feetype Section
    ===========================================================*/
    
    public function open_fee_modal(){
        $classes = ClassModal::get();
        $sections = Section::get();
        $subjects = Subject::get();
        $feetypes = FeeType::get();

        return view('backend.dashboard.fee_response', [
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
            'feetypes' => $feetypes,
        ]);
    }
    public function save_fee_class(Request $request){
        $this->reuse_class($request);
        return $this->open_fee_modal();
    }
    public function save_fee_feetype(Request $request){
        $this->reuse_feetype($request);
        return $this->open_fee_modal();
    }
    public function save_fee_section(Request $request){
        $this->reuse_section($request);
        return $this->open_fee_modal();
    }
    public function save_feebasic_info(Request $request){
        $this->reuse_fee($request);
        return $this->open_fee_modal();
    }
    public function class_response(){
        return view('backend.dashboard.class_response');
    }
    public function section_response(){
        $classes = ClassModal::get();
        return view('backend.dashboard.section_response', [
            'classes' => $classes,
        ]);
    }
    public function user_save_class(Request $request){
        $this->reuse_class($request);
        return $this->section_response();
    }
    public function admin_routine_class(Request $request){
        // dd($_POST);
        $this->reuse_class($request);
        return $this->section_response();
    }
    public function exam_schedule_class(Request $request){
        // dd($_POST);
        $this->reuse_class($request);
        return $this->section_response();
    }
    public function add_syllabus_class(Request $request){
        // dd($_POST);
        $this->reuse_class($request);
        return $this->section_response();
    }
    public function add_fee_class(Request $request){
        // dd($_POST);
        $this->reuse_class($request);
        return $this->section_response();
    }

}
