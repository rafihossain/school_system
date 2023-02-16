<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AdditionalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ClassModal;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentBasicInfo;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocumentChecklist;
use App\Models\Department;
use App\Models\SessionModel;
use Illuminate\Support\Facades\DB;
use File;
use Image;

use App\Traits\UserRollPermissionTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{
    use UserRollPermissionTrait;

    protected $Student;
    protected $student;

    public function __construct()
    {
        $this->Student = 'App\Models\Student'.Session::get('session_name');
        $this->student = 'students_'.Session::get('session_name');
    }

    public function studentValidation($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'parent_id' => 'required',
            'department_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'roll_no' => 'required',
            'admission_date' => 'required',
            'gender' => 'required'
        ]);
    }

    public function studentIndex(Request $request)
    {
        //$students=User::where('user_role',5)->get(); 
        if (request()->ajax()) {
            $query = DB::table($this->student)
                ->leftJoin('users', $this->student.'.user_id', 'users.id')
                ->leftJoin('classes', $this->student.'.class_id', 'classes.id')
                ->leftJoin('sections', $this->student.'.section_id', 'sections.id')
                ->where('users.user_role', 5);

            if ($request->department_id) {
                $query->where($this->student.'.department_id', $request->department_id);
            }
            if ($request->class_id) {
                $query->where($this->student.'.class_id', $request->class_id);
            }
            if ($request->section_id) {
                $query->where($this->student.'.section_id', $request->section_id);
            }
            if (($request->department_id != '') && ($request->class_id != '')) {
                $query->where($this->student.'.department_id', $request->department_id)
                ->where($this->student.'.class_id', $request->class_id);
            }
            if (($request->department_id != '') && ($request->class_id != '') && ($request->section_id != '')) {
                $query->where($this->student.'.department_id', $request->department_id)
                ->where($this->student.'.class_id', $request->class_id)
                ->where($this->student.'.section_id', $request->section_id);
            }

            $students = $query->get();

            return datatables()->of($students)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="' . route('backend.edit.student', $row->user_id) . '" class="btn btn-sm btn-primary waves-effect waves-light student_info_edit"><i class="mdi mdi-square-edit-outline"></i></a>
                    <a href="' . route('backend.student.delete', $row->user_id) . '" id="delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></a>';

                    return $actionbtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        $sections = Section::all();
        $classes = ClassModal::all();
        $departments = Department::all();
        return view('backend.users.student.index', compact('sections', 'classes', 'departments'));
    }

    public function addStudent()
    {
        $sections = Section::all();
        $classes = ClassModal::all();
        $departments = Department::all();
        return view('backend.users.student.addStudent', compact('sections', 'classes', 'departments'));
    }

    public function authenticated_redirected()
    {
        if (Auth::User()->user_role == 8) {
            return redirect()->route('backend.add.student')->with('success', 'Successfully Student Created!');
        } else {
            return redirect()->route('backend.student.index')->with('success', 'Successfully Student Created!');
        }
    }

    /*=================================================
                    CSV Upload Start
    ==================================================*/

    public function save_student_csv(Request $request)
    {
        $csvUpload = $request->file('student_csv');
        if ($csvUpload) {
            $fileType = $csvUpload->getClientOriginalExtension();
            $fileName = 'student_' . Str::random(10) . '.' . $fileType;
            $csvUpload->move('csv/upload/', $fileName);

            $handle = fopen(public_path('csv/upload/' . $fileName), "r");

            $module_name = 'users';
            $module_name_singular = Str::singular($module_name);

            $i = 1;
            while ($row = fgetcsv($handle)) {
                if ($i != 1) {

                    $user = new User();
                    $user->name = $row[0];
                    $user->email = $row[1];
                    $user->password = Hash::make($row[2]);
                    $user->gender = $row[9];
                    $user->first_name = '';
                    $user->last_name = '';
                    $user->user_role = 5;
                    $user->save();

                    $Student = new Student();
                    $Student->user_id = $user->id;
                    $Student->section_id = $row[5];
                    $Student->class_id = $row[4];
                    $Student->parent_id = $row[3];
                    $Student->department_id = $row[6];
                    $Student->roll_no = $row[8];
                    $Student->admission_date = $row[7];
                    $Student->save();

                    $StudentAdditionalInfo = new StudentAdditionalInfo();
                    $StudentAdditionalInfo->user_id = $user->id;
                    $StudentAdditionalInfo->save();

                    $StudentDocumentChecklist = new StudentDocumentChecklist();
                    $StudentDocumentChecklist->user_id = $user->id;
                    $StudentDocumentChecklist->save();

                    $this->userRollPermission($request, $user);

                    // echo "<pre>"; print_r($row);
                }
                $i++;
            }
        }
        return redirect()->route('backend.student.index')->with('success', 'Successfully Student Created!');
    }

    public function saveStudent(Request $request)
    {
        $this->create_student_user($request);
        return $this->authenticated_redirected();
    }

    public function editStudent($id)
    {
        $student = $this->Student::with('getStudent','getParent', 'getparentBasicInfo')->where('user_id', $id)->first();
        // dd($student);

        $StudentAdditionalInfo = StudentAdditionalInfo::where('user_id', $id)->first();
        $StudentDocumentChecklist = StudentDocumentChecklist::where('user_id', $id)->first();

        $sections = Section::all();
        $classes = ClassModal::all();
        $departments = Department::all();
        //dd($StudentAdditionalInfo);
        return view('backend.users.student.editStudent', 
        compact('sections', 'classes', 'student', 'StudentAdditionalInfo', 'StudentDocumentChecklist', 'departments')
        );
    }

    public function studentDelete($id)
    {
        $success = DB::table('users')->where('id', $id)->delete();

        if ($success) {
            $notification = array(
                'delete' => 'User Successfully deleted!',
            );
            return redirect()->back()->with($notification);
        }
    }

    // public function studentBasicInfoValidate($request)
    // {
    //     $request->validate([
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'date_of_birth' => 'required',
    //     ]);
    // }

    protected function studentProfileImageUpload($request)
    {
        // echo 11; die();
        $student_profile_pic = $request->file('student_profile_pic');

        $image = Image::make($student_profile_pic);
        $fileType = $student_profile_pic->getClientOriginalExtension();
        $imageName = 'student_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/student/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageName;
    }

    public function updateBasicInfoStudent(Request $request)
    {
        // $this->studentBasicInfoValidate($request);
        // dd($_POST);
    
        $student_profile_pic = $request->file('student_profile_pic');
        $StudentBasicInfo = $this->Student::where('user_id', $request->user_id)->first();
        
        if($student_profile_pic){
            if (isset($StudentBasicInfo->student_profile_pic)) {
                $image_path = public_path() . '/images/student/' . $StudentBasicInfo->student_profile_pic;
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
            }
            $imageUrl = $this->studentProfileImageUpload($request);
        }
        
        $data = $request->only('b_form','registration','department_id','class_id','section_id','parent_id','guardian_name','guardian_office_address','guardian_office_phone','guardian_mobile_phone','guardian_mobile_whatsapp','guardian_mobile_email');

        $data['student_profile_pic'] = (isset($imageUrl)) ? $imageUrl : $StudentBasicInfo->student_profile_pic;
        $this->Student::where('user_id', $request->user_id)->update($data);

        $student = $request->only('name', 'gender', 'date_of_birth');
        User::find($request->user_id)->update($student);

        $parent = $request->only('father_occupation', 'father_cnic', 'mother_name', 'mother_occupation');
        AdditionalInfo::where('user_id',$request->parent_id)->update($parent);

        return redirect()->route('backend.student.index')->with('success', 'Successfully Updated');
    }

    protected function studentAdditionalInfoValidate($request)
    {
        $request->validate([
            'student_phone' => 'required',
            'email' => 'required',
        ]);
    }
    protected function studentAdditionalInfoValidate_new($request)
    {
        $request->validate([
            'student_phone' => 'required',
            'email' => 'required|unique:users,email',
        ]);
    }
    public function student_additional_info_update(Request $request)
    {
        $id = $request->user_id;

        $user = User::find($id)->toArray();

        if ($user['email'] == $request->email) {
            $this->studentAdditionalInfoValidate($request);
        } else {
            $this->studentAdditionalInfoValidate_new($request);
        }
        //dd($request->admission_date);
        $user = User::find($id);
        $user->email = $request->email;
        $user->save();

        $student = $this->Student::where('user_id', $id)->update(['admission_date' => $request->admission_date]);

        $data = $request->except('email', 'admission_date', '_token');

        StudentAdditionalInfo::where('user_id', $request->user_id)->update($data);
        return redirect()->route('backend.student.index')->with('success', 'Successfully Updated');
    }
    protected function student_document_checklist_update_validation($request)
    {
        $request->validate([
            'attested_passport_size_photograph' => 'required',
            'attested_national_id_card' => 'required',
            'attested_all_certificate' => 'required',
        ]);
    }
    public function student_document_checklist_update(Request $request)
    {
        $this->student_document_checklist_update_validation($request);
        $data = $request->except('_token');
        StudentDocumentChecklist::where('user_id', $request->user_id)->update($data);
        return redirect()->route('backend.student.index')->with('success', 'Successfully Updated');
    }

    protected function student_promote_reuse($request){

        $students = $this->Student::with('class', 'session')->where([
            'session_id' => $request->session_from,
            'class_id' => $request->class_from,
        ])->get();
        
        $session_to = $request->session_to;
        $class_to = $request->class_to;

        return view('backend.exam.promotion.student_promotion_list', [
            'students' => $students,
            'session_to' => $session_to,
            'class_to' => $class_to
        ]);
    }

    //student promotion
    public function student_list(Request $request)
    {
        return $this->student_promote_reuse($request);
    }
    public function promote_student_list(Request $request)
    {
        // if(!isEmpty($request->student_id)){
            
            $students = $this->Student::whereIn('id',$request->student_id)->get();
            // dd($students);

            foreach ($students as $student) {
                $session = SessionModel::find($request->session_to);

                DB::table('students_'.$session->session_name)->insert([
                    'user_id' => $student->user_id,
                    'session_id' => $student->session_id,
                    'section_id' => $student->section_id,
                    'class_id' => $student->class_id,
                    'parent_id' => $student->parent_id,
                    'department_id' => $student->department_id,
                    'roll_no' => $student->roll_no,
                    'admission_date' => $student->admission_date,
                    'b_form' => $student->b_form,
                    'registration' => $student->registration,
                    'guardian_name' => $student->guardian_name,
                    'guardian_office_address' => $student->guardian_office_address,
                    'guardian_office_phone' => $student->guardian_office_phone,
                    'guardian_mobile_phone' => $student->guardian_mobile_phone,
                    'guardian_mobile_whatsapp' => $student->guardian_mobile_whatsapp,
                    'guardian_mobile_email' => $student->guardian_mobile_email,
                    'student_profile_pic' => $student->student_profile_pic,
                ]);

                DB::table('students_'.$session->session_name)
                ->where('id', $student->id)->update([
                    'session_id' => $request->session_to,
                    'class_id' => $request->class_to,
                ]);

            }

        // }
        return $this->student_promote_reuse($request);
    }
}
