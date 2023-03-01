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
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/

Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.','middleware' => 
['auth', 'permission:view_backend']], function () {

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

    //routine
    // Route::post('admin_get_student_report', 'BackendController@student_report')->name('admin_get_student_report');

    /*===============================================================
                    Academic Section
    =================================================================*/
    
    //session
    Route::get('session/list', "AcademicController@manage_session")->name('manage-session');
    Route::get('session/add', "AcademicController@add_session")->name('add-session');
    Route::post('session/save', "AcademicController@save_session")->name('save-session');
    Route::get('session/edit', "AcademicController@edit_session")->name('edit-session');
    Route::post('session/update', "AcademicController@update_session")->name('update-session');
    Route::get('session/delete', "AcademicController@delete_session")->name('delete-session');

    //class
    Route::get('class/list', "AcademicController@manage_class")->name('manage-class');
    Route::get('class/add', "AcademicController@add_class")->name('add-class');
    Route::post('class/save', "AcademicController@save_class")->name('save-class');
    Route::get('class/edit', "AcademicController@edit_class")->name('edit-class');
    Route::post('class/update', "AcademicController@update_class")->name('update-class');
    Route::get('class/delete', "AcademicController@delete_class")->name('delete-class');
    Route::get('class/archive/list', "AcademicController@class_archive_list")->name('class-archive-list');
    
    Route::get('class/restore/{id}', "AcademicController@class_restore")->name('class-restore');

    //section
    Route::get('section/list', "AcademicController@manage_section")->name('manage-section');
    Route::get('section/add', "AcademicController@add_section")->name('add-section');
    Route::post('section/save', "AcademicController@save_section")->name('save-section');
    Route::get('section/edit', "AcademicController@edit_section")->name('edit-section');
    Route::post('section/update', "AcademicController@update_section")->name('update-section');
    Route::get('section/delete', "AcademicController@delete_section")->name('delete-section');

    //classroom
    Route::get('classroom/list', "AcademicController@manage_classroom")->name('manage-classroom');
    Route::get('classroom/add', "AcademicController@add_classroom")->name('add-classroom');
    Route::post('classroom/save', "AcademicController@save_classroom")->name('save-classroom');
    Route::get('classroom/edit', "AcademicController@edit_classroom")->name('edit-classroom');
    Route::post('classroom/update', "AcademicController@update_classroom")->name('update-classroom');
    Route::get('classroom/delete', "AcademicController@delete_classroom")->name('delete-classroom');

    //subject
    Route::get('subject/list', "AcademicController@manage_subject")->name('manage-subject');
    Route::get('subject/add', "AcademicController@add_subject")->name('add-subject');
    Route::post('subject/save', "AcademicController@save_subject")->name('save-subject');
    Route::get('subject/edit', "AcademicController@edit_subject")->name('edit-subject');
    Route::post('subject/update', "AcademicController@update_subject")->name('update-subject');
    Route::get('subject/delete', "AcademicController@delete_subject")->name('delete-subject');

    //subject-class
    Route::get('subject/class/list', "AcademicController@manage_subject_class")->name('manage-subject-class');
    Route::get('subject/class/add', "AcademicController@add_subject_class")->name('add-subject-class');
    Route::post('subject/class/save', "AcademicController@save_subject_class")->name('save-subject-class');
    Route::get('subject/class/edit/{class_id}/{section_id}', "AcademicController@edit_subject_class")->name('edit-subject-class');
    Route::post('subject/class/update', "AcademicController@update_subject_class")->name('update-subject-class');
    Route::get('subject/class/delete/{id}', "AcademicController@delete_subject_class")->name('delete-subject-class');

    Route::post('get-section-info', "AcademicController@get_section_info")->name('get-section-info');
    Route::post('get-subject-info', "AcademicController@get_subject_info")->name('get-subject-info');
    Route::post('subject-list', "AcademicController@subject_info")->name('subject-list');
    
    //class-teacher
    Route::get('class/teacher/list', "AcademicController@manage_class_teacher")->name('manage-class-teacher');
    Route::get('class/teacher/add', "AcademicController@add_class_teacher")->name('add-class-teacher');
    Route::post('class/teacher/save', "AcademicController@save_class_teacher")->name('save-class-teacher');
    Route::get('class/teacher/edit', "AcademicController@edit_class_teacher")->name('edit-class-teacher');
    Route::post('class/teacher/update', "AcademicController@update_class_teacher")->name('update-class-teacher');
    Route::get('class/teacher/delete', "AcademicController@delete_class_teacher")->name('delete-class-teacher');
    
    //class-routine
    Route::get('class/routine/list', "AcademicController@manage_class_routine")->name('manage-class-routine');
    Route::post('class-routine-save', "AcademicController@save_class_routine")->name('save-class-routine');

    Route::post('class-routine-delete', "AcademicController@delete_class_routine")->name('delete-class-routine');
    Route::post('show-subject-routine', "AcademicController@show_subject_routine")->name('show-subject-routine');
    Route::get('preview-subject-routine', "AcademicController@preview_subject_routine")->name('preview-subject-routine');
    Route::post('routine-overwrite-check', "AcademicController@routine_overwrite_check")->name('routine-overwrite-check');

    Route::get('class-routine-edit', "AcademicController@edit_class_routine")->name('edit-class-routine');
    Route::post('class-routine-update', "AcademicController@update_class_routine")->name('update-class-routine');
    Route::post('routine-overwrite-check-update', "AcademicController@routine_overwrite_check_update")->name('routine-overwrite-check-update');
    
    /*===============================================================
                    Setting Section
    =================================================================*/
    //designation
    Route::get('designation/list', "AcademicController@manage_designation")->name('manage-designation');
    Route::get('designation/add', "AcademicController@add_designation")->name('add-designation');
    Route::post('designation/save', "AcademicController@save_designation")->name('save-designation');
    Route::get('designation/edit', "AcademicController@edit_designation")->name('edit-designation');
    Route::post('designation/update', 'AcademicController@update_designation')->name('update-designation');
    Route::get('designation/delete', "AcademicController@delete_designation")->name('delete-designation');

    Route::get('designation/archive/list', "AcademicController@designation_archive_list")->name('designation-archive-list');
    
    Route::get('designation/restore/{id}', "AcademicController@designation_restore")->name('designation-restore');

    //department
    Route::get('department/list', "AcademicController@manage_department")->name('manage-department');
    Route::get('department/add', "AcademicController@add_department")->name('add-department');
    Route::post('department/save', "AcademicController@save_department")->name('save-department');
    Route::get('department/edit', "AcademicController@edit_department")->name('edit-department');
    Route::post('department/update', "AcademicController@update_department")->name('update-department');
    Route::get('department/delete', "AcademicController@delete_department")->name('delete-department');

    Route::get('view-department-image', "AcademicController@view_department_image")->name('view-department-image');

    Route::get('department/archive/list', "AcademicController@department_archive_list")->name('department-archive-list');
    Route::get('department/restore/{id}', "AcademicController@department_restore")->name('department-restore');

    //syllabus
    Route::get('syllabus/list', "AcademicController@manage_syllabus")->name('manage-syllabus');
    Route::get('syllabus/add', "AcademicController@add_syllabus")->name('add-syllabus');
    Route::post('syllabus/save', "AcademicController@save_syllabus")->name('save-syllabus');
    Route::get('syllabus/edit', "AcademicController@edit_syllabus")->name('edit-syllabus');
    Route::post('syllabus/update', "AcademicController@update_syllabus")->name('update-syllabus');
    Route::get('syllabus/delete', "AcademicController@delete_syllabus")->name('delete-syllabus');

    Route::post('delete-syllabus-image',  "AcademicController@delete_syllabus_image")->name('delete-syllabus-image');
    
    //Homework------------------------
    Route::get('homework', "AcademicController@manage_homeWork")->name("manage-homework");
    Route::post('homework-save', "AcademicController@homeWorkSave")->name("homework-save");

    Route::post('show-student-homework', "AcademicController@show_student_homework")->name("show-student-homework");
    Route::get('edit-student-homework', "AcademicController@edit_student_homework")->name("edit-student-homework");
    Route::post('update-student-homework', "AcademicController@update_student_homework")->name("update-student-homework");
    Route::post('delete-student-homework', "AcademicController@delete_student_homework")->name("delete-student-homework");
    
    
    /*===============================================================
                    Accounting Section
    =================================================================*/

    //fee-type
    Route::get('feetype/list', "AccountController@manage_feetype")->name('manage-feetype');
    Route::get('feetype/add', "AccountController@add_feetype")->name('add-feetype');
    Route::post('feetype/save', "AccountController@save_feetype")->name('save-feetype');
    Route::get('feetype/edit', "AccountController@edit_feetype")->name('edit-feetype');
    Route::post('feetype/update', "AccountController@update_feetype")->name('update-feetype');
    Route::get('feetype/delete', "AccountController@delete_feetype")->name('delete-feetype');

    Route::get('view-feetype-image', "AccountController@view_feetype_image")->name('view-feetype-image');

    //fee
    Route::get('fee/list', "AccountController@manage_fee")->name('manage-fee');
    Route::get('fee/add', "AccountController@add_fee")->name('add-fee');
    Route::post('fee/save', "AccountController@save_fee")->name('save-fee');
    Route::get('fee/edit/{id}', "AccountController@edit_fee")->name('edit-fee');
    Route::post('fee/update', "AccountController@update_fee")->name('update-fee');

    Route::post('get-fees-list', "AccountController@get_fees_list")->name('get-fees-list');
    Route::post('set-fee-mark-paid', "AccountController@set_fee_mark_paid")->name('set-fee-mark-paid');
    Route::post('fee/delete', "AccountController@delete_fee")->name('delete-fee');


    //expense-type
    Route::get('expense/type/list', "AccountController@manage_expense_type")->name('manage-expense-type');
    Route::get('expense/type/add', "AccountController@add_expense_type")->name('add-expense-type');
    Route::post('expense/type/save', "AccountController@save_expense_type")->name('save-expense-type');
    Route::get('expense/type/edit', "AccountController@edit_expense_type")->name('edit-expense-type');
    Route::post('expense/type/update', "AccountController@update_expense_type")->name('update-expense-type');
    Route::get('expense/type/delete', "AccountController@delete_expense_type")->name('delete-expense-type');

    Route::get('view-expensetype-image', "AccountController@view_expensetype_image")->name('view-expensetype-image');

    //expense-list
    Route::get('expense/list', "AccountController@manage_expense")->name('manage-expense');
    Route::get('expense/add', "AccountController@add_expense")->name('add-expense');
    Route::post('expense/save', "AccountController@save_expense")->name('save-expense');
    Route::get('expense/edit', "AccountController@edit_expense")->name('edit-expense');
    Route::post('expense/update', "AccountController@update_expense")->name('update-expense');
    Route::get('expense/delete', "AccountController@delete_expense")->name('delete-expense');
    
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

    Route::get('users/add', 'UserManageController@createUsers')->name('create-users');
    Route::get('users/list', 'UserManageController@manageUsers')->name('manage-users');
    Route::post('users/save', 'UserManageController@saveUsers')->name('save-users');
    Route::get('users/edit/{id}', 'UserManageController@editUsers')->name('edit-users');
    Route::post('users/update', 'UserManageController@updateUsers')->name('update-users');
    Route::get('users/delete/{id}', 'UserManageController@deleteUsers')->name('delete-users');
    Route::get('users/details/{id}', 'UserManageController@usersdetails')->name('usersdetails');
    Route::get('users/datetime/{id}', 'UserManageController@user_datetime')->name('user_datetime');
    Route::post('users/timezone/save/{id}', 'UserManageController@user_timezone_save')->name('user_timezone_save');

    //Parents------------------
    Route::get('parents', "ParentsController@parentIndex")->name('parents.index');
    Route::get('add/parents', "ParentsController@addParents")->name('add.parents');
    Route::post('save/parents', "ParentsController@saveParents")->name('save.parents');
    Route::get('edit/parents/{id}', "ParentsController@editParents")->name('edit.parent');
    Route::post('update/parents/basic/info', "ParentsController@updateBasicInfoParents")->name('parent.basic_info_update');
    Route::post('update/parents/additional/info', "ParentsController@updateAdditionalInfoParents")->name('parent.additional_info_update');
    Route::post('update/parent/document/checklist', "ParentsController@parent_document_checklist_update")->name('parent.parent_document_checklist_update');
    Route::get('parents/delete/{id}', "ParentsController@parentDelete")->name('parent.delete');
    Route::get('parents/search', "ParentsController@parentSearch")->name('parent.parent_search');
    Route::get('parents/parent_additional_info_get', "ParentsController@parent_additional_info_get")->name('parent_additional_info');
    Route::get('get_section', "ParentsController@get_section")->name('get_section');
    Route::get('get_student', "ParentsController@get_student")->name('get_student');

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
    
    Route::get('exam/list', "ExamController@examList")->name('exam.list');
    Route::post('exam/create', "ExamController@createExam")->name('create.exam');
    Route::get('exam/edit', "ExamController@editExam")->name('edit.exam');
    Route::post('exam/update', "ExamController@updateExam")->name('update.exam');
    Route::get('exam/delete', "ExamController@deleteExam")->name('delete.exam');
    
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

    Route::get('view-result-details',"ExamController@view_result_details")->name('view-result-details');
    
    //Promotion---------------------
    Route::get('promotion',['as' =>"exam.promotion", 'uses' => "ExamController@examPromotion"]);
    Route::post('student_list',"StudentController@student_list")->name('student-list');
    Route::post('promote-student-list',"StudentController@promote_student_list")->name('promote-student-list');
    
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
    Route::get('system/setting/list', 'SettingController@system_setting_list')->name('system-setting-list');
    //basic
    Route::post('basic-form-serialize', 'SettingController@basic_form_serialize')->name('basic-form-serialize');
    //system
    Route::post('system-form-serialize', 'SettingController@system_form_serialize')->name('system-form-serialize');
    //Route::post('theme-form-serialize', 'SettingController@theme_form_serialize')->name('theme-form-serialize');

    //payment
    Route::post('paypal-payment-form', 'SettingController@paypal_payment_form')->name('paypal-payment-form');
    Route::post('stripe-payment-form', 'SettingController@stripe_payment_form')->name('stripe-payment-form');
    Route::post('razorpay-payment-form', 'SettingController@razorpay_payment_form')->name('razorpay-payment-form');
    Route::post('paystack-payment-form', 'SettingController@paystack_payment_form')->name('paystack-payment-form');
    

    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'AcademicController';
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
