<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TeacherAdditionalInfo;
use App\Models\TeacherDocumentChecklist;
use App\Models\OperatorAdditionalInfo;
use App\Models\OperatorDocumentChecklist;
use DB;
use File;
use Image;
use DataTables;
use App\Traits\UserRollPermissionTrait;

class OperatorController extends Controller
{
    use UserRollPermissionTrait;

    public function __construct()
    {
        $this->module_name = 'users';
    }

    public function operator_validation($request){
        $request->validate([
            'name' => 'required',
            'email'=>'required|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }

    public function manage_operator(Request $request)
    {
        //dd(123);
        if ($request->ajax()) {

            $operators = User::where('user_role',8)->get();
            // dd($operators);
            
            return datatables()->of($operators)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                  
                    $btn = '<a href="'.route('backend.edit-operator',$row->id).'" class="btn btn-sm btn-primary waves-effect waves-light edit-operator"><i class="mdi mdi-square-edit-outline"></i></a>
                    <a href="'.route('backend.delete-operator',$row->id).'" id="delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.users.operator.manage_operator');
    }

    public function add_operator()
    {
        return view('backend.users.operator.add_operator');
    }

    public function save_teacher_csv(Request $request){

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
                    $user->first_name ='';
                    $user->last_name ='';
                    $user->user_role=6;
                    $user->save();

                    $TeacherAdditionalInfo=new TeacherAdditionalInfo();
                    $TeacherAdditionalInfo->user_id=$user->id;
                    $TeacherAdditionalInfo->save();

                    $TeacherDocumentChecklist=new TeacherDocumentChecklist();
                    $TeacherDocumentChecklist->user_id=$user->id;
                    $TeacherDocumentChecklist->save();

                    $this->userRollPermission($request, $user);

                    // echo "<pre>"; print_r($row);
                }
                $i++;
            }
        }
        return redirect()->route('backend.teacher.index')->with('success', 'Successfully Teacher Created!');
    }

    public function save_operator(Request $request)
    {
        //create_operator_user
        $this->create_operator_user($request);
        return redirect()->route('backend.manage-operator')->with('success', 'Successfully Operator Created!');
    }

    public function edit_operator($id)
    {
        // dd($id);

        $operator_edit = User::find($id);
        $operator_additional_info = OperatorAdditionalInfo::where('user_id',$id)->first();
        $operator_document_checklist = OperatorDocumentChecklist::where('user_id',$id)->first();

        return view('backend.users.operator.edit_operator',compact('operator_edit','operator_additional_info','operator_document_checklist'));
    }

    public function delete_operator($id)
    {
        User::find($id)->delete();
        return redirect()->route('backend.manage-operator')->with('delete', 'User Successfully deleted!');
    }

    protected function operator_update_validate($request){
        $request->validate([
            'name' => 'required',
            'email'=>'required',
            'password' => 'required|min:6',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }

    protected function operator_update_validate_new($request){
        $request->validate([
            'name' => 'required',
            'email'=>'required|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);

    }

    protected function operator_profile_imageupload($request){
        // echo 11; die();
        $operator_profilepic = $request->file('operator_profilepic');

        $image = Image::make($operator_profilepic);
        $fileType = $operator_profilepic->getClientOriginalExtension();
        $imageName = 'operator_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/operator/';
        $imageUrl = $directory.$imageName;
        $image->save($imageUrl);

        return $imageName;
    }

    public function update_basicinfo_operator(Request $request)
    {
        $id=$request->user_id;
        $user=User::find($id)->toArray();

        if($user['email'] == $request->email){
            $this->operator_update_validate($request);
        }else{
            $this->operator_update_validate_new($request);
        }
 
        $operator_profilepic = $request->file('operator_profilepic');
        $user_info = user::find($request->user_id);
        // dd($user_info);

        if($operator_profilepic){

            if($user_info->user_Image){
                $image_path='images/operator/'.$user_info->user_Image;
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
            }

           $imageUrl = $this->operator_profile_imageupload($request);
        }

        $user=User::find($id); 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->phone;
        $user->gender = $request->gender;
        $user->user_Image = isset($imageUrl) ? $imageUrl : $user_info->user_Image;
        $user->save();

        $this->userRollPermission($request, $user);

        return redirect()->route('backend.manage-operator')->with('success', 'Successfully Updated');
    }

    protected function additionalinfo_validate($request){
        $request->validate([
            'first_name' => 'required',
            'last_name'=>'required',
            'date_of_birth' => 'required',
            'blood_group'=>'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
        ]);
    }

    public function update_additionalinfo_operator(Request $request)
    {
        $this->additionalinfo_validate($request);

        User::where('id',$request->user_id)->update(['status'=>$request->status]);
        $data = $request->except('_token','status');
        // dd($data);
        OperatorAdditionalInfo::where('user_id',$request->user_id)->update($data);
        return redirect()->route('backend.manage-operator')->with('success', 'Successfully Updated'); 
    }

    public function update_document_checklist_operator(Request $request)
    {
        $data=$request->except('_token');
        OperatorDocumentChecklist::where('user_id',$request->user_id)->update($data);
        return redirect()->route('backend.manage-operator')->with('success','Successfully Updated');
    }
}
