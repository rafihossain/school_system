<?php

namespace App\Traits;

use App\Events\Backend\UserCreated;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\ParentDocumentChecklist;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocumentChecklist;
use App\Models\TeacherDocumentChecklist;
use App\Models\StaffDocumentChecklist;
use App\Models\OperatorAdditionalInfo;
use App\Models\OperatorDocumentChecklist;

trait UserRollPermissionTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */

    public function user_input_field_validation($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|min:11',
            'gender' => 'required'
        ]);
    }
    public function create_teacher_user($request){
        $this->user_input_field_validation($request);

        Str::singular('users');
        $user = $request->except('_token', 'roles', 'permissions', 'password_confirmation');
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->phone;
        $user->gender = $request->gender;
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
    }
    public function create_student_user($request){
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

        Str::singular('users');
        $user = $request->except('_token', 'roles', 'permissions', 'password_confirmation');

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->first_name = '';
        $user->last_name = '';
        $user->user_role = 5;
        $user->save();

        $Student = new $this->Student();
        $Student->user_id = $user->id;
        $Student->session_id = Session::get('session_id');
        $Student->section_id = $request->section_id;
        $Student->class_id = $request->class_id;
        $Student->parent_id = $request->parent_id;
        $Student->roll_no = $request->roll_no;
        $Student->admission_date = $request->admission_date;
        $Student->department_id = $request->department_id;
        $Student->save();

        $StudentAdditionalInfo = new StudentAdditionalInfo();
        $StudentAdditionalInfo->user_id = $user->id;
        $StudentAdditionalInfo->save();

        $StudentDocumentChecklist = new StudentDocumentChecklist();
        $StudentDocumentChecklist->user_id = $user->id;
        $StudentDocumentChecklist->save();

        $this->userRollPermission($request, $user);
    }
    public function create_staff_user($request){
        $this->user_input_field_validation($request);

        Str::singular('users');
        $user = $request->except('_token', 'roles', 'permissions', 'password_confirmation');

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->phone;
        $user->gender = $request->gender;
        $user->first_name = '';
        $user->last_name = '';
        $user->user_role = 7;
        $user->save();

        $StaffAdditionalInfo = new $this->Staff();
        $StaffAdditionalInfo->user_id = $user->id;
        $StaffAdditionalInfo->save();

        $StaffDocumentChecklist = new StaffDocumentChecklist();
        $StaffDocumentChecklist->user_id = $user->id;
        $StaffDocumentChecklist->save();

        $this->userRollPermission($request, $user);
    }
    public function create_operator_user($request){
        $this->user_input_field_validation($request);

        Str::singular('users');
        $user = $request->except('_token', 'roles', 'permissions', 'password_confirmation');

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->phone;
        $user->gender = $request->gender;
        $user->first_name = '';
        $user->last_name = '';
        $user->user_role = 8;
        $user->save();

        $operatorAdditionalInfo = new OperatorAdditionalInfo();
        $operatorAdditionalInfo->user_id = $user->id;
        $operatorAdditionalInfo->save();

        $operatorDocumentChecklist = new OperatorDocumentChecklist();
        $operatorDocumentChecklist->user_id = $user->id;
        $operatorDocumentChecklist->save();

        $this->userRollPermission($request, $user);
    }
    public function create_parent_user($request){
        $this->user_input_field_validation($request);

        Str::singular('users');
        $user = $request->except('_token', 'roles', 'permissions', 'password_confirmation');
        $user = new User();
        $user->name = $request->name;
        $user->first_name = '';
        $user->last_name = '';
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->phone;
        $user->gender = $request->gender;
        $user->user_role = 4;
        $user->save();

        $AdditionalInfo = new $this->Parent();
        $AdditionalInfo->user_id = $user->id;
        $AdditionalInfo->save();

        $ParentDocumentChecklist = new ParentDocumentChecklist();
        $ParentDocumentChecklist->user_id = $user->id;
        $ParentDocumentChecklist->save();

        $this->userRollPermission($request, $user);
    }
    public function userRollPermission($request, $user) {

        if ($request->confirmed == 1) {
            $roles = Role::select('name')->where('id', 8)->get()->toArray();
            $permissions = Permission::select('name')->whereIn('id', [1, 40])->get()->toArray();
        } else {
            $roles = Role::select('name')->where('id', 7)->get()->toArray();
            $permissions = Permission::select('name')->whereIn('id', [1, 39])->get()->toArray();
        }
        $permission = array();
        $role = array();
        foreach ($roles as $getrole) {
            $role[] = $getrole['name'];
        }
        foreach ($permissions as $getper) {
            $permission[] = $getper['name'];
        }
        $module_name_singular = Str::singular('user');
        if (isset($roles)) {
            $$module_name_singular->syncRoles($roles);
        } else {
            $roles = [];
            $$module_name_singular->syncRoles($roles);
        }
        // Sync Permissions
        if (isset($permissions)) {
            $$module_name_singular->syncPermissions($permissions);
        } else {
            $permissions = [];
            $$module_name_singular->syncPermissions($permissions);
        }
        // Username
        $id = $$module_name_singular->id;
        $username = config('app.initial_username') + $id;
        $$module_name_singular->username = $username;
        $$module_name_singular->save();

        event(new UserCreated($$module_name_singular));
    }


}