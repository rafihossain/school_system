<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\AdditionalInfo;
use App\Models\ParentDocumentChecklist;
use App\Models\StudentBasicInfo;
use App\Models\Section;
use DataTables;
use App\Models\ClassModal;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Traits\UserRollPermissionTrait;

class ParentsController extends Controller
{
    use UserRollPermissionTrait;

    public function __construct()
    {
        $this->module_name = 'users';
    }

    public function parentValidation($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }
    public function parentIndex(Request $request)
    {

        if ($request->ajax()) {
            // $parents = User::where('user_role', 4)->get();
            $query = DB::table('students')
                ->leftJoin('users', 'students.parent_id', 'users.id')
                ->leftJoin('parent_additional_info', 'students.parent_id', 'parent_additional_info.user_id')
                ->where('users.user_role', 4);

            if ($request->class_id != '') {
                $query->where('students.class_id', $request->class_id);
            }
            if ($request->section_id != '') {
                $query->where('students.section_id', $request->section_id);
            }
            if (($request->class_id != '') && ($request->section_id != '')) {
                $query->where('students.class_id', $request->class_id)
                ->where('students.section_id', $request->section_id);
            }
            if (($request->class_id != '') && ($request->section_id != '') && ($request->student_id != '')) {
                $query->where('students.class_id', $request->class_id)
                ->where('students.section_id', $request->section_id)
                ->where('students.user_id', $request->student_id);
            }

            $parents = $query->get();
            // dd($query);

            return Datatables::of($query)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('backend.edit.parent', $row->id) . '" class="btn btn-sm btn-primary waves-effect waves-light parent_info_edit"><i class="mdi mdi-square-edit-outline"></i></a>
                    <a href="' . route('backend.parent.delete', $row->id) . '" id="delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $classes = ClassModal::all();
        return view('backend.users.parents.index', compact('classes'));
    }

    public function addParents()
    {
        return view('backend.users.parents.addParent');
    }

    public function authenticated_redirected()
    {
        if (Auth::User()->user_role == 8) {
            return redirect()->route('backend.add.parents')->with('success', 'Successfully Parent Created!');
        } else {
            return redirect()->route('backend.parents.index')->with('success', 'Successfully Parent Created!');
        }
    }

    /*=================================================
                    CSV Upload Start
    ==================================================*/
    protected function save_parent_csv(Request $request)
    {

        $csvUpload = $request->file('parent_csv');
        if ($csvUpload) {
            $fileType = $csvUpload->getClientOriginalExtension();
            $fileName = 'parent_' . Str::random(10) . '.' . $fileType;
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
                    $user->user_role = 4;
                    $user->save();

                    $AdditionalInfo = new AdditionalInfo();
                    $AdditionalInfo->user_id = $user->id;
                    $AdditionalInfo->save();

                    $ParentDocumentChecklist = new ParentDocumentChecklist();
                    $ParentDocumentChecklist->user_id = $user->id;
                    $ParentDocumentChecklist->save();

                    $this->userRollPermission($request, $user);

                    // echo "<pre>"; print_r($row);
                }
                $i++;
            }
        }
        return redirect()->route('backend.parents.index')->with('success', 'Successfully Parent Created!');
    }

    public function saveParents(Request $request)
    {
        //create_parent_user
        $this->create_parent_user($request);
        return $this->authenticated_redirected();
    }

    public function editParents($id)
    {
        $parent_edit = User::find($id);
        $parents_additional_info = AdditionalInfo::where('user_id', $id)->first();
        //dd($parents_additional_info);
        $ParentDocumentChecklist = ParentDocumentChecklist::where('user_id', $id)->first();
        return view('backend.users.parents.editParent', compact('parent_edit', 'parents_additional_info', 'ParentDocumentChecklist'));
    }

    protected function parentupdateValidate($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }

    protected function parentupdatenewValidate($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }

    public function updateBasicInfoParents(Request $request)
    {
        $id = $request->user_id;

        $user = User::find($id)->toArray();

        if ($user['email'] == $request->email) {
            $this->parentupdateValidate($request);
        } else {
            $this->parentupdatenewValidate($request);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }

        $user->mobile = $request->phone;
        $user->gender = $request->gender;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('backend.parents.index')->with('success', 'Successfully Updated');
    }

    protected function update_parentAdditional_Info_validation($request)
    {
        $request->validate([
            'father_occupation' => 'required',
            'father_cnic' => 'required',
            'mother_name' => 'required',
            'mother_nid' => 'required',
            'mother_occupation' => 'required',
        ]);
    }

    public function updateAdditionalInfoParents(Request $request)
    {
        $this->update_parentAdditional_Info_validation($request);
        $data = $request->except('_token');
        AdditionalInfo::where('user_id', $request->user_id)->update($data);
        return redirect()->route('backend.parents.index')->with('success', 'Successfully Updated');
    }

    public function parentDelete($id)
    {
        $success = DB::table('users')->where('id', $id)->delete();

        if ($success) {
            $notification = array(
                'delete' => 'User Successfully deleted!',
            );
            return redirect()->back()->with($notification);
        }
    }

    protected function parent_document_checklist_update_validation($request)
    {
        $request->validate([
            'attested_father_passport_size_photograph' => 'required',
            'attested_father_national_id_card' => 'required',
            'attested_mather_passport_size_photograph' => 'required',
            'attested_mother_national_id_card' => 'required',
        ]);
    }

    public function parent_document_checklist_update(Request $request)
    {
        $this->parent_document_checklist_update_validation($request);
        $data = $request->except('_token');
        ParentDocumentChecklist::where('user_id', $request->user_id)->update($data);
        return redirect()->route('backend.parents.index')->with('success', 'Successfully Updated');
    }

    public function parentSearch(Request $request)
    {
        if (($request->ajax()) && ($request->parent_name != null)) {
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
    }

    public function parent_additional_info_get(Request $request)
    {
        $id = $request->parent_id;
        $abc = AdditionalInfo::where('user_id', $id)->first();
        return response()->json($abc);
    }

    public function get_section(Request $request)
    {
        $class_id = $request->class_id;
        $sectons = Section::where('class_id', $class_id)->get();
        $output = '';
        if (count($sectons) > 0) {
            $output = '<option value="">Select section</option>';
            foreach ($sectons as $row) {
                $output .= '<option class="list-group-item" value="' . $row->id . '">' . $row->section_name . '</option>';
            }
        } else {
            $output .= '<option class="list-group-item">' . 'No Data Found' . '</option>';
        }

        return $output;
    }

    public function get_student(Request $request)
    {
        $student_basic_info = Student::where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();
        $output = '';
        if (count($student_basic_info) > 0) {
            $output = '<option value="">Select Student</option>';
            foreach ($student_basic_info as $row) {
                $student = user::find($row->user_id);
                $output .= '<option class="list-group-item" value="' . $student->id . '">' . $student->name . '</option>';
            }
        } else {
            $output .= '<option class="list-group-item">' . 'No Data Found' . '</option>';
        }

        return $output;
    }
}
