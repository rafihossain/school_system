<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\BloodGroup;
use App\Models\User;
use App\Models\ClassModal;
use App\Models\Section;
use App\Models\TeacherDocumentChecklist;
use App\Models\Department;
use App\Models\Designation;
use File;
use Image;
use DataTables;
use App\Traits\UserRollPermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    use UserRollPermissionTrait;

    protected $Teacher;
    protected $teacher;
    public function __construct()
    {
        $this->Teacher = 'App\Models\TeacherAdditionalInfo'.Session::get('session_name');
        $this->teacher = 'teacher_additional_info_'.Session::get('session_name');
    }

    public function teacherIndex(Request $request)
    {
        if ($request->ajax()) {

            $query = DB::table($this->teacher)
                ->leftJoin('users', $this->teacher.'.user_id', 'users.id')
                ->leftJoin('departments', $this->teacher.'.department_id', 'departments.id')
                ->leftJoin('designations', $this->teacher.'.designation_id', 'designations.id')
                ->where('users.user_role', 6);
            if ($request->department_id) {
                $query->where($this->teacher.'.department_id', $request->department_id);
            }

            if ($request->designation_id) {
                $query->where($this->teacher.'.designation_id', $request->designation_id);
            }

            if ($request->status) {
                $query->where('users.status', $request->status);
            }

            $teachers = $query->get();

            return datatables()->of($teachers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('backend.edit.teacher', $row->user_id) . '" class="btn btn-sm btn-primary waves-effect waves-light teacher_info_edit"><i class="mdi mdi-square-edit-outline"></i></a>
                    <a href="' . route('backend.teacher.delete', $row->user_id) . '" id="delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $departments = Department::all();
        $designations = Designation::all();
        return view('backend.users.teacher.index', compact('departments', 'designations'));
    }

    public function addTeacher()
    {
        $sections = Section::all();
        $classes = ClassModal::all();
        return view('backend.users.teacher.addTeacher', compact('sections', 'classes'));
    }

    public function authenticated_redirected()
    {
        if (Auth::User()->user_role == 8) {
            return redirect()->route('backend.add.teacher')->with('success', 'Successfully Teacher Created!');
        } else {
            return redirect()->route('backend.teacher.index')->with('success', 'Successfully Teacher Created!');
        }
    }

    public function save_teacher_csv(Request $request)
    {
        // dd($_FILES);

        $csvUpload = $request->file('teacher_csv');
        if ($csvUpload) {
            $fileType = $csvUpload->getClientOriginalExtension();
            $fileName = 'teacher_' . Str::random(10) . '.' . $fileType;
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
                    $user->mobile = $row[3];
                    $user->gender = $row[4];
                    $user->first_name = '';
                    $user->last_name = '';
                    $user->user_role = 6;
                    $user->save();

                    $TeacherAdditionalInfo = new $this->Teacher();
                    $TeacherAdditionalInfo->user_id = $user->id;
                    $TeacherAdditionalInfo->save();

                    $TeacherDocumentChecklist = new TeacherDocumentChecklist();
                    $TeacherDocumentChecklist->user_id = $user->id;
                    $TeacherDocumentChecklist->save();

                    $this->userRollPermission($request, $user);

                    // echo "<pre>"; print_r($row);
                }
                $i++;
            }
        }
        return redirect()->route('backend.teacher.index')->with('success', 'Successfully Teacher Created!');
    }

    public function saveTeacher(Request $request)
    {
        //create_teacher_user
        $this->create_teacher_user($request);
        return $this->authenticated_redirected();
    }

    public function teacherDelete($id)
    {
        $success = DB::table('users')->where('id', $id)->delete();

        if ($success) {
            $notification = array(
                'delete' => 'User Successfully deleted!',
            );
            return redirect()->back()->with($notification);
        }
    }

    public function editTeacher($id)
    {
        $teacher_edit = User::find($id);
        $departments = Department::all();
        $designations = Designation::all();
        $bloods = BloodGroup::all();

        $teacher_additional_info = $this->Teacher::where('user_id', $id)->first();
        $TeacherDocumentChecklist = TeacherDocumentChecklist::where('user_id', $id)->first();

        return view('backend.users.teacher.editTeacher', 
        compact('teacher_edit', 'teacher_additional_info', 'TeacherDocumentChecklist', 'departments', 'designations', 'bloods')
        );
    }

    protected function teacherupdateValidate($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }

    protected function teacherupdateValidate_new($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }

    protected function teacherProfileImageUpload($request)
    {
        // echo 11; die();
        $teacher_profile_pic = $request->file('teacher_profile_pic');

        $image = Image::make($teacher_profile_pic);
        $fileType = $teacher_profile_pic->getClientOriginalExtension();
        $imageName = 'teacher_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/teacher/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageName;
    }

    public function updateBasicInfoTeacher(Request $request)
    {
        $user = User::find($request->user_id);
        
        if ($user->email == $request->email) {
            $this->teacherupdateValidate($request);
        } else {
            $this->teacherupdateValidate_new($request);
        }

        $student = $request->except('_token');
        User::find($request->user_id)->update($student);

        return redirect()->route('backend.teacher.index')->with('success', 'Successfully Updated');
    }

    protected function update_studentAdditional_Info_validation($request)
    {
        $request->validate([
            'date_of_birth' => 'required',
            'blood_id' => 'required',
            'present_address' => 'required',
        ]);
    }

    public function teacher_additional_info_update(Request $request)
    {
        $this->update_studentAdditional_Info_validation($request);
        
        // $user = $request->only('status');
        // User::where('id', $request->user_id)->update($user);

        $teacher_profile_pic = $request->file('teacher_profile_pic');
        $teacher_additional_info = $this->Teacher::where('user_id', $request->user_id)->first();
        
        if($teacher_profile_pic){
            if (isset($teacher_additional_info->teacher_profile_pic)) {
                $image_path = public_path() . '/images/student/' . $teacher_additional_info->teacher_profile_pic;
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
            }
            $imageUrl = $this->teacherProfileImageUpload($request);
        }

        $data = $request->except('_token');
        $data['teacher_profile_pic'] = (isset($imageUrl)) ? $imageUrl : $teacher_additional_info->teacher_profile_pic;
        $this->Teacher::where('user_id', $request->user_id)->update($data);

        return redirect()->route('backend.teacher.index')->with('success', 'Successfully Updated');
    }

    public function teacher_document_checklist_update(Request $request)
    {
        $data = $request->except('_token');
        TeacherDocumentChecklist::where('user_id', $request->user_id)->update($data);
        return redirect()->route('backend.teacher.index')->with('success', 'Successfully Updated');
    }
}
