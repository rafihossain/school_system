<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StaffAdditionalInfo;
use App\Models\StaffDocumentChecklist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use App\Traits\UserRollPermissionTrait;

class StaffController extends Controller
{
    use UserRollPermissionTrait;
    
    public function __construct()
    {
        $this->module_name = 'users';
 
    }

    public function staffValidation($request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email'=>'required|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }

    public function staffIndex()
    {
        $staffs=User::where('user_role',7)->get();
        return view('backend.users.staff.index',compact('staffs'));
    }

    public function addStaff()
    {
        return view('backend.users.staff.addStaff');
    }

    public function authenticated_redirected()
    {
        if (Auth::User()->user_role == 8) {
            return redirect()->route('backend.add.staff')->with('success', 'Successfully Staff Created!');
        } else {
            return redirect()->route('backend.staff.index')->with('success', 'Successfully Staff Created!');
        }
    }

    public function saveStaff(Request $request)
    {
        //create_staff_user
        $this->create_staff_user($request);
        return $this->authenticated_redirected();

        return redirect()->route('backend.staff.index')->with('success', 'Successfully Parent Created!');
    }

    public function staffDelete($id)
    {
        $success=DB::table('users')->where('id', $id)->delete();

        if ($success){
            $notification = array(
                'delete' => 'User Successfully deleted!',
            );
            return redirect()->back()->with($notification);
        }
    }

    public function editStaff($id)
    {
        $staff_edit=User::find($id);
       //dd($teacher_edit);
        $staff_additional_info=StaffAdditionalInfo::where('user_id',$id)->first();
        $StaffDocumentChecklist=StaffDocumentChecklist::where('user_id',$id)->first();
        return view('backend.users.staff.editStaff',compact('staff_edit','staff_additional_info','StaffDocumentChecklist'));
    }

    protected function staffupdateValidate($request){
        $validated = $request->validate([
            'name' => 'required',
            'email'=>'required',
            'password' => 'required|min:6',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }

    protected function staffupdateValidate_new($request){
        $validated = $request->validate([
            'name' => 'required',
            'email'=>'required|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);

    }

    protected function staffProfileImageUpload($request){

        $staff_profile_pic = $request->file('staff_profile_pic');
        $image = Image::make($staff_profile_pic);
        $fileType = $staff_profile_pic->getClientOriginalExtension();
        $imageName = 'staff_' .time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/staff/';
        $imageUrl = $directory.$imageName;
        $image->save($imageUrl);

        return $imageName;
    }

    public function updateBasicInfoStaff(Request $request)
    {
        $id=$request->user_id;

        $user=User::find($id)->toArray();

        if($user['email'] == $request->email)
        {
            $this->staffupdateValidate($request);
        }
        else
        {
            $this->staffupdateValidate_new($request);
        }

 
        $staff_profile_pic = $request->file('staff_profile_pic');
        $user_info = user::find($request->user_id);
        if($staff_profile_pic){
            //  $image_path=public_path().'/images/staff/'.$user_info->user_Image;
            //  if (File::exists($image_path)) {
            //      unlink($image_path);
            //  }
           $imageUrl = $this->staffProfileImageUpload($request);
        }

        $user=User::find($id); 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->phone;
        $user->gender = $request->gender;
        $user->user_Image = (isset($imageUrl))?$imageUrl:$user_info->user_Image;
        $user->save();

        return redirect()->route('backend.staff.index')->with('success', 'Successfully Updated');
    }


    protected function update_StaffAdditionalInfo_Info_validation($request){
        $request->validate([
            'first_name' => 'required',
            'last_name'=>'required',
            'date_of_birth' => 'required',
            'whatsapp' => 'required',
            'blood_group'=>'required',
            'present_address' => 'required',
            'permanent_address'=>'required'
        ]);
    }

    public function staff_additional_info_update(Request $request)
    {
        //dd($request->all());
        $this->update_StaffAdditionalInfo_Info_validation($request);
        $data=$request->except('_token');
        StaffAdditionalInfo::where('user_id',$request->user_id)->update($data);
        return redirect()->route('backend.staff.index')->with('success', 'Successfully Updated'); 
    }

    public function staff_document_checklist_update(Request $request)
    {
        $data=$request->except('_token');
        StaffDocumentChecklist::where('user_id',$request->user_id)->update($data);
        return redirect()->route('backend.staff.index')->with('success','Successfully Updated');
    }
}
