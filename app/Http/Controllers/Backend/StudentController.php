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
use DB;
use File;
use Image;

use App\Traits\UserRollPermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    use UserRollPermissionTrait;

    public function __construct()
    {
        $this->module_name = 'users';
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
            $query = DB::table('students')
                ->leftJoin('users', 'students.user_id', 'users.id')
                ->leftJoin('classes', 'students.class_id', 'classes.id')
                ->leftJoin('sections', 'students.section_id', 'sections.id')
                ->where('users.user_role', 5);

            if ($request->department_id) {
                $query->where('students.department_id', $request->department_id);
            }
            if ($request->class_id) {
                $query->where('students.class_id', $request->class_id);
            }
            if ($request->section_id) {
                $query->where('students.section_id', $request->section_id);
            }
            if (($request->department_id != '') && ($request->class_id != '')) {
                $query->where('students.department_id', $request->department_id)->where('students.class_id', $request->class_id);
            }
            if (($request->department_id != '') && ($request->class_id != '') && ($request->section_id != '')) {
                $query->where('students.department_id', $request->department_id)->where('students.class_id', $request->class_id)->where('students.section_id', $request->section_id);
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
        $student = Student::with('getStudent','getParent', 'getparentBasicInfo')->where('user_id', $id)->first();
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
        $StudentBasicInfo = Student::where('user_id', $request->user_id)->first();
        
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
        Student::where('user_id', $request->user_id)->update($data);

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

        $student = Student::where('user_id', $id)->update(['admission_date' => $request->admission_date]);

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

    //student promotion
    public function show_promotion_student_list(Request $request)
    {
        $students = Student::where([
            'session_id' => $request->session_from,
            'class_id' => $request->class_from,
        ])->get();

        foreach ($students as $student) {
            $std = Student::find($student->id);
            $std->session_id = $request->session_to;
            $std->class_id = $request->class_to;
            $std->save();
        }

        $allStudents = Student::with('get_student')->get();
        // dd($allStudents);

        return view('backend.exam.promotion.student_promotion_result', [
            'students' => $allStudents
        ]);
    }
}
