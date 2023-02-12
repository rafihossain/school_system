<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\ClassModal;
use App\Models\ClassRoutine;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Classteacher;
use App\Models\Department;
use App\Models\Designation;
use App\Models\HomeworkModel;
use App\Models\Section;
use App\Models\SessionModel;
use App\Models\Subject;
use App\Models\Subjectclass;
use App\Models\Syllabus;
use App\Models\Teacher;
use Illuminate\Http\Request;
use File;
use Image;

class SettingController extends Controller
{

    function __construct(){
        $this->middleware('role:super admin|admin|manager|parent|student|teacher|staff');
    }

    //Designations
    public function manage_designation(){
        $designations = Designation::where('designation_status', 1)->get();
        // dd($designations);

        return view('backend.settings.designation.manage_designation', [
            'designations' => $designations
        ]);
    }
    public function add_designation(){
        return view('backend.settings.designation.add_designation');
    }
    public function save_designation(Request $request){

        $request->validate([
            'designation_name' => 'required|unique:designations,designation_name',
            'designation_short_name' => 'required|unique:designations,designation_short_name',
            'description' => 'required',
        ]);

        // dd($_POST);
        
        $designation = new Designation();
        $designation->designation_name = $request->designation_name;
        $designation->designation_short_name = $request->designation_short_name;
        $designation->description = $request->description;
        $designation->designation_status = $request->designation_status;
        $designation->save();

        return redirect()->route('backend.manage-designation')->with('success', 'Designation has been added successfully !!');
    }
    public function edit_designation($id){
        $designation = Designation::find($id);
        return view('backend.settings.designation.edit_designation', [
            'designation' => $designation
        ]);
    }
    public function update_designation(Request $request){

        $designation = Designation::find($request->id);

        if($designation->designation_name == $request->designation_name || 
            $designation->designation_short_name == $request->designation_short_name){
            $request->validate([
                'designation_name' => 'required',
                'designation_short_name' => 'required',
                'description' => 'required',
            ]);
        }else{
            $request->validate([
                'designation_name' => 'required|unique:designations,designation_name',
                'designation_short_name' => 'required|unique:designations,designation_short_name',
                'description' => 'required',
            ]);
        }

        // dd($_POST);
        
        // $designation = Designation::find($request->id);
        $designation->designation_name = $request->designation_name;
        $designation->designation_short_name = $request->designation_short_name;
        $designation->description = $request->description;
        $designation->designation_status = $request->designation_status;
        $designation->save();

        return redirect()->route('backend.manage-designation')->with('success', 'Designation has been updated successfully !!');
    }
    public function delete_designation($id){
        // dd($_POST);
        $designation = Designation::find($id);
        $designation->designation_status = 0;
        $designation->save();

        return redirect()->route('backend.manage-designation')->with('success', 'Designation has been deleted successfully !!');
    }
    public function designation_archive_list(){

        $designations = Designation::where('designation_status', 0)->get();
        // dd($designations);

        return view('backend.settings.designation.archive_designation', [
            'designations' => $designations
        ]);
    }
    public function designation_restore($id){

        $designation = Designation::find($id);
        $designation->designation_status = 1;
        $designation->save();

        return redirect()->route('backend.manage-designation')->with('success', 'Designation restore successfully !!');
    }

    //Department
    public function manage_department(){
        $departments = Department::where('department_status', 1)->get();
        // dd($departments);

        return view('backend.settings.department.manage_department', [
            'departments' => $departments
        ]);
    }
    public function add_department(){
        return view('backend.settings.department.add_department');
    }
    protected function departmentImageUpload($request){
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
    public function save_department(Request $request){

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

        return redirect()->route('backend.manage-department')->with('success', 'Department has been added successfully !!');
    }
    public function edit_department($id){
        $department = Department::find($id);
        return view('backend.settings.department.edit_department', [
            'department' => $department
        ]);
    }
    public function departmentBasicInfo($request, $department, $imageUrl = null){
        $department->department_name = $request->department_name;

        if($imageUrl !=''){
            $department->department_image = $imageUrl;
        }
        
        $department->description = $request->description;
        $department->department_status = $request->department_status;
        $department->save();
    }
    public function update_department(Request $request){

        $departmentImage = $request->file('department_image');
        $department = Department::find($request->id);

        if($department->department_name == $request->department_name){
            $request->validate([
                'department_name' => 'required',
                'description' => 'required',
            ]);
        }else{
            $request->validate([
                'department_name' => 'required|unique:departments,department_name',
                'description' => 'required',
            ]);
        }

        if($departmentImage){
            if (File::exists($department->department_image)) {
                unlink($department->department_image);
            }
            $imageUrl = $this->departmentImageUpload($request);
            $this->departmentBasicInfo($request, $department, $imageUrl);
        }else{
            $this->departmentBasicInfo($request, $department);
        }

        return redirect()->route('backend.manage-department')->with('success', 'Department has been updated successfully !!');
    }
    public function delete_department($id){
        // dd($_POST);
        $department = Department::find($id);
        $department->department_status = 0;
        $department->save();

        return redirect()->route('backend.manage-department')->with('success', 'Department has been deleted successfully !!');
    }
    public function department_archive_list(){

        $departments = Department::where('department_status', 0)->get();
        // dd($departments);

        return view('backend.settings.department.archive_department', [
            'departments' => $departments
        ]);
    }
    public function department_restore($id){

        $designation = Department::find($id);
        $designation->department_status = 1;
        $designation->save();

        return redirect()->route('backend.manage-department')->with('success', 'Department restore successfully !!');
    }

    //Session
    public function manage_session(){
        // dd(11);

        $sessions = SessionModel::get();
        // dd($designations);

        return view('backend.settings.session.manage_session', [
            'sessions' => $sessions
        ]);
    }
    public function add_session(){
        return view('backend.settings.session.add_session');
    }
    public function save_session(Request $request){

        $request->validate([
            'session_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // dd($_POST);
        
        $session = new SessionModel();
        $session->session_name = $request->session_name;
        $session->start_date = $request->start_date;
        $session->end_date = $request->end_date;
        $session->save();

        return redirect()->route('backend.manage-session')->with('success', 'Session has been added successfully !!');
    }
    public function edit_session($id){
        $session = SessionModel::find($id);
        // dd($session);

        return view('backend.settings.session.edit_session', [
            'session' => $session
        ]);
    }
    public function update_session(Request $request){

        $request->validate([
            'session_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // dd($_POST);
        
        $session = SessionModel::find($request->id);
        $session->session_name = $request->session_name;
        $session->start_date = $request->start_date;
        $session->end_date = $request->end_date;
        $session->save();

        return redirect()->route('backend.manage-session')->with('success', 'Session has been updated successfully !!');
    }

    public function delete_session($id){
        // dd($_POST);
        $session = SessionModel::find($id);
        $session->delete();

        return redirect()->route('backend.manage-session')->with('success', 'Session has been deleted successfully !!');
    }

    //class
    public function manage_class(){
        $classes = ClassModal::with('session')->get();
        return view('backend.settings.class.manage_class', [
            'classes' => $classes
        ]);
    }
    public function add_class(){
        return view('backend.settings.class.add_class');
    }
    public function save_class(Request $request){


        $request->validate([
            'class_name' => 'required',
            'class_numeric' => 'required',
        ]);

        // dd($_POST);
        
        $class = new ClassModal();
        $class->session_id = Session::get('session_id');
        $class->class_name = $request->class_name;
        $class->class_numeric = $request->class_numeric;
        $class->class_status = $request->class_status;
        $class->save();

        return redirect()->route('backend.manage-class')->with('success', 'Class has been added successfully !!');
    }
    public function edit_class($id){

        // dd(11);
        $class = ClassModal::with('session')->find($id);
        return view('backend.settings.class.edit_class', [
            'class' => $class
        ]);

    }
    public function update_class(Request $request){

        $request->validate([
            'class_name' => 'required',
            'class_numeric' => 'required',
        ]);

        // dd($_POST);

        $class = ClassModal::find($request->id);
        $class->class_name = $request->class_name;
        $class->class_numeric = $request->class_numeric;
        $class->class_status = $request->class_status;
        $class->save();

        return redirect()->route('backend.manage-class')->with('success', 'Class has been updated successfully !!');
    }

    public function delete_class($id){
        $class = ClassModal::find($id);
        $class->class_status = 0;
        $class->save();
        return redirect()->route('backend.manage-class')->with('success', 'Class has been deleted successfully !!');
    }

    public function class_archive_list(){

        $classes = ClassModal::where('class_status', 0)->get();
        // dd($departments);

        return view('backend.settings.class.archive_class', [
            'classes' => $classes
        ]);
    }
    
    public function class_restore($id){

        $class = ClassModal::find($id);
        $class->class_status = 1;
        $class->save();

        return redirect()->route('backend.manage-class')->with('success', 'Class restore successfully !!');
    }

    //Sections
    public function manage_section(){
        $sections = Section::with('class')->get();
        // dd($sections);

        return view('backend.settings.section.manage_section', [
            'sections' => $sections
        ]);
    }
    public function add_section(){
        $classes = ClassModal::get();
        return view('backend.settings.section.add_section', [
            'classes' => $classes,
        ]);
    }
    public function save_section(Request $request){

        $request->validate([
            'section_name' => 'required',
            'section_capacity' => 'required',
            'class_id' => 'required',
        ]);

        // dd($_POST);
        
        $section = new Section();
        $section->class_id = $request->class_id;
        $section->section_name = $request->section_name;
        $section->section_capacity = $request->section_capacity;
        $section->save();

        return redirect()->route('backend.manage-section')->with('success', 'Section has been added successfully !!');
    }
    public function edit_section($id){
        $section = Section::with('class')->find($id);
        $classes = ClassModal::get();
        // dd($section);

        return view('backend.settings.section.edit_section', [
            'section' => $section,
            'classes' => $classes,
        ]);
    }
    public function update_section(Request $request){

        $request->validate([
            'section_name' => 'required',
            'section_capacity' => 'required',
            'class_id' => 'required',
        ]);

        // dd($_POST);

        $section = Section::find($request->id);
        $section->class_id = $request->class_id;
        $section->section_name = $request->section_name;
        $section->section_capacity = $request->section_capacity;
        $section->save();

        return redirect()->route('backend.manage-section')->with('success', 'Section has been updated successfully !!');
    }

    public function delete_section($id){
        $section = Section::find($id);
        $section->delete();

        return redirect()->route('backend.manage-section')->with('success', 'Section has been deleted successfully !!');
    }

    //classroom
    public function manage_classroom(){
        $classrooms = Classroom::get();
        // dd($sections);

        return view('backend.settings.classroom.manage_classroom', [
            'classrooms' => $classrooms
        ]);
    }
    public function add_classroom(){
        return view('backend.settings.classroom.add_classroom');
    }
    public function save_classroom(Request $request){

        $request->validate([
            'classroom_name' => 'required',
            'classroom_description' => 'required',
        ]);

        // dd($_POST);
        
        $classroom = new Classroom();
        $classroom->classroom_name = $request->classroom_name;
        $classroom->classroom_description = $request->classroom_description;
        $classroom->save();

        return redirect()->route('backend.manage-classroom')->with('success', 'Classroom has been added successfully !!');
    }
    public function edit_classroom($id){
        $classroom = Classroom::find($id);
        // dd($section);

        return view('backend.settings.classroom.edit_classroom', [
            'classroom' => $classroom,
        ]);
    }
    public function update_classroom(Request $request){

        $request->validate([
            'classroom_name' => 'required',
            'classroom_description' => 'required',
        ]);

        // dd($_POST);

        $classroom = Classroom::find($request->id);
        $classroom->classroom_name = $request->classroom_name;
        $classroom->classroom_description = $request->classroom_description;
        $classroom->save();

        return redirect()->route('backend.manage-classroom')->with('success', 'Classroom has been updated successfully !!');
    }
    public function delete_classroom($id){
        $classroom = Classroom::find($id);
        $classroom->delete();

        return redirect()->route('backend.manage-classroom')->with('success', 'Classroom has been deleted successfully !!');
    }

    //subject
    public function manage_subject(){
        $subjects = Subject::get();
        // dd($sections);

        return view('backend.settings.subject.manage_subject', [
            'subjects' => $subjects
        ]);
    }
    public function add_subject(){
        $classes = ClassModal::get();
        // dd($subjects);
        return view('backend.settings.subject.add_subject', [
            'classes' => $classes
        ]);
    }
    private function subjectValidate($request){
        
        $request->validate([
            'class_id'=>'required',
            'subject_name' => 'required',
            'subject_code' => 'required',
        ]);
    }
    
    public function save_subject(Request $request){

       $this->subjectValidate($request);
        Subject::create($request->all());

        return redirect()->route('backend.manage-subject')->with('success', 'Subject has been added successfully !!');
    }
    public function edit_subject($id){
        $subject = Subject::find($id);

        return view('backend.settings.subject.edit_subject', [
            'subject' => $subject,
        ]);
    }
    public function update_subject(Request $request){

        $request->validate([
            'subject_name' => 'required',
            'subject_code' => 'required',
        ]);

        // dd($_POST);

        $subject = Subject::find($request->id);
        $subject->subject_name = $request->subject_name;
        $subject->subject_code = $request->subject_code;
        $subject->save();

        return redirect()->route('backend.manage-subject')->with('success', 'Subject has been updated successfully !!');
    }
    public function delete_subject($id){
        $subject = Subject::find($id);
        $subject->delete();

        return redirect()->route('backend.manage-subject')->with('success', 'Subject has been deleted successfully !!');
    }

    //subject-class
    public function manage_subject_class(){
        $sections = Section::get();
        // dd($subjects);
        return view('backend.settings.subject_class.manage_subject_class', [
            'sections' => $sections
        ]);
    }
    public function add_subject_class(){
        $sections = Section::get();
        $classes = ClassModal::get();
        // dd($classes);

        return view('backend.settings.subject_class.add_subject_class',[
            'classes' => $classes,
            'sections' => $sections,
        ]);
    }
    public function get_section_info(Request $request){
        $sections = Section::where('class_id', $request->section_id)->get();
        // dd($section);
        echo json_encode($sections);
    }
    public function get_subject_info(Request $request){
        // $subjects = Subject::where('section_id', $request->subject_id)->get();
        $subjects = Subject::where('class_id', $request->subject_id)->get();
        // dd($subjects);
        echo json_encode($subjects);
    }
    public function subject_info(Request $request){

        // dd($_POST);

        foreach ($request->subject_name as $key => $subject) {
            $subject_class = new Subjectclass();
            $subject_class->subject_name = $subject;
            $subject_class->section_id = $request->section_id[$key];
            $subject_class->subject_code = $request->subject_code[$key];
            $subject_class->total_mark = $request->total_mark[$key];
            $subject_class->theory_mark = $request->theory_mark[$key];
            $subject_class->practical_mark = $request->practical_mark[$key];
            $subject_class->city_exam_mark = $request->city_exam_mark[$key];
            $subject_class->diary = $request->diary[$key];
            $subject_class->save();
        }

        // $subjects = Subject::where('section_id', $request->subject_id)->get();
        echo json_encode('succuss');
    }
    public function save_subject_class(Request $request){

        $request->validate([
            'subject_name' => 'required',
            'subject_code' => 'required',
        ]);

        // dd($_POST);
        
        $subject_class = new Subjectclass();
        $subject_class->subject_name = $request->subject_name;
        $subject_class->subject_code = $request->subject_code;
        $subject_class->save();

        return redirect()->route('backend.manage-subject-class')->with('success', 'Subject class has been added successfully !!');
    }
    public function edit_subject_class($id){
        $subject_classes = Subjectclass::where('section_id',$id)->get();
        // dd($subject_class);

        return view('backend.settings.subject_class.edit_subject_class', [
            'subject_classes' => $subject_classes,
        ]);
    }
    public function update_subject_class(Request $request){
        // dd($_POST);

        foreach ($request->subject_name as $key => $subject) {
            // dd($request->section_id[$key]);

            $subjectclass = Subjectclass::where('section_id',$request->section_id[$key])->first();
            if ($subjectclass != null) {
                $subjectclass->delete();
            }

            $subject_class = new Subjectclass();
            $subject_class->subject_name = $subject;
            $subject_class->section_id = $request->section_id[$key];
            $subject_class->subject_code = $request->subject_code[$key];
            $subject_class->total_mark = $request->total_mark[$key];
            $subject_class->theory_mark = $request->theory_mark[$key];
            $subject_class->practical_mark = $request->practical_mark[$key];
            $subject_class->city_exam_mark = $request->city_exam_mark[$key];
            $subject_class->diary = $request->diary[$key];

            // dd($subject_class);

            $subject_class->save();

        }

        return redirect()->route('backend.manage-subject-class')->with('success', 'Subject class has been updated successfully !!');
    }
    public function delete_subject_class($id){
        $subject_class = Subjectclass::find($id);
        $subject_class->delete();

        return redirect()->route('backend.manage-subject-class')->with('success', 'Subject class has been deleted successfully !!');
    }


    //subject
    public function manage_class_teacher(){
        // dd(11);

        $classteachers = Classteacher::with('class','section','teacher')->get();
        //dd($classteachers);

        return view('backend.settings.class_teacher.manage_teacher_class', [
            'classteachers' => $classteachers
        ]);
    }
    public function add_class_teacher(){
        $classes = ClassModal::get();
        $sections = Section::get();
        $teachers = User::where('user_role', 6)->get();
        // dd($subjects);
        return view('backend.settings.class_teacher.add_teacher_class', [
            'classes' => $classes,
            'sections' => $sections,
            'teachers' => $teachers,
        ]);
    }
    public function save_class_teacher(Request $request){

        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'teacher_id' => 'required',
        ]);

        $data = $request->except('_token');
        Classteacher::create($data);

        return redirect()->route('backend.manage-class-teacher')
        ->with('success', 'Teacher class has been added successfully !!');
    }
    public function edit_class_teacher($id){

        $classes = ClassModal::get();
        $sections = Section::get();
        $teachers = Teacher::get();
        $classteacher = Classteacher::with('class','section','teacher')->find($id);
        // dd($classteacher);

        return view('backend.settings.class_teacher.edit_teacher_class', [
            'classes' => $classes,
            'sections' => $sections,
            'teachers' => $teachers,
            'classteacher' => $classteacher,
        ]);
    }
    public function update_class_teacher(Request $request){

        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'teacher_id' => 'required',
        ]);

        // dd($_POST);
        $classteacher = Classteacher::find($request->id);
        $classteacher->class_id = $request->class_id;
        $classteacher->section_id = $request->section_id;
        $classteacher->teacher_id = $request->teacher_id;
        $classteacher->save();

        return redirect()->route('backend.manage-class-teacher')->with('success', 'Teacher class has been updated successfully !!');
    }
    public function delete_class_teacher($id){
        $classteacher = Classteacher::find($id);
        $classteacher->delete();

        return redirect()->route('backend.manage-class-teacher')->with('success', 'Teacher class has been deleted successfully !!');
    }
    
    
    //class routine
    public function manage_class_routine(){
        $classroutines = ClassRoutine::with('subject','teacher','room')->get();
        $classes = ClassModal::get();
        $sections = Section::get();
        $teachers = User::where('user_role', 6)->get();
        $subjects = Subject::get();
        $classrooms = Classroom::get();
        // dd($subjects);
        return view('backend.settings.class_routine.manage_routine_class', [
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'classrooms' => $classrooms,
            'classroutines' => $classroutines,
        ]);
    }
    public function save_class_routine(Request $request){

        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'day_id' => 'required',
            'classroom_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        // dd($_POST);

        $routine_subject_check = ClassRoutine::where(['day_id' => $request->day_id,'subject_id' => $request->subject_id])->get();
        if(!$routine_subject_check->isEmpty()){
            return response()->json(["error"=>true,"msg"=>"Subject already assign!! Are you sure to overwrite this?","data"=>$request->all()]);
        }else{

            $routine_check = ClassRoutine::where([
                'class_id'=> $request->class_id,
                'section_id' => $request->section_id,
                'day_id' => $request->day_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ])->get();

            // dd($routine_check);

            if(!$routine_check->isEmpty()){
                return response()->json(["error"=>true,"msg"=>"Schedule already exist!! Are you sure to overwrite this?","data"=>$request->all()]);
            }else{
                $classroutine = new ClassRoutine();
                $classroutine->class_id = $request->class_id;
                $classroutine->session_id = Session::get('session_id');
                $classroutine->section_id = $request->section_id;
                $classroutine->subject_id = $request->subject_id;
                $classroutine->teacher_id = $request->teacher_id;
                $classroutine->classroom_id = $request->classroom_id;
                $classroutine->day_id = $request->day_id;
                $classroutine->start_time = $request->start_time;
                $classroutine->end_time = $request->end_time;
                $classroutine->save();

                return response()->json([
                    "success" => true,
                    "data" => $this->show_routing_list($request),
                ]);
            }
        }
        
    }
    public function routine_overwrite_check(Request $request){
        // dd($_POST);

        $classroutine = new ClassRoutine();
        $classroutine->class_id = $request->class_id;
        $classroutine->session_id = Session::get('session_id');
        $classroutine->section_id = $request->section_id;
        $classroutine->subject_id = $request->subject_id;
        $classroutine->teacher_id = $request->teacher_id;
        $classroutine->classroom_id = $request->classroom_id;
        $classroutine->day_id = $request->day_id;
        $classroutine->start_time = $request->start_time;
        $classroutine->end_time = $request->end_time;

        $classroutine->save();

        return response()->json([
            "success" => true,
            "data" => $this->show_routing_list($request),
        ]);
    }
    public function routine_overwrite_check_update(Request $request){
        // dd($_POST);

        $classroutine = ClassRoutine::find($request->id);
        $classroutine->class_id = $request->class_id;
        $classroutine->session_id = Session::get('session_id');
        $classroutine->section_id = $request->section_id;
        $classroutine->subject_id = $request->subject_id;
        $classroutine->teacher_id = $request->teacher_id;
        $classroutine->classroom_id = $request->classroom_id;
        $classroutine->day_id = $request->day_id;
        $classroutine->start_time = $request->start_time;
        $classroutine->end_time = $request->end_time;

        $classroutine->save();

        return response()->json([
            "success" => true,
            "data" => $this->show_routing_list($request),
        ]);
    }
    public function edit_class_routine(Request $request){
        $routine = ClassRoutine::find($request->routine_id);

        $classes = ClassModal::get();
        $sections = Section::get();
        $teachers = User::where('user_role', 6)->get();
        $subjects = Subject::get();
        $classrooms = Classroom::get();

        // dd($classroutine);

        $html = '<input type="hidden" name="id" value="'.$routine->id.'"><div class="mb-2"><label>Class</label><select name="class_id" class="form-control class"><option value="">Select Class</option>';
            foreach($classes as $class) :
                $selected = $routine->class_id == $class->id ? 'selected' : '';
                $html .='<option value="'.$class->id.'"'.$selected.'>'.$class->class_name.'</option>';
            endforeach;
            $html .='</select><span class="text-danger" id="class_error"></span></div><div class="mb-2"><label>Section</label><select name="section_id" class="form-control section"><option value="">Select Section</option>';
            foreach($sections as $section) :
                $selected = $routine->section_id == $section->id ? 'selected' : '';
                $html .= '<option value="'.$section->id.'" '.$selected.'>'.$section->section_name.'</option>';
            endforeach;
            $html .='</select><span class="text-danger" id="section_error"></span></div><div class="mb-2"><label>Subject</label><select name="subject_id" class="form-control subject"><option value="">Select Subject</option>';
            foreach($subjects as $subject) :
                $selected = $routine->subject_id == $subject->id ? 'selected' : '';
                $html .= '<option value="'.$subject->id.'" '.$selected.'>'.$subject->subject_name.'</option>';
            endforeach;
            $html .='</select><span class="text-danger" id="subject_error"></span></div><div class="mb-2"><label>Class Room</label><select name="classroom_id" class="form-control class_room"><option value="">Select Classroom</option>';
            foreach($classrooms as $classroom) :
                $selected = $routine->classroom_id == $classroom->id ? 'selected' : '';
                $html .='<option value="'.$classroom->id.'" '.$selected.'>'.$classroom->classroom_name.'</option>';
            endforeach;
            $html .='</select><span class="text-danger" id="classroom_error"></span></div><div class="mb-2"><label>Teacher</label><select name="teacher_id" class="form-control teacher"><option value="">Select Teacher</option>';
            foreach($teachers as $teacher) :
                $selected = $routine->teacher_id == $teacher->id ? 'selected' : '';
                $html .='<option value="'.$teacher->id.'" '.$selected.'>'.$teacher->name.'</option>';
            endforeach;
        $html .='</select><span class="text-danger" id="teacher_error"></span></div><div class="mb-2"><label>Day</label><select name="day_id" class="form-control"><option value="">Select Day</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select><span class="text-danger" id="day_error"></span></div><div class="row"><div class="col-md-6"><div class="mb-2"><label>Start Time</label><input type="time" class="form-control" name="start_time" value="'.$routine->start_time.'"><span class="text-danger" id="starttime_error"></span></div></div><div class="col-md-6"><div class="mb-2"><label>End Time</label><input type="time" class="form-control" name="end_time" value="'.$routine->end_time.'"><span class="text-danger" id="endtime_error"></span></div></div></div>';

        echo $html;

    }
    public function update_class_routine(Request $request){

        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'day_id' => 'required',
            'classroom_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        // dd($_POST);
        $routine_check = ClassRoutine::where([
            'class_id'=> $request->class_id,
            'section_id' => $request->section_id,
            'day_id' => $request->day_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ])->get();

        if(!$routine_check->isEmpty()){
            // dd($request->all());
            return response()->json([
                "error" => true,
                "data" => $request->all(),
            ]);

        }else{
            $classroutine = ClassRoutine::find($request->id);
            $classroutine->class_id = $request->class_id;
            $classroutine->section_id = $request->section_id;
            $classroutine->subject_id = $request->subject_id;
            $classroutine->teacher_id = $request->teacher_id;
            $classroutine->classroom_id = $request->classroom_id;
            $classroutine->day_id = $request->day_id;
            $classroutine->start_time = $request->start_time;
            $classroutine->end_time = $request->end_time;
            $classroutine->save();

            return response()->json([
                "success" => true,
                "data" => $this->show_routing_list($request),
            ]);
        }
    }
    public function delete_class_routine(Request $request){
        ClassRoutine::find($request->delete_id)->delete();
        echo 1;
    }
    protected function show_routing_list($request){
        $classroutines = ClassRoutine::with('subject','teacher','room')
                                    ->where(['class_id'=> $request->class_id,'section_id' => $request->section_id])
                                    ->get();

        if(is_object(@$classroutines) && @$classroutines->count() > 0) {
            $class = ClassModal::find($request->class_id);
            $section = Section::find($request->section_id);

            $unique = collect($classroutines)->map(fn($i) => $i->day_id)->unique()->sort();
            $weekday = ['Monday','Tuesday','Wednesday','Thursday','Friday', 'Saturday', 'Sunday'];
            $i = 0;
            $html = '';
            $html .= '<div class="col-md-4 m-auto bg-dark p-2 text-center rounded"><h4 class="text-white">Class Routine</h4><h5 class="text-white">Class : '.$class->class_name.'</h5><p class="text-white">Section : '.$section->section_name.'</p></div>';
            
            foreach($unique as $n => $each) :

                $html .='<div class="card mt-3"><div class="card-header border-bottom bg-white pb-0 ps-2"><h4 class="card-title">'.$weekday[$i++].'</h4></div><div class="card-body p-0"><table class="table"><thead class="bg-light"><tr><th>Subject</th><th>Teacher</th><th>Room</th><th>Time</th><th>Action</th></tr></thead><tbody>';

                foreach($classroutines as $classroutine) :
                    if($classroutine->day_id == $each) :
                        $html .='<tr class="row_'.$classroutine->id.'"><td>'.$classroutine->subject->subject_name.'</td><td>'.$classroutine->teacher->name.'</td><td>'.$classroutine->room->classroom_name.'</td><td>'.$classroutine->start_time.' - '.$classroutine->end_time.'</td><td><a href="" class="btn btn-sm btn-success routine_edit" data-id="'.$classroutine->id.'"><i class="mdi mdi-file-edit-outline"></i></a><a href="'.route('backend.delete-class-routine', ['id'=>$classroutine->id]).'" id="delete" class="btn btn-sm btn-danger" data-id="'.$classroutine->id.'"><i class="mdi mdi-trash-can-outline"></i></a></td></tr>';
                    endif;
                endforeach;

                $html .= '</tbody></table></div></div>';

            endforeach;
        } else {
            $html = '<span class="text-danger"> No data found </span>';
        }

        return $html;
    }
    public function show_subject_routine(Request $request){
        $html = $this->show_routing_list($request);
        echo $html;
    }
    public function preview_subject_routine(Request $request){

        $classroutines = ClassRoutine::with('subject','teacher','room')
                                    ->where(['class_id'=> $request->class_id,'section_id' => $request->section_id])
                                    ->get();

        // dd($classroutines);
        
        $trainerName = [];
        foreach($classroutines as $key => $routine)
        {
            $trainerName[] = [
                'title'=> 'Subject: '.$routine->subject->subject_name.', Room: '.$routine->room->classroom_name.', Teacher: '.$routine->teacher->name,
                'daysOfWeek'=>[$routine->day_id],
                'startTime'=>$routine->start_time,
                'endTime'=>$routine->end_time,
                'color'=>'purple'
            ];
        }

        echo json_encode($trainerName);

    }
    

    //syllabus
    public function manage_syllabus(){
        $syllabus = Syllabus::with('class','section','subject')->get();
        //dd($syllabus);

        return view('backend.settings.syllabus.manage_syllabus', [
            'syllabus' => $syllabus
        ]);
    }
    public function add_syllabus(){
        $subjects = Subject::get();
        $classes = ClassModal::get();
        $sections = Section::get();
        // dd($subjects);
        return view('backend.settings.syllabus.add_syllabus', [
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
        ]);
    }
    protected function syllabusImageUpload($request, $syllabusId){
        $syllabusImages = $request->file('syllabus_image');
        // dd($syllabusImages);

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
    public function save_syllabus(Request $request){

        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'syllabus_title' => 'required',
            // 'syllabus_image' => 'required|mimes:doc,docx,pdf',
        ]);

        
        $syllabus = new Syllabus();
        $syllabus->syllabus_title = $request->syllabus_title;
        $syllabus->class_id = $request->class_id;
        $syllabus->section_id = $request->section_id;
        $syllabus->subject_id = $request->subject_id;
        $syllabus->save();

        $this->syllabusImageUpload($request, $syllabus->id);

        return redirect()->route('backend.manage-syllabus')->with('success', 'Syllabus has been added successfully !!');
    }
    public function edit_syllabus($id){

        $classes = ClassModal::get();
        $sections = Section::get();
        $subjects = Subject::get();

        $syllabus = Syllabus::with('class','section','subject')->find($id);
        $syllabusimages = DB::table('syllabus_images')->where('syllabus_id', $id)->get();
        // dd($syllabusimages);

        return view('backend.settings.syllabus.edit_syllabus', [
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
            'syllabus' => $syllabus,
            'syllabusimages' => $syllabusimages,
        ]);
    }
    public function syllabusBasicInfo($request, $syllabus, $imageUrl = null){
        $syllabus->syllabus_title = $request->syllabus_title;
        $syllabus->class_id = $request->class_id;
        $syllabus->section_id = $request->section_id;
        $syllabus->subject_id = $request->subject_id;

        if($imageUrl !=''){
            $syllabus->syllabus_image = $imageUrl;
        }
        
        $syllabus->save();
    }
    public function update_syllabus(Request $request){

        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            // 'syllabus_image' => 'required|mimes:doc,docx,pdf',
        ]);

        $syllabusImage = $request->file('syllabus_image');
        $syllabus = Syllabus::find($request->id);

        if($syllabusImage){
            if (File::exists($syllabus->syllabus_image)) {
                unlink($syllabus->syllabus_image);
            }
            $imageUrl = $this->syllabusImageUpload($request, $request->id);
            $this->syllabusBasicInfo($request, $syllabus, $imageUrl);
        }else{
            $this->syllabusBasicInfo($request, $syllabus);
        }

        return redirect()->route('backend.manage-syllabus')->with('success', 'Syllabus has been updated successfully !!');
    }
    public function delete_syllabus($id){
        Syllabus::find($id)->delete();
        DB::table('syllabus_images')->where('syllabus_id', $id)->delete();

        return redirect()->route('backend.manage-syllabus')->with('success', 'Syllabus has been deleted successfully !!');
    }
    public function delete_syllabus_image(Request $request){
        $syllabusImage = DB::table('syllabus_images')->delete($request->delete_id);
        echo $syllabusImage;
    }


    //Homework------------
    public function manage_homeWork()
    {
        $classes = ClassModal::all();
        $teachers=User::where('user_role',6)->get();
        // dd(11);

        return view('backend.settings.homework.index', [
            'classes' => $classes,
            'teachers'=> $teachers
        ]);
    }

    protected function homeworkValidation($request){
        $request->validate([
            'title' => 'required',
            'teacher_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
        ]);
    }

    protected function homework_autoload($request){
        $homeworks = HomeworkModel::with('teacher', 'subject')->where([
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id
                            ])->get();
        return $homeworks;
    }

    public function homeWorkSave(Request $request)
    {
        // dd(15);

        $this->homeworkValidation($request);
        $data = $request->except('_token');
        HomeworkModel::create($data);

        $homeworks = $this->homework_autoload($request);
        return view('backend.settings.homework.show_homework_response', [
            'homeworks' => $homeworks,
        ]);
    }

    public function show_student_homework(Request $request)
    {
        $homeworks = $this->homework_autoload($request);
        return view('backend.settings.homework.show_homework_response', [
            'homeworks' => $homeworks,
        ]);
    }

    public function edit_student_homework(Request $request)
    {
        $homework = HomeworkModel::with('teacher')->find($request->homework_id);
        $classes = ClassModal::all();
        $subjects = Subject::get();
        $sections = Section::get();
        $classes = ClassModal::all();
        $teachers=User::where('user_role',6)->get();

        return view('backend.settings.homework.edit_homework_response', [
            'classes' => $classes,
            'teachers'=> $teachers,
            'homework' => $homework,
            'subjects' => $subjects,
            'sections' => $sections,
        ]);
    }

    public function update_student_homework(Request $request)
    {
        // dd($_POST);
        $this->homeworkValidation($request);
        $data = $request->except('_token');
        HomeworkModel::where('id', $request->id)->update($data);
        $homeworks = $this->homework_autoload($request);
        return view('backend.settings.homework.show_homework_response', [
            'homeworks' => $homeworks,
        ]);
    }

    public function delete_student_homework(Request $request)
    {
        HomeworkModel::find($request->delete_id)->delete();
        $homeworks = $this->homework_autoload($request);
        return view('backend.settings.homework.show_homework_response', [
            'homeworks' => $homeworks,
        ]);
    }
}