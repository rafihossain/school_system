<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use App\Models\TimeZone;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Events\Backend\UserCreated;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Image;
use File;
use Illuminate\Support\Facades\DB;

class UserManageController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:editor_permission');
        $this->module_name = 'users';
    }

    protected function userValidate($request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
    }

    protected function userupdateValidate($request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
    }

    protected function userupdatenewValidate($request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
    }

    protected function userImageUpload($request)
    {
        $profile_image = $request->file('profile_image');
        $image = Image::make($profile_image);
        $fileType = $profile_image->getClientOriginalExtension();
        $imageName = 'user_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/user/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        $thumbnail = $directory . "thumbnail/" . $imageName;
        $image->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnail);

        return $imageName;
    }

    public function manageUsers()
    {
        // dd(11);

        $manageUsers = User::with('role')->get();
        // dd($manageUsers);

        $roles = Role::get();
        return view('backend.users.users-list', [
            'manageUsers' => $manageUsers,
            'roles' => $roles,
        ]);
    }

    public function createUsers()
    {
        $roles = Role::get();

        return view('backend.users.users-create', [
            'roles' => $roles,
        ]);
    }

    public function saveUsers(Request $req)
    {
        //For Validation--------------
        $this->userValidate($req);

        $module_name = $this->module_name;
        $module_name_singular = Str::singular($module_name);

        $data_array = $req->except('_token', 'roles', 'permissions', 'password_confirmation');
        $data_array['name'] = $req->first_name;
        $data_array['first_name'] = $req->first_name;
        $data_array['last_name'] = $req->last_name;
        $data_array['mobile'] = $req->phone;
        $data_array['user_role'] = $req->role;

        if($req->file('profile_image')){
            $imageUrl = $this->userImageUpload($req);
            $data_array['profile_image'] = $imageUrl;
        }
        $data_array['password'] = Hash::make($req->password);
        $user =User::create($data_array);
        $this->userRollPermission($req, $user);
        return response()->json(['success'=>'Successfully Inserted']);
    }

    public function all_users()
    {
        $user = User::whereIn('user_type', [2, 3, 4])->get()->toArray();
        return view('backend.users.all_users', compact('user'));
    }

    public function editUsers($id)
    {
        $roles = Role::get();
        $user = User::find($id);
        return view('backend.users.users-edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function updateUsers(Request $req)
    {
        // echo "<pre>"; print_r($_POST); die();

        $user_id = $req->id;
        $password = $req->password;
        $re_password = $req->confirm_password;

        $user = User::find($user_id)->toArray();
        // dd($user);


        if ($user['email'] == $req->email) {
            $this->userupdateValidate($req);
        } else {
            $this->userupdatenewValidate($req);
        }

        if (($password != '') && ($re_password != '')) {
            // echo 11; die();
            if ($password == $re_password) {
                // echo 22; die();
                $profile_image = $req->file('profile_image');

                if ($profile_image) {
                    $users = User::find($user_id)->toArray();
                    if ($users['profile_image'] != '') {

                        if (File::exists('admin/image/user/' . $users['profile_image'])) {
                            unlink('admin/image/user/' . $users['profile_image']);
                        }
                        if (File::exists('admin/image/user/thumbnail/' . $users['profile_image'])) {
                            unlink('admin/image/user/thumbnail/' . $users['profile_image']);
                        }
                    }
                    $imageUrl = $this->userImageUpload($req);
                    $user = User::find($user_id);
                    $user->name = $req->user_name;
                    $user->first_name = $req->user_name;
                    $user->last_name = $req->user_name;
                    $user->email = $req->user_email;
                    $user->mobile = $req->user_phone;
                    $user->user_role = $req->user_role;
                    $user->profile_image = $imageUrl;
                    $user->password = Hash::make($req->password);
                    $user->save();
                } else {
                    // echo 33; die();
                    $user = User::find($user_id);

                    $user->name = $req->first_name;
                    $user->first_name = $req->first_name;
                    $user->last_name = $req->last_name;
                    $user->email = $req->email;
                    $user->user_role = $req->role;
                    $user->mobile = $req->phone;
                    $user->position = $req->position_title;
                    $user->password = Hash::make($req->password);
                    $user->office_id = $req->office;
                    $user->save();
                }

                return redirect('admin/users/list')->with('success', 'Successfully Updated');
            } else {
                return redirect('admin/users/edit/'. $user_id)->with('do_not_match', 'Password did not match');
            }
        } else {
            $profile_image = $req->file('profile_image');

            if ($profile_image) {

                $users = User::find($user_id)->toArray();
                if ($users['profile_image'] != '') {

                    if (File::exists('admin/image/user/' . $users['profile_image'])) {
                        unlink('admin/image/user/' . $users['profile_image']);
                    }
                    if (File::exists('admin/image/user/thumbnail/' . $users['profile_image'])) {
                        unlink('admin/image/user/thumbnail/' . $users['profile_image']);
                    }
                }
                $imageUrl = $this->userImageUpload($req);
                $user = User::find($user_id);
                $user->name = $req->user_name;
                $user->first_name = $req->user_name;
                $user->last_name = $req->user_name;
                $user->email = $req->user_email;
                $user->mobile = $req->user_phone;
                $user->status = $req->user_role;
                $user->profile_image = $imageUrl;
                $user->save();
            } else {
                // echo 11; die();
                $user = User::find($user_id);
                $user->name = $req->first_name;
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->user_role = $req->role;
                $user->mobile = $req->phone;
                $user->save();
            }

            return redirect('admin/users/list')->with('success', 'Successfully Updated');
        }
    }

    public function deleteUsers($id)
    {
        $data = User::find($id);

        if ($data->profile_image != '') {

            if (File::exists('admin/image/user/' . $data->profile_image)) {
                unlink('admin/image/user/' . $data->profile_image);
            }
            if (File::exists('admin/image/user/thumbnail/' . $data->profile_image)) {
                unlink('admin/image/user/thumbnail/' . $data->profile_image);
            }
        }
        DB::table('users')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');
    }

    public function usersdetails($id)
    {
        $user=User::with('clients','office','role')->find($id)->toArray();
        // echo "<pre>";
        // print_r($user);die();
        return view('backend.users.usersdetails',compact('user'));
    }

    public function user_datetime($id)
    {
        $user=User::with('clients','office','role')->find($id)->toArray();
        $timezone=TimeZone::get()->toArray();
        return view('backend.users.usersdate_time',compact('user','timezone'));
    }

    public function user_timezone_save(Request $req,$id)
    {
        $req->validate([
            'user_timezone' => 'required',
        ]);

        $data['user_timezone']=$req->user_timezone;
        User::where('id',$id)->update($data);
        return redirect()->back()->with('success', 'Successfully updated');
    }

}
