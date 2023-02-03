<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes
require __DIR__.'/auth.php';

// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

//Route::get('dashboard', 'App\Http\Controllers\Frontend\FrontendController@index')->name('dashboard');
/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', 'FrontendController@index')->name('index');
    Route::get('home', 'FrontendController@index')->name('home');
    Route::get('privacy', 'FrontendController@privacy')->name('privacy');
    Route::get('terms', 'FrontendController@terms')->name('terms');

    Route::group(['middleware' => ['auth']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('profile/{id}', ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
        Route::get('profile/{id}/edit', ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
        Route::patch('profile/{id}/edit', ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
        Route::get('profile/changePassword/{username}', ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
        Route::patch('profile/changePassword/{username}', ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
        Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
        Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
    });
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/

Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.','middleware' => 
['auth', 'permission:view_backend']], function () {

    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');


    /*===============================================================
                    New Dashboard Section
    =================================================================*/
    Route::get('add-user-modal', 'BackendController@add_user_modal')->name('add-user-modal');
    Route::post('user-save-class', 'BackendController@user_save_class')->name('user-save-class');
    Route::post('admin-save-class', 'BackendController@admin_save_class')->name('admin-save-class');
    Route::post('admin-save-parent', 'BackendController@admin_save_parent')->name('admin-save-parent');
    Route::get('admin-parent-search', 'BackendController@admin_parent_search')->name('admin-parent-search');
    
    Route::post('admin-save-section', 'BackendController@admin_save_section')->name('admin-save-section');
    Route::post('admin-save-student', 'BackendController@admin_save_student')->name('admin-save-student');
    Route::post('admin-save-department', 'BackendController@admin_save_department')->name('admin-save-department');
    Route::post('admin-save-teacher', 'BackendController@admin_save_teacher')->name('admin-save-teacher');
    Route::post('admin-save-staff', 'BackendController@admin_save_staff')->name('admin-save-staff');
    Route::post('admin-save-operator', 'BackendController@admin_save_operator')->name('admin-save-operator');
    
    Route::get('add-attendence-modal', 'BackendController@add_attendence_modal')->name('add-attendence-modal');

    Route::post('admin-showstudent-attendencelist', 'BackendController@admin_showstudent_attendencelist')
    ->name('admin-showstudent-attendencelist');
    Route::post('admin-showteacher-attendencelist', 'BackendController@admin_showteacher_attendencelist')
    ->name('admin-showteacher-attendencelist');

    Route::get('open-routine-modal', 'BackendController@open_routine_modal')->name('open-routine-modal');
    Route::get('open-examschedule-modal', 'BackendController@open_examschedule_modal')->name('open-examschedule-modal');

    //routine
    Route::post('add-routine-class', 'BackendController@add_routine_class')->name('add-routine-class');
    Route::post('add-routine-section', 'BackendController@add_routine_section')->name('add-routine-section');
    
    Route::post('admin-routine-class', 'BackendController@admin_routine_class')->name('admin-routine-class');

    Route::post('admin-save-subject', 'BackendController@admin_save_subject')->name('admin-save-subject');
    Route::post('admin-save-classroom', 'BackendController@admin_save_classroom')->name('admin-save-classroom');
    Route::post('routine-save-teacher', 'BackendController@routine_save_teacher')->name('routine-save-teacher');

    //routine
    Route::post('exam-save-examschedule', 'BackendController@exam_save_examschedule')->name('exam-save-examschedule');
    
    Route::post('class-save-examschedule', 'BackendController@class_save_examschedule')->name('class-save-examschedule');
    Route::post('exam-schedule-class', 'BackendController@exam_schedule_class')->name('exam-schedule-class');

    Route::post('classroom-save-examschedule', 'BackendController@classroom_save_examschedule')->name('classroom-save-examschedule');
    Route::post('save-examschedule-section', 'BackendController@save_examschedule_section')->name('save-examschedule-section');
    Route::post('save-examschedule-subject', 'BackendController@save_examschedule_subject')->name('save-examschedule-subject');

    Route::post('save-examschedule-info', 'BackendController@save_examschedule_info')->name('save-examschedule-info');

    //syllabus
    Route::get('open-syllabus-modal', 'BackendController@open_syllabus_modal')->name('open-syllabus-modal');
    Route::post('add-syllabus-class', 'BackendController@add_syllabus_class')->name('add-syllabus-class');

    Route::post('save-syllabus-class', 'BackendController@save_syllabus_class')->name('save-syllabus-class');
    Route::post('save-syllabus-section', 'BackendController@save_syllabus_section')->name('save-syllabus-section');
    Route::post('save-syllabus-subject', 'BackendController@save_syllabus_subject')->name('save-syllabus-subject');
    Route::post('save-syllabus-info', 'BackendController@save_syllabus_info')->name('save-syllabus-info');
    
    //fee
    Route::get('open-fee-modal', 'BackendController@open_fee_modal')->name('open-fee-modal');
    
    Route::post('add-fee-class', 'BackendController@add_fee_class')->name('add-fee-class');

    Route::post('save-fee-class', 'BackendController@save_fee_class')->name('save-fee-class');
    Route::post('save-fee-feetype', 'BackendController@save_fee_feetype')->name('save-fee-feetype');
    Route::post('save-fee-section', 'BackendController@save_fee_section')->name('save-fee-section');

    Route::post('save-feebasic-info', 'BackendController@save_feebasic_info')->name('save-feebasic-info');
    Route::get('class-response', 'BackendController@class_response')->name('class-response');
    Route::get('section-response', 'BackendController@section_response')->name('section-response');

    /*===============================================================
                    Academic Section
    =================================================================*/
    
    //session
    Route::get('session/list', ['as' => "manage-session", 'uses' => "SettingController@manage_session"]);
    Route::get('session/add', ['as' => "add-session", 'uses' => "SettingController@add_session"]);
    Route::post('session/save', ['as' => "save-session", 'uses' => "SettingController@save_session"]);
    Route::get('session/edit/{id}', ['as' => "edit-session", 'uses' => "SettingController@edit_session"]);
    Route::post('session/update', ['as' => "update-session", 'uses' => "SettingController@update_session"]);
    Route::get('session/delete/{id}', ['as' => "delete-session", 'uses' => "SettingController@delete_session"]);

    //class
    Route::get('class/list', ['as' => "manage-class", 'uses' => "SettingController@manage_class"]);
    Route::get('class/add', ['as' => "add-class", 'uses' => "SettingController@add_class"]);
    Route::post('class/save', ['as' => "save-class", 'uses' => "SettingController@save_class"]);
    Route::get('class/edit/{id}', ['as' => "edit-class", 'uses' => "SettingController@edit_class"]);
    Route::post('class/update', ['as' => "update-class", 'uses' => "SettingController@update_class"]);
    Route::get('class/delete/{id}', ['as' => "delete-class", 'uses' => "SettingController@delete_class"]);
    Route::get('class/archive/list', ['as' => "class-archive-list", 'uses' => "SettingController@class_archive_list"]);
    
    Route::get('class/restore/{id}', ['as' => "class-restore", 'uses' => "SettingController@class_restore"]);

    //section
    Route::get('section/list', ['as' => "manage-section", 'uses' => "SettingController@manage_section"]);
    Route::get('section/add', ['as' => "add-section", 'uses' => "SettingController@add_section"]);
    Route::post('section/save', ['as' => "save-section", 'uses' => "SettingController@save_section"]);
    Route::get('section/edit/{id}', ['as' => "edit-section", 'uses' => "SettingController@edit_section"]);
    Route::post('section/update', ['as' => "update-section", 'uses' => "SettingController@update_section"]);
    Route::get('section/delete/{id}', ['as' => "delete-section", 'uses' => "SettingController@delete_section"]);

    //classroom
    Route::get('classroom/list', ['as' => "manage-classroom", 'uses' => "SettingController@manage_classroom"]);
    Route::get('classroom/add', ['as' => "add-classroom", 'uses' => "SettingController@add_classroom"]);
    Route::post('classroom/save', ['as' => "save-classroom", 'uses' => "SettingController@save_classroom"]);
    Route::get('classroom/edit/{id}', ['as' => "edit-classroom", 'uses' => "SettingController@edit_classroom"]);
    Route::post('classroom/update', ['as' => "update-classroom", 'uses' => "SettingController@update_classroom"]);
    Route::get('classroom/delete/{id}', ['as' => "delete-classroom", 'uses' => "SettingController@delete_classroom"]);

    //subject
    Route::get('subject/list', ['as' => "manage-subject", 'uses' => "SettingController@manage_subject"]);
    Route::get('subject/add', ['as' => "add-subject", 'uses' => "SettingController@add_subject"]);
    Route::post('subject/save', ['as' => "save-subject", 'uses' => "SettingController@save_subject"]);
    Route::get('subject/edit/{id}', ['as' => "edit-subject", 'uses' => "SettingController@edit_subject"]);
    Route::post('subject/update', ['as' => "update-subject", 'uses' => "SettingController@update_subject"]);
    Route::get('subject/delete/{id}', ['as' => "delete-subject", 'uses' => "SettingController@delete_subject"]);

    //subject-class
    Route::get('subject/class/list', ['as' => "manage-subject-class", 'uses' => "SettingController@manage_subject_class"]);
    Route::get('subject/class/add', ['as' => "add-subject-class", 'uses' => "SettingController@add_subject_class"]);
    Route::post('subject/class/save', ['as' => "save-subject-class", 'uses' => "SettingController@save_subject_class"]);
    Route::get('subject/class/edit/{id}', ['as' => "edit-subject-class", 'uses' => "SettingController@edit_subject_class"]);
    Route::post('subject/class/update', ['as' => "update-subject-class", 'uses' => "SettingController@update_subject_class"]);
    Route::get('subject/class/delete/{id}', ['as' => "delete-subject-class", 'uses' => "SettingController@delete_subject_class"]);

    Route::post('get-section-info', ['as' => "get-section-info", 'uses' => "SettingController@get_section_info"]);
    Route::post('get-subject-info', ['as' => "get-subject-info", 'uses' => "SettingController@get_subject_info"]);
    Route::post('subject-list', ['as' => "subject-list", 'uses' => "SettingController@subject_info"]);
    
    //class-teacher
    Route::get('class/teacher/list', ['as' => "manage-class-teacher", 'uses' => "SettingController@manage_class_teacher"]);
    Route::get('class/teacher/add', ['as' => "add-class-teacher", 'uses' => "SettingController@add_class_teacher"]);
    Route::post('class/teacher/save', ['as' => "save-class-teacher", 'uses' => "SettingController@save_class_teacher"]);
    Route::get('class/teacher/edit/{id}', ['as' => "edit-class-teacher", 'uses' => "SettingController@edit_class_teacher"]);
    Route::post('class/teacher/update', ['as' => "update-class-teacher", 'uses' => "SettingController@update_class_teacher"]);
    Route::get('class/teacher/delete/{id}', ['as' => "delete-class-teacher", 'uses' => "SettingController@delete_class_teacher"]);
    
    //class-routine
    Route::get('class/routine/list', ['as' => "manage-class-routine", 'uses' => "SettingController@manage_class_routine"]);
    Route::post('class-routine-save', ['as' => "save-class-routine", 'uses' => "SettingController@save_class_routine"]);

    Route::post('class-routine-delete', ['as' => "delete-class-routine", 'uses' => "SettingController@delete_class_routine"]);
    Route::post('show-subject-routine', ['as' => "show-subject-routine", 'uses' => "SettingController@show_subject_routine"]);
    Route::get('preview-subject-routine', ['as' => "preview-subject-routine", 'uses' => "SettingController@preview_subject_routine"]);
    Route::post('routine-overwrite-check', ['as' => "routine-overwrite-check", 'uses' => "SettingController@routine_overwrite_check"]);

    Route::get('class-routine-edit', ['as' => "edit-class-routine", 'uses' => "SettingController@edit_class_routine"]);
    Route::post('class-routine-update', ['as' => "update-class-routine", 'uses' => "SettingController@update_class_routine"]);
    Route::post('routine-overwrite-check-update', ['as' => "routine-overwrite-check-update", 'uses' => "SettingController@routine_overwrite_check_update"]);
    
    /*===============================================================
                    Setting Section
    =================================================================*/
    //designation
    Route::get('designation/list', ['as' => "manage-designation", 'uses' => "SettingController@manage_designation"]);
    Route::get('designation/add', ['as' => "add-designation", 'uses' => "SettingController@add_designation"]);
    Route::post('designation/save', ['as' => "save-designation", 'uses' => "SettingController@save_designation"]);
    Route::get('designation/edit/{id}', ['as' => "edit-designation", 'uses' => "SettingController@edit_designation"]);
    Route::post('designation/update', ['as' => "update-designation", 'uses' => 'SettingController@update_designation']);
    Route::get('designation/delete/{id}', ['as' => "delete-designation", 'uses' => "SettingController@delete_designation"]);

    Route::get('designation/archive/list', ['as' => "designation-archive-list", 'uses' => "SettingController@designation_archive_list"]);
    
    Route::get('designation/restore/{id}', ['as' => "designation-restore", 'uses' => "SettingController@designation_restore"]);

    //department
    Route::get('department/list', ['as' => "manage-department", 'uses' => "SettingController@manage_department"]);
    Route::get('department/add', ['as' => "add-department", 'uses' => "SettingController@add_department"]);
    Route::post('department/save', ['as' => "save-department", 'uses' => "SettingController@save_department"]);
    Route::get('department/edit/{id}', ['as' => "edit-department", 'uses' => "SettingController@edit_department"]);
    Route::post('department/update', ['as' => "update-department", 'uses' => "SettingController@update_department"]);
    Route::get('department/delete/{id}', ['as' => "delete-department", 'uses' => "SettingController@delete_department"]);

    Route::get('department/archive/list', ['as' => "department-archive-list", 'uses' => "SettingController@department_archive_list"]);
    
    Route::get('department/restore/{id}', ['as' => "department-restore", 'uses' => "SettingController@department_restore"]);

    //syllabus
    Route::get('syllabus/list', ['as' => "manage-syllabus", 'uses' => "SettingController@manage_syllabus"]);
    Route::get('syllabus/add', ['as' => "add-syllabus", 'uses' => "SettingController@add_syllabus"]);
    Route::post('syllabus/save', ['as' => "save-syllabus", 'uses' => "SettingController@save_syllabus"]);
    Route::get('syllabus/edit/{id}', ['as' => "edit-syllabus", 'uses' => "SettingController@edit_syllabus"]);
    Route::post('syllabus/update', ['as' => "update-syllabus", 'uses' => "SettingController@update_syllabus"]);
    Route::get('syllabus/delete/{id}', ['as' => "delete-syllabus", 'uses' => "SettingController@delete_syllabus"]);

    Route::post('delete-syllabus-image', ['as' => "delete-syllabus-image", 'uses' => "SettingController@delete_syllabus_image"]);
    
    //Homework------------------------
    Route::get('homework', "SettingController@manage_homeWork")->name("manage-homework");
    Route::post('homework-save', "SettingController@homeWorkSave")->name("homework-save");

    Route::post('show-student-homework', "SettingController@show_student_homework")->name("show-student-homework");
    Route::get('edit-student-homework', "SettingController@edit_student_homework")->name("edit-student-homework");
    Route::post('update-student-homework', "SettingController@update_student_homework")->name("update-student-homework");
    Route::post('delete-student-homework', "SettingController@delete_student_homework")->name("delete-student-homework");
    
    
    /*===============================================================
                    Accounting Section
    =================================================================*/

    //fee-type
    Route::get('feetype/list', ['as' => "manage-feetype", 'uses' => "AccountController@manage_feetype"]);
    Route::get('feetype/add', ['as' => "add-feetype", 'uses' => "AccountController@add_feetype"]);
    Route::post('feetype/save', ['as' => "save-feetype", 'uses' => "AccountController@save_feetype"]);
    Route::get('feetype/edit/{id}', ['as' => "edit-feetype", 'uses' => "AccountController@edit_feetype"]);
    Route::post('feetype/update', ['as' => "update-feetype", 'uses' => "AccountController@update_feetype"]);
    Route::get('feetype/delete/{id}', ['as' => "delete-feetype", 'uses' => "AccountController@delete_feetype"]);

    //fee
    Route::get('fee/list', ['as' => "manage-fee", 'uses' => "AccountController@manage_fee"]);
    Route::get('fee/add', ['as' => "add-fee", 'uses' => "AccountController@add_fee"]);
    Route::post('fee/save', ['as' => "save-fee", 'uses' => "AccountController@save_fee"]);
    Route::get('fee/edit/{id}', ['as' => "edit-fee", 'uses' => "AccountController@edit_fee"]);
    Route::post('fee/update', ['as' => "update-fee", 'uses' => "AccountController@update_fee"]);

    Route::post('get-fees-list', ['as' => "get-fees-list", 'uses' => "AccountController@get_fees_list"]);
    Route::post('set-fee-mark-paid', ['as' => "set-fee-mark-paid", 'uses' => "AccountController@set_fee_mark_paid"]);
    Route::post('fee/delete', ['as' => "delete-fee", 'uses' => "AccountController@delete_fee"]);


    //expense-type
    Route::get('expense/type/list', ['as' => "manage-expense-type", 'uses' => "AccountController@manage_expense_type"]);
    Route::get('expense/type/add', ['as' => "add-expense-type", 'uses' => "AccountController@add_expense_type"]);
    Route::post('expense/type/save', ['as' => "save-expense-type", 'uses' => "AccountController@save_expense_type"]);
    Route::get('expense/type/edit/{id}', ['as' => "edit-expense-type", 'uses' => "AccountController@edit_expense_type"]);
    Route::post('expense/type/update', ['as' => "update-expense-type", 'uses' => "AccountController@update_expense_type"]);
    Route::get('expense/type/delete/{id}', ['as' => "delete-expense-type", 'uses' => "AccountController@delete_expense_type"]);

    //expense-list
    Route::get('expense/list', ['as' => "manage-expense", 'uses' => "AccountController@manage_expense"]);
    Route::get('expense/add', ['as' => "add-expense", 'uses' => "AccountController@add_expense"]);
    Route::post('expense/save', ['as' => "save-expense", 'uses' => "AccountController@save_expense"]);
    Route::get('expense/edit/{id}', ['as' => "edit-expense", 'uses' => "AccountController@edit_expense"]);
    Route::post('expense/update', ['as' => "update-expense", 'uses' => "AccountController@update_expense"]);
    Route::get('expense/delete/{id}', ['as' => "delete-expense", 'uses' => "AccountController@delete_expense"]);
    
    /*===============================================================
                    Announcement Section
    =================================================================*/
    
    //announcement
    Route::get('manage-message', "AnnouncementController@manage_message")->name('manage-message');
    Route::post('save-notification', "AnnouncementController@save_notification")->name('save-notification');
    
    //send-mail
    Route::get('sendmail', "NotificationsController@send_mail")->name('send-mail');

    //calender
    Route::get('manage-calender', "AnnouncementController@manage_calender")->name('manage-calender');
    Route::get('show-events-list', "AnnouncementController@show_events_list")->name('show-events-list');
    Route::post('save-calender-event', "AnnouncementController@save_calender_event")->name('save-calender-event');
    Route::post('update-calender-event', "AnnouncementController@update_calender_event")->name('update-calender-event');
    Route::get('delete-calender-event', "AnnouncementController@delete_calender_event")->name('delete-calender-event');
    
    /*===============================================================
                    Users Section
    =================================================================*/

    Route::get('users/add', ['as' => "create-users", 'uses' => "UserManageController@createUsers"]);
    Route::get('users/list', ['as' => "manage-users", 'uses' => "UserManageController@manageUsers"]);
    Route::post('users/save', ['as' => 'save-users', 'uses' => 'UserManageController@saveUsers']);
    Route::get('users/edit/{id}', ['as' => 'edit-users', 'uses' => 'UserManageController@editUsers']);
    Route::post('users/update', ['as' => 'update-users', 'uses' => 'UserManageController@updateUsers']);
    Route::get('users/delete/{id}', ['as' => 'delete-users', 'uses' => 'UserManageController@deleteUsers']);
    Route::get('users/details/{id}', ['as' => "usersdetails", 'uses' => "UserManageController@usersdetails"]);
    Route::get('users/datetime/{id}', ['as' => "user_datetime", 'uses' => "UserManageController@user_datetime"]);
    Route::post('users/timezone/save/{id}', ['as' => "user_timezone_save", 'uses' => "UserManageController@user_timezone_save"]);

    //Parents------------------
    Route::get('parents', ['as' => "parents.index", 'uses' => "ParentsController@parentIndex"]);
    Route::get('add/parents', ['as' => "add.parents", 'uses' => "ParentsController@addParents"]);
    Route::post('save/parents', ['as' => "save.parents", 'uses' => "ParentsController@saveParents"]);
    Route::get('edit/parents/{id}', ['as' => "edit.parent", 'uses' => "ParentsController@editParents"]);
    Route::post('update/parents/basic/info', ['as' => "parent.basic_info_update", 'uses' => "ParentsController@updateBasicInfoParents"]);
    Route::post('update/parents/additional/info', ['as' => "parent.additional_info_update", 'uses' => "ParentsController@updateAdditionalInfoParents"]);
    Route::post('update/parent/document/checklist', ['as' => "parent.parent_document_checklist_update", 'uses' => "ParentsController@parent_document_checklist_update"]);
    Route::get('parents/delete/{id}', ['as' => "parent.delete", 'uses' => "ParentsController@parentDelete"]);
    Route::get('parents/search', ['as' => "parent.parent_search", 'uses' => "ParentsController@parentSearch"]);
    Route::get('parents/parent_additional_info_get', ['as' => "parent_additional_info", 'uses' => "ParentsController@parent_additional_info_get"]);
    Route::get('get_section', ['as' => "get_section", 'uses' => "ParentsController@get_section"]);
    Route::get('get_student', ['as' => "get_student", 'uses' => "ParentsController@get_student"]);

    Route::post('save-parent-csv', "ParentsController@save_parent_csv")->name("save-parent-csv");

    //Students------------------
    Route::get('student', ['as' => "student.index", 'uses' => "StudentController@studentIndex"]);
    Route::get('add/student', ['as' => "add.student", 'uses' => "StudentController@addStudent"]);
    Route::post('save/student', ['as' => "save.student", 'uses' => "StudentController@saveStudent"]);
    Route::get('edit/student/{id}', ['as' => "edit.student", 'uses' => "StudentController@editStudent"]);
    Route::post('update/student/basic/info', ['as' => "student.student_basic_info_update", 'uses' => "StudentController@updateBasicInfoStudent"]);
    Route::post('update/student/addition/info', ['as' => "student.student_additional_info_update", 'uses' => "StudentController@student_additional_info_update"]);
    Route::post('update/student/document/checklist', ['as' => "student.student_document_checklist_update", 'uses' => "StudentController@student_document_checklist_update"]);
    Route::get('student/delete/{id}', ['as' => "student.delete", 'uses' => "StudentController@studentDelete"]);

    Route::post('save-student-csv', "StudentController@save_student_csv")->name("save-student-csv");

    //Teacher----------------------
    Route::get('teacher', ['as' => "teacher.index", 'uses' => "TeacherController@teacherIndex"]);
    Route::get('add/teacher', ['as' => "add.teacher", 'uses' => "TeacherController@addTeacher"]);
    Route::post('save/teacher', ['as' => "save.teacher", 'uses' => "TeacherController@saveTeacher"]);
    Route::get('teacher/delete/{id}', ['as' => "teacher.delete", 'uses' => "TeacherController@teacherDelete"]);
    Route::get('edit/teacher/{id}', ['as' => "edit.teacher", 'uses' => "TeacherController@editTeacher"]);
    Route::post('update/teacher/basic/info', ['as' => "teacher.basic_info_update", 'uses' => "TeacherController@updateBasicInfoTeacher"]);
    Route::post('update/teacher/addition/info', ['as' => "teacher.teacher_additional_info_update", 'uses' => "TeacherController@teacher_additional_info_update"]);
    Route::post('update/teacher/document/checklist', ['as' => "teacher.teacher_document_checklist_update", 'uses' => "TeacherController@teacher_document_checklist_update"]);

    Route::post('save-teacher-csv', "TeacherController@save_teacher_csv")->name("save-teacher-csv");

    //Staff-----------------------
    Route::get('staff', ['as' => "staff.index", 'uses' => "StaffController@staffIndex"]);
    Route::get('add/staff', ['as' => "add.staff", 'uses' => "StaffController@addStaff"]);
    Route::post('save/staff', ['as' => "save.staff", 'uses' => "StaffController@saveStaff"]);
    Route::get('staff/delete/{id}', ['as' => "staff.delete", 'uses' => "StaffController@staffDelete"]);
    Route::get('edit/staff/{id}', ['as' => "edit.staff", 'uses' => "StaffController@editStaff"]);
    Route::post('update/staff/basic/info', ['as' => "staff.basic_info_update", 'uses' => "StaffController@updateBasicInfoStaff"]);
    Route::post('update/staff/additional/info', ['as' => "staff.staff_additional_info_update", 'uses' => "StaffController@staff_additional_info_update"]);
    Route::post('update/staff/document/info', ['as' => "staff.staff_document_checklist_update", 'uses' => "StaffController@staff_document_checklist_update"]);

    //Operator-----------------------
    Route::get("operator", "OperatorController@manage_operator")->name("manage-operator");
    Route::get("operator/add", "OperatorController@add_operator")->name("add-operator");
    Route::post("operator/save", "OperatorController@save_operator")->name("save-operator");
    Route::get("operator/edit/{id}", "OperatorController@edit_operator")->name("edit-operator");
    Route::post("operator/update", "OperatorController@update_operator")->name("update-operator");
    Route::get("operator/delete/{id}", "OperatorController@delete_operator")->name("delete-operator");

    Route::post('update/operator/basic/info', "OperatorController@update_basicinfo_operator")->name("update-basicinfo-operator");
    Route::post('update/operator/additional/info', "OperatorController@update_additionalinfo_operator")->name("update-additionalinfo-operator");
    Route::post('update/operator/document/info', "OperatorController@update_document_checklist_operator")->name("update-document-checklist-operator");

    /*===============================================================
                    Exam Section 
    =================================================================*/
    
    Route::get('exam/list', ['as' => "exam.list", 'uses' => "ExamController@examList"]);
    Route::post('exam/create', ['as' => "create.exam", 'uses' => "ExamController@createExam"]);
    Route::get('exam/edit', ['as' => "edit.exam", 'uses' => "ExamController@editExam"]);
    Route::post('exam/update', ['as' => "update.exam", 'uses' => "ExamController@updateExam"]);
    Route::get('exam/delete', ['as' => "delete.exam", 'uses' => "ExamController@deleteExam"]);
    
   //Schedule-------------------------
    Route::get('exam/schedule', ['as' => "schedule.index", 'uses' => "ExamController@scheduleIndex"]);
    Route::get('exam/schedule/create', ['as' => "schedule.create", 'uses' => "ExamController@scheduleCreate"]);
    Route::get('get_section_subject', ['as' => "get_section_subject", 'uses' => "ExamController@get_section_subject"]);
    Route::post('exam/schedule/save', ['as' => "schedule.save", 'uses' => "ExamController@scheduleSave"]);
    Route::get('get_exam', ['as' => "get_exam", 'uses' => "ExamController@getExam"]);
    Route::get('exam/schedule/edit/{id}', ['as' => "schedule.edit", 'uses' => "ExamController@scheduleEdit"]);
    Route::post('exam/schedule/update', ['as' => "schedule.update", 'uses' => "ExamController@scheduleUpdate"]);
    Route::get('exam/schedule/delete/{id}', ['as' => "schedule.delete", 'uses' => "ExamController@scheduleDelete"]);

    //Mark-----------------
    Route::get('exam/mark', ['as' => "mark.index", 'uses' => "ExamController@markIndex"]);
    Route::get('get_student_mark', ['as' => "get_student_mark", 'uses' => "ExamController@get_student_mark"]);
    Route::post('save_student_mark', ['as' => "save_student_mark", 'uses' => "ExamController@save_student_mark"]);
    
        //Result Rule-----------
    Route::get('exam/result-rule',['as' =>"result_rule.index", 'uses' => "ExamController@resultRuleIndex"]);
    Route::post('save_exam_result_rule', ['as' => "save.exam_result_rule", 'uses' => "ExamController@save_exam_result_rule"]);
    Route::get('edit_exam_result_rule', ['as' => "edit.exam_result_rule", 'uses' => "ExamController@edit_exam_result_rule"]);
    Route::post('update_exam_result_rule', ['as' => "update.exam_result_rule", 'uses' => "ExamController@update_exam_result_rule"]);
    Route::get('delete_exam_result_rule', ['as' => "delete.exam_result_rule", 'uses' => "ExamController@delete_exam_result_rule"]);


    //Exam Result---------------------
    Route::get('exam/result',['as' =>"exam.result", 'uses' => "ExamController@examResult"]);
    Route::get('get_student_exam_result',['as' =>"get_student_exam_result", 'uses' => "ExamController@get_student_exam_result"]);
    
    //Promotion---------------------
    Route::get('promotion',['as' =>"exam.promotion", 'uses' => "ExamController@examPromotion"]);
    Route::post('show_promotion_student_list',"StudentController@show_promotion_student_list")->name('show-promotion-student-list');
    
    //Report------------------------
    Route::get('report/student',['as' =>"report.student", 'uses' => "ReportController@reportStudent"]);
    Route::get('student/view/{id}',['as' =>"student.report.view", 'uses' => "ReportController@viewStudent"]);
    Route::get('get_student_report',['as' =>"get_student_report", 'uses' => "ReportController@get_student_report"]);
    Route::get('report/teacher',['as' =>"report.teacher", 'uses' => "ReportController@reportTeacher"]);
    Route::get('teacher/view/{id}',['as' =>"teacher.view", 'uses' => "ReportController@viewTeacher"]);
    Route::get('report/staff',['as' =>"report.staff", 'uses' => "ReportController@reportStaff"]);
    Route::get('staff/view/{id}',['as' =>"staff.view", 'uses' => "ReportController@viewStaff"]);
    Route::get('report/exam-routine',['as' =>"report.exam_routine", 'uses' => "ReportController@reportExamRoutine"]);
    Route::get('get_report_exam_routine',['as' =>"get_report_exam_routine", 'uses' => "ReportController@get_report_exam_routine"]);
    
    //Student Attendence Report-----------------
    Route::get('report/student-atttendance',['as' =>"report.student_attendence", 'uses' => "ReportController@student_attendence"]);        
    Route::get('get_student_attendence_report',['as' =>"get_student_attendence_report", 'uses' => "ReportController@get_student_attendence_report"]);
    
    //Teacher Attendence Report-----------------
    Route::get('report/teacher-atttendance',['as' =>"report.teacher_attendence", 'uses' => "ReportController@teacher_attendence"]);        
    Route::get('get_teacher_attendence_report',['as' =>"get_teacher_attendence_report", 'uses' => "ReportController@get_teacher_attendence_report"]);
    
    //class routine Report-----------
    Route::get('classroutine/report/list', "ReportController@classroutine_report_list")->name('classroutine-report-list');
    Route::get('routine-report-list', "ReportController@routine_report_list")->name('routine-report-list');
    Route::post('show-class-info', "ReportController@show_class_info")->name('show-class-info');
    
    
     //Attendence--------------------
      //Student---------
    Route::get('attendence/student', "AttendenceController@studentAttendence")->name('attendence.student');
    Route::get('get_student_attendence_list', "AttendenceController@get_student_attendence_list")->name('get_student_attendence_list');
    Route::post('save_student_attendance', "AttendenceController@save_student_attendance")->name('save_student_attendance');

      //Teacher---------
      Route::get('attendence/teacher', "AttendenceController@teacherAttendence")->name('attendence.teacher');
      Route::get('get_teacher_attendence_list', "AttendenceController@get_teacher_attendence_list")->name('get_teacher_attendence_list');
      Route::post('save_teacher_attendance', "AttendenceController@save_teacher_attendance")->name('save_teacher_attendance');
      
      
      /*===============================================================
                    System Setting Section
    =================================================================*/
    Route::get('system/setting/list', 'SystemsettingController@system_setting_list')->name('system-setting-list');
    //basic
    Route::post('basic-form-serialize', 'SystemsettingController@basic_form_serialize')->name('basic-form-serialize');
    //system
    Route::post('system-form-serialize', 'SystemsettingController@system_form_serialize')->name('system-form-serialize');
    //Route::post('theme-form-serialize', 'SystemsettingController@theme_form_serialize')->name('theme-form-serialize');

    //payment
    Route::post('paypal-payment-form', 'SystemsettingController@paypal_payment_form')->name('paypal-payment-form');
    Route::post('stripe-payment-form', 'SystemsettingController@stripe_payment_form')->name('stripe-payment-form');
    Route::post('razorpay-payment-form', 'SystemsettingController@razorpay_payment_form')->name('razorpay-payment-form');
    Route::post('paystack-payment-form', 'SystemsettingController@paystack_payment_form')->name('paystack-payment-form');
    

    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
    });

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/markAllAsRead", ['as' => "$module_name.markAllAsRead", 'uses' => "$controller_name@markAllAsRead"]);
    Route::delete("$module_name/deleteAll", ['as' => "$module_name.deleteAll", 'uses' => "$controller_name@deleteAll"]);
    Route::get("$module_name/{id}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/create", ['as' => "$module_name.create", 'uses' => "$controller_name@create"]);
    Route::get("$module_name/download/{file_name}", ['as' => "$module_name.download", 'uses' => "$controller_name@download"]);
    Route::get("$module_name/delete/{file_name}", ['as' => "$module_name.delete", 'uses' => "$controller_name@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("$module_name", "$controller_name");

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("$module_name/profile/{id}", ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
    Route::get("$module_name/profile/{id}/edit", ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
    Route::patch("$module_name/profile/{id}/edit", ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
    Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
    Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
    Route::get("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePassword", 'uses' => "$controller_name@changeProfilePassword"]);
    Route::patch("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePasswordUpdate", 'uses' => "$controller_name@changeProfilePasswordUpdate"]);
    Route::get("$module_name/changePassword/{id}", ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
    Route::patch("$module_name/changePassword/{id}", ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::resource("$module_name", "$controller_name");
    Route::patch("$module_name/{id}/block", ['as' => "$module_name.block", 'uses' => "$controller_name@block", 'middleware' => ['permission:block_users']]);
    Route::patch("$module_name/{id}/unblock", ['as' => "$module_name.unblock", 'uses' => "$controller_name@unblock", 'middleware' => ['permission:block_users']]);
});
