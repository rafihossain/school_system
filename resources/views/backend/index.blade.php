@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('css')
<link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumbs')
<x-backend-breadcrumbs />
@endsection

@section('content')

<!-- / card -->
<div class="row">
    <div class="col-xl-3 col-6">
        <a href="javascript:void(0)" id="open_user_model">
            <div class="card">
                <div class="card-body d-flex justify-content-center text-center">
                    <div>
                        <img src="{{ asset('assets/images/man.png') }}" class="img-fluid">
                        <h4 class="mb-0"> Add User </h4>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-6">
        <a href="javascript:void(0);" id="open_attendence_model">
            <div class="card">
                <div class="card-body d-flex justify-content-center text-center">
                    <div>
                        <img src="{{ asset('assets/images/attendance.png') }}" class="img-fluid">
                        <h4 class="mb-0"> Add Attendence </h4>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-6">
        <a href="javascript:void(0);" id="open_routine_modal">
            <div class="card">
                <div class="card-body d-flex justify-content-center text-center">
                    <div>
                        <img src="{{ asset('assets/images/routine.png') }}" class="img-fluid">
                        <h4 class="mb-0"> Add Class Routine </h4>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-6">
        <a href="javascript:void(0);" id="open_examschedule_modal">
            <div class="card">
                <div class="card-body d-flex justify-content-center text-center">
                    <div>
                        <img src="{{ asset('assets/images/exam.png') }}" class="img-fluid">
                        <h4 class="mb-0"> Add Exam Schedule </h4>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-6">
        <a href="javascript:void(0);" id="open_syllabus_modal">
            <div class="card">
                <div class="card-body d-flex justify-content-center text-center">
                    <div>
                        <img src="{{ asset('assets/images/checklist.png') }}" class="img-fluid">
                        <h4 class="mb-0"> Add Syllabus </h4>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-6">
        <a href="javascript:void(0);" id="open_fee_modal">
            <div class="card">
                <div class="card-body d-flex justify-content-center text-center">
                    <div>
                        <img src="{{ asset('assets/images/fee.png') }}" class="img-fluid">
                        <h4 class="mb-0"> Add Fee </h4>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-6">
        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#ourreport">
            <div class="card">
                <div class="card-body d-flex justify-content-center text-center">
                    <div>
                        <img src="{{ asset('assets/images/report.png') }}" class="img-fluid">
                        <h4 class="mb-0"> Report </h4>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-6">
        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#createEvent">
            <div class="card">
                <div class="card-body d-flex justify-content-center text-center">
                    <div>
                        <img src="{{ asset('assets/images/event.png') }}" class="img-fluid">
                        <h4 class="mb-0"> Add Events </h4>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-6">
        <div class="card">
            <div class="card-body">
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start h1 text-primary">
                        <i class="mdi mdi-account-group-outline"></i>
                    </div>

                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1"> {{ $students }} </h2>
                        <p class="text-muted mb-1">Student</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-3 col-6">
        <div class="card">
            <div class="card-body">
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start h1 text-success">
                        <i class="mdi mdi-account"></i>
                    </div>

                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1"> {{ $parents }} </h2>
                        <p class="text-muted mb-1">Parents</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-3 col-6">
        <div class="card">
            <div class="card-body">
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start h1 text-warning">
                        <i class="mdi mdi-account-tie"></i>
                    </div>

                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1"> {{ $staff }} </h2>
                        <p class="text-muted mb-1">Teacher</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-3 col-6">
        <div class="card">
            <div class="card-body">
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start h1 text-info">
                        <i class="mdi mdi-shield-account-variant-outline"></i>
                    </div>

                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1"> {{ $operators }} </h2>
                        <p class="text-muted mb-1">Staff</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h3>2023 Accounts Summary</h3>
                    <p>Click month income or expense column to view day wise account summary</p>
                </div>
                <div id="morris-bar-example" dir="ltr" style="height: 280px;" class="morris-chart"></div>
            </div>
        </div>
    </div>
</div>


<!-- Add User -->
<div id="add_user_modal_data"></div>
<!-- end add user -->

<!-- Add parent -->
<div id="addparent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Parent</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="parentFrom">
                    <div class="mb-2">
                        <label class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                        <span class="text-danger parent_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                        <span class="text-danger parent_email_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                        <span class="text-danger parent_password_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                        <span class="text-danger parent_phone_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Gender<span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>
                        <span class="text-danger parent_gender_error"></span>
                    </div>
                    <div class="mb-2 mt-4">
                        <button type="button" class="btn btn-primary save_parent">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Add parent -->
<!-- Add Class -->
<div id="class_response_data"></div>
<!--End Add Class -->
<!-- Add Section -->
<div id="section_response_data"></div>
<!--End Add Section -->
<!-- Add  Department -->
<div id="addDepartment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Department</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDepartment">
                    <div class="mb-2">
                        <label class="form-label">Department Name</label>
                        <input type="text" class="form-control" name="department_name">
                        <span class="text-danger department_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Description</label>
                        <textarea id="editor" class="form-control" name="description"></textarea>
                        <span class="text-danger description_error"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Department Image</label>
                        <input type="file" class="dropify" name="department_image">
                        <span class="text-danger department_image_error"></span>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="department_status" value="0">
                        <input type="checkbox" class="form-check-input" id="customSwitch1" name="department_status" value="1">
                        <label class="form-check-label" for="customSwitch1">Active</label>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary addDepartmentSave"> Add Department </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Add Department -->
<!-- Add  Attendence -->
<div id="AddAttendence" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Attendence</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="attendence_items d-flex gap-2">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="Attendence1" value="1" checked>
                        <label class="form-check-label" for="Attendence1">Student Attendence</label>
                    </div>

                    <div class="form-check mb-2 form-check-success">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="2" id="Attendence2">
                        <label class="form-check-label" for="Attendence2">Teacher Attendence</label>
                    </div>
                </div>
                <div id="AttendenceStudent">
                    <form id="get_student_list_form">
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-3">
                                <input type="date" name="attendence_date" class="form-control attendence_date" value="{{date('Y-m-d')}}">
                                <span class="text-danger stdatd_attendence_date_error"></span>
                            </div>
                            <div class="col-md-3">
                                <select name="class_id" id="class_id" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $classe)
                                        <option value="{{$classe->id}}">{{$classe->class_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger stdatd_class_name_error"></span>
                            </div>
                            <div class="col-md-3 show_section">
                                <select name="section_id" class="form-control section_name">
                                    <option value="">Select Section</option>
                                </select>
                                <span class="text-danger stdatd_section_name_error"></span>
                            </div>
                            <div class="col-md-3 show_button">
                                <button type="button" class="btn btn-primary get_student_list">Get Student List</button>
                            </div>
                        </div>
                    </form>
                    <form id="save_student_attendance">
                        <div id="student_attendance_response_list"></div>
                    </form>
                </div>
                <div id="TeacherStudent">
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-3">
                            <input type="date" name="attendence_date" class="form-control attendence_date" value="{{ date('Y-m-d') }}">
                            @error('attendence_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 show_button">
                            <button type="button" class="btn btn-primary get_teacher_list">Get Teacher List</button>
                        </div>
                    </div>
                    <form id="save_teacher_attendance">
                        <div id="teacher_attendance_response_list"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Attendence -->
<!-- Add Subject -->
<div id="subject_response_data"></div>
<!--End Subject -->
<!-- add rutine -->
<div id="routine_response_modal_data"></div>
<!-- end rutine -->
<!-- Add ClassRoom -->
<div id="AddClassRoom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Class Room</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formClassroom">
                    <div class="mb-2">
                        <label>Classroom Name</label>
                        <input type="text" class="form-control" name="classroom_name">
                        <span class="text-danger routine_classroom_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Description</label>
                        <textarea class="form-control" name="classroom_description"></textarea>
                        <span class="text-danger routine_classroom_description_error"></span>
                    </div>

                    <div class="mt-4">
                        <button type="button" class="btn btn-primary submitClassroom"> Add Classroom </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End ClassRoom -->
<!-- Add Teacher -->
<div id="Addteacher" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Teacher</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="routine_addteacher">
                    <div class="mb-2">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                        <span class="text-danger teacher_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Email<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                        <span class="text-danger teacher_email_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                        <span class="text-danger teacher_password_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                        <span class="text-danger teacher_phone_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Gender<span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>
                        <span class="text-danger teacher_gender_error"></span>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary saveteacher">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Teacher -->
<!-- Add  Exam Schedule -->
<div id="exam_schedule_response_modal_data"></div>
<!--End Exam Schedule -->
<!-- Add Exam -->
<div id="addExam" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Create Exam</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create_exam_save">
                    <div class="modal-body">
                        <span class="text-danger ml-2 dateError" align="center"></span>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="recipient-name">
                            <span class="text-danger exam_name_error"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="recipient-name" class="col-form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="recipient-name">
                                <span class="text-danger exam_startdate_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="col-form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="recipient-name">
                                <span class="text-danger exam_enddate_error"></span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="recipient-name" class="col-form-label">Note</label>
                            <textarea name="note" id="" cols="2" rows="5" class="form-control"></textarea>
                            <span class="text-danger exam_note_error"></span>
                        </div>
                        <div class="mt-4">
                            <button type="button" class="btn btn-primary create_exam">Save</button>
                        </div>
                    </div>

                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- ebd Exam -->
<!-- Add Syllabus -->
<div id="syllabus_response_modal_data"></div>
<!-- ebd Syllabus -->
<!-- Add fee -->
<div id="fee_response_modal_data"></div>
<!-- ebd fee -->
<!-- Add fee type -->
<div id="addFeetype" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Feetype </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formFeetype">
                    <div class="mb-2">
                        <label class="form-label">Feetype Name</label>
                        <input type="text" class="form-control" name="feetype_name">
                        <span class="text-danger feetype_name_error"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Upload Feetype</label>
                        <input type="file" class="dropify" id="feetypeImage" name="feetype_image">
                        <span class="text-danger feetype_image_error"></span>
                    </div>

                    <div class="mt-4">
                        <button type="button" class="btn btn-primary submitFeetype"> Submit </button>
                    </div>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- ebd fee -->

<!-- Add report -->
<div id="ourreport" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Report </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="choose_report_type mb-3">
                    <select class="form-control" name="report_type">
                        <option value="">Select Report Type</option>
                        <option value="1">Student</option>
                        <option value="2">Teacher</option>
                        <option value="3">Staff</option>
                        <option value="4">Class Routine</option>
                        <option value="5">Exam Routine</option>
                        <option value="6">Student Attendance</option>
                        <option value="7">Teacher Attendance</option>
                    </select>
                </div>
                <div id="student_report">
                    <form id="student_report_form">
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-3">
                                <select name="class_id" id="getSection" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger class_name_error"></span>
                            </div>
                            <div class="col-md-3 show_section">
                                <select name="section_id" id="getInfo" class="form-control">
                                    <option value="">Select Section</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger section_name_error"></span>
                            </div>
                            <div class="col-md-3 show_student">
                                <button type="button" class="btn btn-primary get_student_report">Get Student List</button>
                            </div>
                        </div>
                    </form>
                    <div class="show_student_report"></div>
                </div>
                <div id="teacher_report">
                    <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap teacher_report_datatable">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <!-- <th>DEPARTMENT</th> -->
                                <th>GENDER</th>
                                <th>PHONE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div id="staff_report">
                    <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap staff_report_datatable">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <!-- <th>DEPARTMENT</th> -->
                                <th>GENDER</th>
                                <th>PHONE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div id="routine_report">
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <select name="session_id" class="form-control getroutineclass">
                                        <option value="">Select Session</option>
                                        @foreach($sessions as $session)
                                        <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('session_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2 show_class d-none">
                                    <select name="class_id" class="form-control getroutinesection"></select>
                                </div>

                                <div class="col-md-2 show_section d-none">
                                    <select name="section_id" class="form-control getroutineInfo"></select>
                                </div>
                                <div class="col-md-4 show_route d-none">
                                    <button type="button" class="btn btn-primary preview_routine">Get Class Routine</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="show_class_routine"></div>
                        </div>
                    </div>
                </div>
                <div id="exam_report">
                    <div class="card">
                        <form id="exam_report_form">
                            <div class="card-header">
                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <select name="session_id" class="form-control getexamlist">
                                            <option value="">Select Session</option>
                                            @foreach($sessions as $session)
                                                <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 show_exam d-none">
                                        <select name="exam_id" class="form-control getexamclass">
                                            <option value="">Select Exam</option>
                                            @foreach($exam_lists as $exam_list)
                                                <option value="{{ $exam_list->id }}">{{ $exam_list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 show_class d-none">
                                        <select name="class_id" class="form-control getexamsection">
                                            <option value="">Select Class</option>
                                            @foreach($classes as $classe)
                                                <option value="{{$classe->id}}">{{$classe->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 show_section d-none">
                                        <select name="section_id" class="form-control getsectioninfo">
                                            <option value="">Select Section</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 show_button d-none">
                                        <button type="button" class="btn btn-primary get_report_exam_routine">Get Exam Routine</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="show_get_report_exam_routine"></div>
                        </div>
                    </div>
                </div>
                <div id="student_attendence_report">
                    <div class="card">
                        <form id="student_attendence_report_form">
                            <div class="card-header">
                                <div class="d-flex justify-content-center">
                                    <div class="col-md-2">
                                        <select name="session_id" class="form-control std_atten_session">
                                            @foreach($sessions as $session)
                                                <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="show_class d-none">
                                        <select name="class_id" class="form-control std_atten_class">
                                            <option value="">Select Class</option>
                                            @foreach($classes as $classe)
                                                <option value="{{$classe->id}}">{{$classe->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="show_section d-none">
                                        <select name="section_id" class="form-control std_atten_section">
                                            <option value="">Select Section</option>
                                        </select>
                                    </div>
                                    <div class="show_type d-none">
                                        <select name="select_type" class="form-control std_atten_select_type">
                                            <option value="">Select Type</option>
                                            <option value="date">Date</option>
                                            <option value="monthly">Monthly</option>   
                                        </select>
                                    </div>
                                    <div class="show_day date_click d-none">
                                        <input type="date" class="form-control date_data" name="date_data" value="{{date('Y-m-d')}}">
                                    </div>
                                    <div class="show_monthly date_click d-none">
                                        <input type="month" class="form-control date_data_month" name="date_data_month" value="{{date('Y-m')}}">
                                    </div>
                                    <div class="show_button"> 
                                        <button type="button" class="btn btn-primary get_student_mark">Get Attendence Report</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">'
                                <div class="show_student_attendence_report"></div>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="show_get_report_exam_routine"></div>
                        </div>
                    </div>
                </div>
                <div id="teacher_attendence_report">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <input type="date" id="attendence_date" name="attendence_date" class="form-control" value="{{ date('Y-m-d') }}">
                                    @error('attendence_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 show_button"> 
                                    <button type="button" class="btn btn-primary get_teacher_list">Get Teacher List</button> 
                                </div> 
                            </div>
                            <div class="show_teacher_list"></div>
                        </div>

                        <div class="card-body">
                            <div class="show_get_report_exam_routine"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- ebd report -->

<!-- create event -->
<div id="createEvent" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="eventFrom">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Create Event</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Event Title</label>
                        <input type="text" class="form-control" name="event_title" placeholder="Enter Event Title">
                        <span class="text-danger event_title_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Starting Date</label>
                            <input type="date" class="form-control" name="start_date">
                            <span class="text-danger event_startdate_error"></span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Ending Date</label>
                            <input type="date" class="form-control" name="end_date">
                            <span class="text-danger event_enddate_error"></span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary" id="save_event">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- end create event -->

@endsection
@section('script')
<!-- Datatables init -->

<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

<script type="text/javascript">
    // @todo: CSRF Token Constant
    const CSRF_TOKEN = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    // @todo: Async Request Handler
    const asyncHandler = function(route, method, resCallback, errCallback = null, object = {}) {
        $.ajax({
            headers: CSRF_TOKEN,
            url: route,
            method: method,
            data: object,
            // processData: false,
            // contentType: false,
            success: (res) => resCallback(res),
            error: (err) => errCallback(err)
        })
    }
    const errorHandler = (param) => {
        console.log(param);
        for (let i = 0; i <= param.length; i++) {
            $(param[i].name).text(param[i].data);
        }
    }

    $(document).ready(function() {

        /*=====================================================
                            New Implemented Code
        ========================================================*/

        $('#open_user_model').on('click', function() {
            $.ajax({
                url: "{{route('backend.add-user-modal')}}",
                success: function(data) {
                    $('#add_user_modal_data').html(data);
                    $('#addUser').modal('show');
                }
            })
        });
        $('#open_attendence_model').on('click', function() {
            $('#AddAttendence').modal('show');
        });
        $('#open_routine_modal').on('click', function() {
            $.ajax({
                url: "{{route('backend.open-routine-modal')}}",
                success: function(data) {
                    $('#routine_response_modal_data').html(data);
                    $('#createRoutineModal').modal('show');
                }
            })
        });
        $('#open_examschedule_modal').on('click', function() {
            $.ajax({
                url: "{{route('backend.open-examschedule-modal')}}",
                success: function(data) {
                    $('#exam_schedule_response_modal_data').html(data);
                    $('#AddExamSchedule').modal('show');
                }
            })
        });
        $('#open_syllabus_modal').on('click', function() {
            $.ajax({
                url: "{{route('backend.open-syllabus-modal')}}",
                success: function(data) {
                    $('#syllabus_response_modal_data').html(data);
                    $('#addSyllabus').modal('show');
                }
            })
        });
        $('#open_fee_modal').on('click', function() {
            $.ajax({
                url: "{{route('backend.open-fee-modal')}}",
                success: function(data) {
                    $('#fee_response_modal_data').html(data);
                    $('#addFee').modal('show');
                }
            })
        });
        $(document).delegate('#parents_id', 'keyup', function(e) {
            // alert('click');

            var parent_name = $(this).val();
            $.ajax({
                url: "{{route('backend.admin-parent-search')}}",
                type: 'GET',
                data: {
                    'parent_name': parent_name
                },
                success: function(data) {
                    $('#parent_list').html(data);
                }
            })
        });
        $(document).delegate('.parentinfosave', 'click', function(e) {
            e.preventDefault();
            let fromData = $("#add_parent").serializeArray();
            return asyncHandler("{{route('backend.admin-save-parent')}}", "POST", (res) => $('#addUser').modal('hide'), (err) => {
                return errorHandler([
                    {name: '.parent_name_error', data: err.responseJSON.errors.name},
                    {name: '.parent_email_error', data: err.responseJSON.errors.email},
                    {name: '.parent_password_error', data: err.responseJSON.errors.password},
                    {name: '.parent_phone_error', data: err.responseJSON.errors.phone},
                    {name: '.parent_gender_error', data: err.responseJSON.errors.gender},
                ])
            }, fromData);
        });
        $(document).delegate('.studentinfosave', 'click', function(e) {
            e.preventDefault();

            let fromData = $("#add_student").serializeArray();
            return asyncHandler("{{route('backend.admin-save-student')}}", "POST", (res) => $('#addUser').modal('hide'), (err) => {
                return errorHandler([
                    {name: '.student_name_error', data: err.responseJSON.errors.name},
                    {name: '.student_email_error', data: err.responseJSON.errors.email},
                    {name: '.student_password_error', data: err.responseJSON.errors.password},
                    {name: '.student_parent_error', data: err.responseJSON.errors.parent_id},
                    {name: '.student_department_error', data: err.responseJSON.errors.department_id},
                    {name: '.student_class_error', data: err.responseJSON.errors.class_id},
                    {name: '.student_section_error', data: err.responseJSON.errors.section_id},
                    {name: '.student_rollno_error', data: err.responseJSON.errors.roll_no},
                    {name: '.admission_date_error', data: err.responseJSON.errors.admission_date},
                    {name: '.student_gender_error', data: err.responseJSON.errors.gender},
                ])
            }, fromData);
        });
        $(document).delegate('.teacherinfosave', 'click', function(e) {
            e.preventDefault();

            let fromData = $("#add_teacher").serializeArray();
            return asyncHandler("{{route('backend.admin-save-teacher')}}", "POST", (res) => $('#addUser').modal('hide'), (err) => {
                return errorHandler([
                    {name: '.teacher_name_error', data: err.responseJSON.errors.name},
                    {name: '.teacher_email_error', data: err.responseJSON.errors.email},
                    {name: '.teacher_password_error', data: err.responseJSON.errors.password},
                    {name: '.teacher_phone_error', data: err.responseJSON.errors.phone},
                    {name: '.teacher_gender_error', data: err.responseJSON.errors.gender},
                ])
            }, fromData);

        });
        $(document).delegate('.staffinfosave', 'click', function(e) {
            e.preventDefault();

            let fromData = $("#add_staff").serializeArray();
            return asyncHandler("{{route('backend.admin-save-staff')}}", "POST", (res) => $('#addUser').modal('hide'), (err) => {
                return errorHandler([
                    {name: '.staff_name_error', data: err.responseJSON.errors.name},
                    {name: '.staff_email_error', data: err.responseJSON.errors.email},
                    {name: '.staff_password_error', data: err.responseJSON.errors.password},
                    {name: '.staff_phone_error', data: err.responseJSON.errors.phone},
                    {name: '.staff_gender_error', data: err.responseJSON.errors.gender},
                ])
            }, fromData);

        });
        $(document).delegate('.operatorinfosave', 'click', function(e) {
            e.preventDefault();

            let fromData = $("#add_operator").serializeArray();
            return asyncHandler("{{route('backend.admin-save-operator')}}", "POST", (res) => $('#addUser').modal('hide'), (err) => {
                return errorHandler([
                    {name: '.operator_name_error', data: err.responseJSON.errors.name},
                    {name: '.operator_email_error', data: err.responseJSON.errors.email},
                    {name: '.operator_password_error', data: err.responseJSON.errors.password},
                    {name: '.operator_phone_error', data: err.responseJSON.errors.phone},
                    {name: '.operator_gender_error', data: err.responseJSON.errors.gender},
                ])
            }, fromData);

        });
        $(document).delegate('.saveroutineinfo', 'click', function(e) {

            let fromData = $("#routineFrom").serializeArray();
            return asyncHandler("{{route('backend.save-class-routine')}}", "POST", (res) => $('#createRoutineModal').modal('hide') , (err) => {
                return errorHandler([
                    {name: '.routine_class_error', data: err.responseJSON.errors.class_id},
                    {name: '.routine_section_error', data: err.responseJSON.errors.section_id},
                    {name: '.routine_subject_error', data: err.responseJSON.errors.subject_id},
                    {name: '.routine_classroom_error', data: err.responseJSON.errors.classroom_id},
                    {name: '.routine_teacher_error', data: err.responseJSON.errors.teacher_id},
                    {name: '.routine_day_error', data: err.responseJSON.errors.day_id},
                    {name: '.routine_starttime_error', data: err.responseJSON.errors.start_time},
                    {name: '.routine_endtime_error', data: err.responseJSON.errors.end_time},
                ])
            }, fromData);

        })
        $(document).delegate('.examscheduleinfo', 'click', function(e) {

            let fromData = $("#examSchedule").serializeArray();
            return asyncHandler("{{route('backend.save-examschedule-info')}}", "POST", (res) => $('#AddExamSchedule').modal('hide'), (err) => {
                return errorHandler([
                    {name: '.exam_name_error', data: err.responseJSON.errors.exam_id},
                    {name: '.exam_classname_error', data: err.responseJSON.errors.class_id},
                    {name: '.exam_sectionname_error', data: err.responseJSON.errors.section_id},
                    {name: '.exam_classroom_name_error', data: err.responseJSON.errors.class_room_id},
                    {name: '.exam_subject_name_error', data: err.responseJSON.errors.subject_id},
                    {name: '.exam_date_error', data: err.responseJSON.errors.exam_date},
                    {name: '.start_time_error', data: err.responseJSON.errors.start_time},
                    {name: '.end_time_error', data: err.responseJSON.errors.end_time},
                ])
            }, fromData);

        })
        $(document).delegate('#submitSyllabus', 'click', function(e) {

            let fromData = $("#formSyllabus").serializeArray();
            return asyncHandler("{{route('backend.save-syllabus-info')}}", "POST", (res) => $('#addSyllabus').modal('hide'), (err) => {
                return errorHandler([
                    {name: '.syllabus_title_error', data: err.responseJSON.errors.syllabus_title},
                    {name: '.syllabus_class_name_error', data: err.responseJSON.errors.class_id},
                    {name: '.syllabus_section_name_error', data: err.responseJSON.errors.section_id},
                    {name: '.syllabus_subject_name_error', data: err.responseJSON.errors.subject_id},
                    {name: '.syllabus_image_error', data: err.responseJSON.errors.syllabus_image},
                ])
            }, fromData);

        })
        $(document).delegate('.savefeebasicinfo', 'click', function(e) {
            
            let fromData = $("#feeFrom").serializeArray();
            return asyncHandler("{{route('backend.save-feebasic-info')}}", "POST", (res) => $('#addFee').modal('hide'), (err) => {
                return errorHandler([
                    {name: '.fee_feetype_error', data: err.responseJSON.errors.feetype_id},
                    {name: '.fee_class_error', data: err.responseJSON.errors.class_id},
                    {name: '.fee_section_error', data: err.responseJSON.errors.section_id},
                    {name: '.fee_amountdue_error', data: err.responseJSON.errors.amount_due},
                    {name: '.fee_duedate_error', data: err.responseJSON.errors.due_date},
                    {name: '.fee_description_error', data: err.responseJSON.errors.fee_description},
                ])
            }, fromData);
        })

        $("body").on("click", "#addUser .user_items input[type='radio']", function() {
            var inputValue = $(this).attr("value");

            if (inputValue == '1') {
                $('#parent_content').show();
                $('#student_content').hide();
                $('#teachers_content').hide();
                $('#staff_content').hide();
                $('#operator_content').hide();
            } else if (inputValue == '2') {
                $('#parent_content').hide();
                $('#student_content').show();
                $('#teachers_content').hide();
                $('#staff_content').hide();
                $('#operator_content').hide();
            } else if (inputValue == '3') {
                $('#parent_content').hide();
                $('#student_content').hide();
                $('#teachers_content').show();
                $('#staff_content').hide();
                $('#operator_content').hide();
            } else if (inputValue == '4') {
                $('#parent_content').hide();
                $('#student_content').hide();
                $('#teachers_content').hide();
                $('#staff_content').show();
                $('#operator_content').hide();
            } else if (inputValue == '5') {
                $('#parent_content').hide();
                $('#student_content').hide();
                $('#teachers_content').hide();
                $('#staff_content').hide();
                $('#operator_content').show();
            }

        });
        $("body").on("click", "#AddAttendence .attendence_items input[type='radio']", function() {
            var inputValue = $(this).attr("value");
            if (inputValue == '1') {
                $('#AttendenceStudent').show();
                $('#TeacherStudent').hide();
            } else if (inputValue == '2') {
                $('#AttendenceStudent').hide();
                $('#TeacherStudent').show();
            }
        });
    });
    $("body").on("click", ".show_addParent", function() {
        $('#parentFrom')[0].reset();
        $('#addparent').modal('show');
        $('#addUser').modal('hide');
    });
    $("body").on("click", ".save_parent", function() {

        let fromData = $("#parentFrom").serializeArray();
        return asyncHandler("{{route('backend.admin-save-parent')}}", "POST", (res) =>{
            $('#add_user_modal_data').html(res);
            $('#parent_content').hide();
            $('#student_content').show();
            $('#addparent').modal('hide');
            $('#addUser').modal('show');
        }, (err) => {
            return errorHandler([
                {name: '.parent_name_error', data: err.responseJSON.errors.name},
                {name: '.parent_email_error', data: err.responseJSON.errors.email},
                {name: '.parent_password_error', data: err.responseJSON.errors.password},
                {name: '.parent_phone_error', data: err.responseJSON.errors.phone},
                {name: '.parent_gender_error', data: err.responseJSON.errors.gender},
            ])
        }, fromData);

    });
    $("body").on("click", ".addClass_student", function() {
        // $('#formClass')[0].reset();
        $.ajax({
            url: "{{route('backend.class-response')}}",
            success: function(data) {
                $('#class_response_data').html(data);
                $('#addUser').modal('hide');
                $('#addClass').modal('show');
            },
        })
    });
    $("body").on("click", ".submitClass", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.admin-save-class')}}", "POST", (res) =>{
            $('#add_user_modal_data').html(res);
            $('#parent_content').hide();
            $('#student_content').show();
            $('#addClass').modal('hide');
            $('#addUser').modal('show');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });
    $("body").on("click", ".addRoutineClass", function() {
        $('#addClass').modal('show');
        $('#addClass').find('.submitClass').addClass('NewClassRoutineSubmit');
        $('#addClass').find('.submitClass').removeClass('submitClass');
        $('#createRoutineModal').modal('hide');
    });

    $("body").on("click", ".NewClassRoutineSubmit", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.add-routine-class')}}", "POST", (res) =>{
            $('#routine_response_modal_data').html(res);
            $('#addClass').modal('hide');
            $('#createRoutineModal').modal('show');
            $('#addClass').find('.NewClassRoutineSubmit').addClass('submitClass');
            $('#addClass').find('.NewClassRoutineSubmit').removeClass('NewClassRoutineSubmit');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });

    $("body").on("click", ".addRoutineClass", function() {
        $('#addClass').modal('show');
        $('#addClass').find('.submitClass').addClass('NewClassRoutineSubmit');
        $('#addClass').find('.submitClass').removeClass('submitClass');
        $('#createRoutineModal').modal('hide');
    });
    $("body").on("click", ".addRoutineSection", function() {

        $.ajax({
            url: "{{route('backend.section-response')}}",
            success: function(data) {
                $('#section_response_data').html(data);

                $('#addSection').modal('show');
                $('#createRoutineModal').modal('hide');

                $('#addSection').find('.submitSection').addClass('NewRoutineSactionSubmit');
                $('#addSection').find('.submitSection').removeClass('submitSection');
                $('#addSection').find('.addSectionClass').addClass('addSectionRoutineClass');
                $('#addSection').find('.addSectionClass').removeClass('addSectionClass');
            },
        })

    });
    $("body").on("click", ".addSectionRoutineClass", function() {

        $.ajax({
            url: "{{route('backend.class-response')}}",
            success: function(data) {
                $('#class_response_data').html(data);

                $('#addClass').modal('show');
                $('#addSection').modal('hide');
                $('#addClass').find('.submitClass').addClass('submitRoutineClass');
                $('#addClass').find('.submitClass').removeClass('submitClass');
            },
        })

    });
    $("body").on("click", ".submitRoutineClass", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.admin-routine-class')}}", "POST", (res) =>{
            $('#section_response_data').html(res);
            $('#addClass').modal('hide');
            $('#addSection').modal('show');
            $('#addClass').find('.submitRoutineClass').addClass('submitClass');
            $('#addClass').find('.submitRoutineClass').removeClass('submitRoutineClass');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });
    $("body").on("click", ".NewRoutineSactionSubmit", function() {

        let fromData = $("#formSection").serializeArray();
        return asyncHandler("{{route('backend.add-routine-section')}}", "POST", (res) =>{
            $('#routine_response_modal_data').html(res);

            $('#addSection').modal('hide');
            $('#createRoutineModal').modal('show');
            $('#addSection').find('.NewRoutineSactionSubmit').addClass('submitSection');
            $('#addSection').find('.NewRoutineSactionSubmit').removeClass('NewRoutineSactionSubmit');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_id},
                {name: '.section_name_error', data: err.responseJSON.errors.section_name},
                {name: '.section_capacity_error', data: err.responseJSON.errors.section_capacity},
            ])
        }, fromData);

    });
    $("body").on("click", ".addDepartmentStudent", function() {
        $('#addDepartment').modal('show');
        $('#addUser').modal('hide');
    });
    $("body").on("click", ".addDepartmentSave", function() {

        var formdata = new FormData(document.getElementById('formDepartment'));
        $.ajax({
            url: "{{route('backend.admin-save-department')}}",
            type: 'POST',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#add_user_modal_data').html(data);

                $('#parent_content').hide();
                $('#student_content').show();

                $('#addDepartment').modal('hide');
                $('#addUser').modal('show');
            },
            error: function(response) {
                $('.department_name_error').text(response.responseJSON.errors.department_name);
                $('.description_error').text(response.responseJSON.errors.description);
                $('.department_image_error').text(response.responseJSON.errors.department_image);
            }
        })

        // let fromData = new FormData(document.getElementById('formDepartment'));
        // return asyncHandler("{{route('backend.admin-save-department')}}", "POST", (res) =>{
        //     $('#add_user_modal_data').html(data)
        //     $('#parent_content').hide()
        //     $('#student_content').show()
        //     $('#addDepartment').modal('hide')
        //     $('#addUser').modal('show')
        // }, (err) => {
        //     return errorHandler([
        //         {name: '.department_name_error', data: err.responseJSON.errors.department_name},
        //         {name: '.description_error', data: err.responseJSON.errors.description},
        //         {name: '.department_image_error', data: err.responseJSON.errors.department_image},
        //     ])
        // }, fromData);
        
    });
    $("body").on("click", ".addSectionStudent", function() {
        $.ajax({
            url: "{{route('backend.section-response')}}",
            success: function(data) {
                $('#section_response_data').html(data);
                $('#addUser').modal('hide');
                $('#addSection').modal('show');

                $('#addSection').find('.addSectionClass').addClass('NewaddSectionClass');
                $('#addSection').find('.addSectionClass').removeClass('addSectionClass');
            },
        })
    });
    $("body").on("click", ".submitSection", function() {

        let fromData = $("#formSection").serializeArray();
        return asyncHandler("{{route('backend.admin-save-section')}}", "POST", (res) =>{
            $('#add_user_modal_data').html(res);
            $('#parent_content').hide();
            $('#student_content').show();
            $('#addSection').modal('hide');
            $('#addUser').modal('show');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_id},
                {name: '.section_name_error', data: err.responseJSON.errors.section_name},
                {name: '.section_capacity_error', data: err.responseJSON.errors.section_capacity},
            ])
        }, fromData);

    });
    $("body").on("click", ".NewaddSectionClass", function() {
        // console.log('hi');
        $.ajax({
            url: "{{route('backend.class-response')}}",
            success: function(data) {
                $('#class_response_data').html(data);
                $('#addClass').modal('show');
                $('#addSection').modal('hide');
                $('#addClass').find('.submitClass').addClass('NewClassSactionSubmit');
                $('#addClass').find('.submitClass').removeClass('submitClass');
            },
        })
    });
    $("body").on("click", ".NewClassSactionSubmit", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.user-save-class')}}", "POST", (res) =>{
            $('#section_response_data').html(res);
            $('#addSection').modal('show');
            $('#addClass').modal('hide');
            $('#addClass').find('.NewClassSactionSubmit').addClass('submitClass');
            $('#addClass').find('.NewClassSactionSubmit').removeClass('NewClassSactionSubmit');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });
    $("body").on("click", ".addRoutineSubject", function() {
        $('#AddSubject').modal('show');
        $('#createRoutineModal').modal('hide');
    });
    $("body").on("click", ".AddSubjectClass", function() {
        $('#AddSubject').modal('hide');
        $('#addClass').modal('show');
        $('#addClass').find('.submitClass').addClass('NewClassSubjectSubmit');
        $('#addClass').find('.submitClass').removeClass('submitClass');
    });
    $("body").on("click", ".NewClassSubjectSubmit", function() {
        $('#AddSubject').modal('show');
        $('#addClass').modal('hide');
        $('#addClass').find('.NewClassSubjectSubmit').addClass('submitClass');
        $('#addClass').find('.NewClassSubjectSubmit').removeClass('NewClassSubjectSubmit');
    });
    $("body").on("click", ".AddSubjectSubmit", function() {

        let fromData = $("#formSubject").serializeArray();
        return asyncHandler("{{route('backend.admin-save-subject')}}", "POST", (res) =>{
            $('#routine_response_modal_data').html(res);
            $('#AddSubject').modal('hide');
            $('#createRoutineModal').modal('show');
        }, (err) => {
            return errorHandler([
                {name: '.routine_subject_classname_error', data: err.responseJSON.errors.class_id},
                {name: '.routine_subjectname_error', data: err.responseJSON.errors.subject_name},
                {name: '.routine_subject_code_error', data: err.responseJSON.errors.subject_code},
            ])
        }, fromData);

    });
    $("body").on("click", ".addClassroomClass", function() {
        $('#createRoutineModal').modal('hide');
        $('#AddClassRoom').modal('show');
    });
    $("body").on("click", ".submitClassroom", function() {

        let fromData = $("#formClassroom").serializeArray();
        return asyncHandler("{{route('backend.admin-save-classroom')}}", "POST", (res) =>{
            $('#routine_response_modal_data').html(res);
            $('#createRoutineModal').modal('show');
            $('#AddClassRoom').modal('hide');
        }, (err) => {
            return errorHandler([
                {name: '.routine_classroom_name_error', data: err.responseJSON.errors.classroom_name},
                {name: '.routine_classroom_description_error', data: err.responseJSON.errors.classroom_description},
            ])
        }, fromData);

    });

    $("body").on("click", ".addRoutineTeacher", function() {
        $('#Addteacher').modal('show');
        $('#createRoutineModal').modal('hide');
    });
    $("body").on("click", ".saveteacher", function() {

        let fromData = $("#routine_addteacher").serializeArray();
        return asyncHandler("{{route('backend.routine-save-teacher')}}", "POST", (res) =>{
            $('#routine_response_modal_data').html(res);
            $('#Addteacher').modal('hide');
            $('#createRoutineModal').modal('show');
        }, (err) => {
            return errorHandler([
                {name: '.teacher_name_error', data: err.responseJSON.errors.name},
                {name: '.teacher_email_error', data: err.responseJSON.errors.email},
                {name: '.teacher_password_error', data: err.responseJSON.errors.password},
                {name: '.teacher_phone_error', data: err.responseJSON.errors.phone},
                {name: '.teacher_gender_error', data: err.responseJSON.errors.gender},
            ])
        }, fromData);

    });
    $("body").on("click", ".addExam", function() {
        $('#AddExamSchedule').modal('hide');
        $('#addExam').modal('show');
    });

    $("body").on("click", ".create_exam", function() {

        let fromData = $("#create_exam_save").serializeArray();
        return asyncHandler("{{route('backend.exam-save-examschedule')}}", "POST", (res) =>{
            $('#exam_schedule_response_modal_data').html(res);
            $('#AddExamSchedule').modal('show');
            $('#addExam').modal('hide');
        }, (err) => {
            return errorHandler([
                {name: '.exam_name_error', data: err.responseJSON.errors.name},
                {name: '.exam_startdate_error', data: err.responseJSON.errors.start_date},
                {name: '.exam_enddate_error', data: err.responseJSON.errors.end_date},
                {name: '.exam_note_error', data: err.responseJSON.errors.note},
            ])
        }, fromData);

    });
    $("body").on("click", ".addExamClass", function() {
        $('#addClass').modal('show');
        $('#AddExamSchedule').modal('hide');
        $('#addClass').find('.submitClass').addClass('NewClassExamSubmit');
        $('#addClass').find('.submitClass').removeClass('submitClass');
    });
    $("body").on("click", ".NewClassExamSubmit", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.class-save-examschedule')}}", "POST", (res) =>{
            $('#exam_schedule_response_modal_data').html(res);
            $('#AddExamSchedule').modal('show');
            $('#addClass').modal('hide');
            $('#addClass').find('.NewClassExamSubmit').addClass('submitClass');
            $('#addClass').find('.NewClassExamSubmit').removeClass('NewClassExamSubmit');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });
    $("body").on("click", ".addExamSection", function() {

        $.ajax({
            url: "{{route('backend.section-response')}}",
            success: function(data) {
                $('#section_response_data').html(data);

                $('#addSection').modal('show');
                $('#AddExamSchedule').modal('hide');

                $('#addSection').find('.submitSection').addClass('submitExamSectionData');
                $('#addSection').find('.submitSection').removeClass('submitSection');
                $('#addSection').find('.addSectionClass').addClass('addExamSectionClass');
                $('#addSection').find('.addSectionClass').removeClass('addSectionClass');
            },
        })

    });
    $("body").on("click", ".addExamSectionClass", function() {

        $.ajax({
            url: "{{route('backend.class-response')}}",
            success: function(data) {
                $('#class_response_data').html(data);

                $('#addClass').modal('show');
                $('#addSection').modal('hide');

                $('#addClass').find('.submitClass').addClass('submitExamSectionClass');
                $('#addClass').find('.submitClass').removeClass('submitClass');
            },
        })

    });
    $("body").on("click", ".submitExamSectionClass", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.exam-schedule-class')}}", "POST", (res) =>{
            $('#section_response_data').html(res);
            $('#addClass').modal('hide');
            $('#addSection').modal('show');
            $('#addSection').find('.submitExamSectionClass').addClass('submitExamSectionData');
            $('#addSection').find('.submitExamSectionClass').removeClass('submitExamSectionClass');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });
    $("body").on("click", ".submitExamSectionData", function() {
        
        let fromData = $("#formSection").serializeArray();
        return asyncHandler("{{route('backend.save-examschedule-section')}}", "POST", (res) =>{
            $('#exam_schedule_response_modal_data').html(res);
            $('#AddExamSchedule').modal('show');
            $('#addSection').modal('hide');
            $('#addSection').find('.submitExamSectionData').addClass('submitSection');
            $('#addSection').find('.submitExamSectionData').removeClass('submitExamSectionData');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_id},
                {name: '.section_name_error', data: err.responseJSON.errors.section_name},
                {name: '.section_capacity_error', data: err.responseJSON.errors.section_capacity},
            ])
        }, fromData);

    });

    $("body").on("click", ".addExamclassroom", function() {

        let fromData = $("#formClassroom").serializeArray();
        return asyncHandler("{{route('backend.classroom-save-examschedule')}}", "POST", (res) =>{
            $('#exam_schedule_response_modal_data').html(res);
            $('#AddExamSchedule').modal('hide');
            $('#AddClassRoom').modal('show');
            $('#AddClassRoom').find('.submitClassroom').addClass('submitExamClassroom');
            $('#AddClassRoom').find('.submitClassroom').removeClass('submitClassroom');
        }, (err) => {
            return errorHandler([
                {name: '.classroom_name_error', data: err.responseJSON.errors.classroom_name},
                {name: '.classroom_description_error', data: err.responseJSON.errors.classroom_description}
            ])
        }, fromData);

    });
    $("body").on("click", ".submitExamClassroom", function() {
        $('#AddExamSchedule').modal('show');
        $('#AddClassRoom').modal('hide');
        $('#AddClassRoom').find('.submitExamClassroom').addClass('submitClassroom');
        $('#AddClassRoom').find('.submitExamClassroom').removeClass('submitExamClassroom');
    });
    $("body").on("click", ".addExamSubject", function() {
        $('#AddSubject').modal('show');
        $('#AddExamSchedule').modal('hide');
        $('#AddSubject').find('.AddSubjectSubmit').addClass('AddExamSubjectSubmit');
        $('#AddSubject').find('.AddSubjectSubmit').removeClass('AddSubjectSubmit');
    });
    $("body").on("click", ".AddExamSubjectSubmit", function() {

        let fromData = $("#formSubject").serializeArray();
        return asyncHandler("{{route('backend.save-examschedule-subject')}}", "POST", (res) =>{
            $('#routine_response_modal_data').html(res);
            $('#AddSubject').modal('hide');
            $('#AddExamSchedule').modal('show');
            $('#AddSubject').find('.AddExamSubjectSubmit').addClass('AddSubjectSubmit');
            $('#AddSubject').find('.AddExamSubjectSubmit').removeClass('AddExamSubjectSubmit');
        }, (err) => {
            return errorHandler([
                {name: '.routine_subject_classname_error', data: err.responseJSON.errors.class_id},
                {name: '.routine_subjectname_error', data: err.responseJSON.errors.subject_name},
                {name: '.routine_subject_code_error', data: err.responseJSON.errors.subject_code}
            ])
        }, fromData);

    });
    $("body").on("click", ".addSyllabusClass", function() {
        $('#addSyllabus').modal('hide');
        $('#addClass').modal('show');
        $('#addClass').find('.submitClass').addClass('submitSyllabusClass');
        $('#addClass').find('.submitClass').removeClass('submitClass');
    });
    $("body").on("click", ".submitSyllabusClass", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.save-syllabus-class')}}", "POST", (res) =>{
            $('#syllabus_response_modal_data').html(res);
            $('#addSyllabus').modal('show');
            $('#addClass').modal('hide');
            $('#addClass').find('.submitSyllabusClass').addClass('submitClass');
            $('#addClass').find('.submitSyllabusClass').removeClass('submitSyllabusClass');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });
    $("body").on("click", ".addSyllabusSection", function() {

        $.ajax({
            url: "{{route('backend.section-response')}}",
            success: function(data) {
                $('#section_response_data').html(data);

                $('#addSection').modal('show');
                $('#addSyllabus').modal('hide');
                $('#addSection').find('.submitSection').addClass('submitSyllabusSection');
                $('#addSection').find('.submitSection').removeClass('submitSection');

                $('#addSection').find('.addSectionClass').addClass('addSyllabusSectionClass');
                $('#addSection').find('.addSectionClass').removeClass('addSectionClass');
            },
        })

    });
    $("body").on("click", ".submitSyllabusSection", function() {

        let fromData = $("#formSection").serializeArray();
        return asyncHandler("{{route('backend.save-syllabus-section')}}", "POST", (res) =>{
            $('#syllabus_response_modal_data').html(res);
            $('#addSection').modal('hide');
            $('#addSyllabus').modal('show');
            $('#addSection').find('.submitSyllabusSection').addClass('submitSection');
            $('#addSection').find('.submitSyllabusSection').removeClass('submitSyllabusSection');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_id},
                {name: '.section_name_error', data: err.responseJSON.errors.section_name},
                {name: '.section_capacity_error', data: err.responseJSON.errors.section_capacity},
            ])
        }, fromData);

    });
    $("body").on("click", ".addSyllabusSectionClass", function() {

        $.ajax({
            url: "{{route('backend.class-response')}}",
            success: function(data) {
                $('#class_response_data').html(data);

                $('#addSection').modal('hide');
                $('#addClass').modal('show');
                $('#addClass').find('.submitClass').addClass('submitSyllabusSectionClass');
                $('#addClass').find('.submitClass').removeClass('submitClass');
            },
        })

    });
    $("body").on("click", ".submitSyllabusSectionClass", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.add-syllabus-class')}}", "POST", (res) =>{
            $('#section_response_data').html(res);
            $('#addSection').modal('show');
            $('#addClass').modal('hide');
            $('#addClass').find('.submitSyllabusSectionClass').addClass('addSyllabusSectionClass');
            $('#addSection').find('.submitSyllabusSectionClass').removeClass('submitSyllabusSectionClass');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });
    $("body").on("click", ".addSyllabusSubject", function() {
        $('#AddSubject').modal('show');
        $('#addSyllabus').modal('hide');
        $('#AddSubject').find('.AddSubjectSubmit').addClass('submitSyllabusSubjectClass');
        $('#AddSubject').find('.AddSubjectSubmit').removeClass('AddSubjectSubmit');
        $('#AddSubject').find('.AddSubjectClass').addClass('AddSyllabusSubjectClass');
        $('#AddSubject').find('.AddSubjectClass').removeClass('AddSubjectClass');
    });
    $("body").on("click", ".submitSyllabusSubjectClass", function() {

        let fromData = $("#formSubject").serializeArray();
        return asyncHandler("{{route('backend.save-syllabus-subject')}}", "POST", (res) =>{
            $('#syllabus_response_modal_data').html(res);
            $('#AddSubject').modal('hide');
            $('#addSyllabus').modal('show');
            $('#AddSubject').find('.submitSyllabusSubjectClass').addClass('AddSubjectSubmit');
            $('#AddSubject').find('.submitSyllabusSubjectClass').removeClass('submitSyllabusSubjectClass');
        }, (err) => {
            return errorHandler([
                {name: '.routine_subject_classname_error', data: err.responseJSON.errors.class_id},
                {name: '.routine_subjectname_error', data: err.responseJSON.errors.subject_name},
                {name: '.routine_subject_code_error', data: err.responseJSON.errors.subject_code}
            ])
        }, fromData);

    });
    $("body").on("click", ".AddSyllabusSubjectClass", function() {
        $('#AddSubject').modal('hide');
        $('#addClass').modal('show');
        $('#addClass').find('.submitClass').addClass('submitSyllabusSubjectClasss');
        $('#addClass').find('.submitClass').removeClass('submitClass');
    });
    $("body").on("click", ".submitSyllabusSubjectClasss", function() {
        $('#AddSubject').modal('show');
        $('#addClass').modal('hide');
        $('#addClass').find('.submitSyllabusSubjectClasss').addClass('submitClass');
        $('#addClass').find('.submitSyllabusSubjectClasss').removeClass('submitSyllabusSubjectClasss');
    });
    $("body").on("click", ".Addfeetype", function() {
        $('#addFeetype').modal('show');
        $('#addFee').modal('hide');
    });
    $("body").on("click", ".submitFeetype", function() {

        var formData = new FormData(document.getElementById("formFeetype"));
        $.ajax({
            url: "{{route('backend.save-fee-feetype')}}",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#fee_response_modal_data').html(data);

                $('#addFeetype').modal('hide');
                $('#addFee').modal('show');
            },
            error: function(response) {
                $('.feetype_name_error').text(response.responseJSON.errors.feetype_name);
                $('.feetype_image_error').text(response.responseJSON.errors.feetype_image);
            }
        });

    });
    $("body").on("click", ".AddfeeClass", function() {
        $('#addFee').modal('hide');
        $('#addClass').modal('show');
        $('#addClass').find('.submitClass').addClass('submitfeeClass');
        $('#addClass').find('.submitClass').removeClass('submitClass');
    });
    $("body").on("click", ".submitfeeClass", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.save-fee-class')}}", "POST", (res) =>{
            $('#fee_response_modal_data').html(res);
            $('#addFee').modal('show');
            $('#addClass').modal('hide');
            $('#addClass').find('.submitfeeClass').addClass('submitClass');
            $('#addClass').find('.submitfeeClass').removeClass('submitfeeClass');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });
    $("body").on("click", ".AddfeeSection", function() {

        $.ajax({
            url: "{{route('backend.section-response')}}",
            success: function(data) {
                $('#section_response_data').html(data);

                $('#addSection').modal('show');
                $('#addFee').modal('hide');
                $('#addSection').find('.submitSection').addClass('submitFeeSection');
                $('#addSection').find('.submitSection').removeClass('submitSection');
                $('#addSection').find('.addSectionClass').addClass('addfeeSectionClass');
                $('#addSection').find('.addSectionClass').removeClass('addSectionClass');
            },
        })

    });
    $("body").on("click", ".submitFeeSection", function() {

        let fromData = $("#formSection").serializeArray();
        return asyncHandler("{{route('backend.save-fee-section')}}", "POST", (res) =>{
            $('#fee_response_modal_data').html(res);
            $('#addSection').modal('hide');
            $('#addFee').modal('show');
            $('#addSection').find('.submitFeeSection').addClass('submitSection');
            $('#addSection').find('.submitFeeSection').removeClass('submitFeeSection');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_id},
                {name: '.section_name_error', data: err.responseJSON.errors.section_name},
                {name: '.section_capacity_error', data: err.responseJSON.errors.section_capacity},
            ])
        }, fromData);

    });
    $("body").on("click", ".addfeeSectionClass", function() {

        $.ajax({
            url: "{{route('backend.class-response')}}",
            success: function(data) {
                $('#class_response_data').html(data);

                $('#addSection').modal('hide');
                $('#addClass').modal('show');
                $('#addClass').find('.submitClass').addClass('submitfeeClasss');
                $('#addClass').find('.submitClass').removeClass('submitClass');
            },
        })

    });
    $("body").on("click", ".submitfeeClasss", function() {

        let fromData = $("#formClass").serializeArray();
        return asyncHandler("{{route('backend.add-fee-class')}}", "POST", (res) =>{
            $('#section_response_data').html(res);
            $('#addSection').modal('show');
            $('#addClass').modal('hide');
            $('#addClass').find('.submitfeeClasss').addClass('submitClass');
            $('#addClass').find('.submitfeeClasss').removeClass('submitfeeClasss');
        }, (err) => {
            return errorHandler([
                {name: '.class_name_error', data: err.responseJSON.errors.class_name},
                {name: '.class_numeric_error', data: err.responseJSON.errors.class_numeric},
            ])
        }, fromData);

    });
    $('#parents_id').on('keyup', function() {
        var query = $(this).val();
        $('.father_info').show();
        $(".guardian_info").hide();
        $.ajax({
            url: "{{route('backend.parent.parent_search')}}",
            type: 'GET',
            data: {
                'parent_name': query
            },
            success: function(data) {
                $('#parent_list').html(data);
            }
        })
    });
    $('#student_report').hide();
    $('#teacher_report').hide();
    $('#staff_report').hide();
    $('#routine_report').hide();
    $('#exam_report').hide();
    $('#student_attendence_report').hide();
    $('#teacher_attendence_report').hide();
    $("body").delegate('.choose_report_type .form-control', "change", function() {
        var choose_report_type = $(this).val();
        if (choose_report_type == '1') {
            $('#student_report').show();
            $('#teacher_report').hide();
        } else if (choose_report_type == '2') {
            $('#teacher_report').show();
            $('#student_report').hide();

            var table = $('.teacher_report_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('backend.report.teacher') }}",
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    // { data: 'department_name', name: 'department_name' },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
            });
        } else if (choose_report_type == '3') {
            $('#teacher_report').hide();
            $('#student_report').hide();
            $('#staff_report').show();

            var table = $('.staff_report_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('backend.report.staff') }}",
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
            });
        } else if (choose_report_type == '4') {
            $('#teacher_report').hide();
            $('#student_report').hide();
            $('#staff_report').hide();
            $('#routine_report').show();

            $('.getroutineclass').on("change", function() {
                // console.log('hiiii');
                $('.show_class').removeClass('d-none');

                $.ajax({
                    url: "{{ route('backend.show-class-info') }}",
                    type: "POST",
                    data: {
                        'session_id': $(this).val(),
                        '_token': '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(response) {

                        var classes = '';
                        classes = '<option value="" >Select Class</option>';
                        for (var i = 0; i < response.length; i++) {
                            classes += '<option value="' + response[i].id + '" >' + response[i].class_name + '</option>';
                        }
                        $('.getroutinesection').html(classes);

                    }
                });
            });

            $(document).delegate('.getroutinesection', 'change', function(e) {
                console.log('hi');
                $('.show_section').removeClass('d-none');

                $.ajax({
                    url: "{{ route('backend.get-section-info') }}",
                    type: "POST",
                    data: {
                        'section_id': $(this).val(),
                        '_token': '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(response) {

                        var sections = '';
                        sections = '<option value="" >Select Section</option>';
                        for (var i = 0; i < response.length; i++) {
                            sections += '<option value="' + response[i].id + '" >' + response[i].section_name + '</option>';
                        }
                        $('.getroutineInfo').html(sections);

                    }
                });
            });

            $(document).delegate('.getroutineInfo', 'change', function(e) {
                $('.show_route').removeClass('d-none');
            });

            $('.get_routine').click(function(e) {

                $('.preview_routine_calender').addClass('d-none');

                var class_id = $('#getSection').val();
                var section_id = $('#getInfo').val();
                $.ajax({
                    url: "{{ route('backend.show-subject-routine') }}",
                    type: "POST",
                    data: {
                        'class_id': class_id,
                        'section_id': section_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'html',
                    success: function(response) {
                        $('.show_class_routine').html(response);
                    }
                });
            });

            $('.preview_routine').click(function(e) {
                var session_id = $('.getroutineclass').val();
                var class_id = $('.getroutinesection').val();
                var section_id = $('.getroutineInfo').val();

                $.ajax({
                    url: "{{ route('backend.routine-report-list') }}",
                    type: "get",
                    data: {
                        'session_id': session_id,
                        'class_id': class_id,
                        'section_id': section_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(reponse) {

                        var routinhtml = '<div class="card preview_routine_calender mt-3"><div class="card-header border-bottom bg-white"><h4 class="card-title">Class Routine</h4></div><div class="card-body"><div id="calendar"></div></div></div>';

                        $('.show_class_routine').html(routinhtml);

                        var calendarEl = document.getElementById('calendar');
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            initialView: 'dayGridMonth',
                            dayMaxEvents: true,
                            events: reponse
                        });

                        calendar.render();

                    }
                });

            });
        } else if (choose_report_type == '5') {
            $('#teacher_report').hide();
            $('#student_report').hide();
            $('#staff_report').hide();
            $('#routine_report').hide();
            $('#exam_report').show();

            $('.getexamlist').on('change', function(e) {
                $(".show_exam").removeClass('d-none');
            });
            $(".getexamclass").on('change', function(e) {
                $(".show_class").removeClass('d-none');
            });
            $(".getexamsection").on('change', function(e) {
                $(".show_section").removeClass('d-none');

                var class_id = $(this).val();
                $.ajax({
                    url: "{{route('backend.get_section')}}",
                    type: 'GET',
                    data: {
                        'class_id': class_id
                    },
                    success: function(data) {
                        $(".getsectioninfo").html(data);
                    }
                })
            });
            $(".getsectioninfo").on('change', function(e) {
                $(".show_button").removeClass('d-none');
            });

            $('.get_report_exam_routine').click(function(e) {
                var serialize = $('#exam_report_form').serialize();
                $.ajax({
                    url: "{{route('backend.get_report_exam_routine')}}",
                    type: 'GET',
                    data: serialize,
                    success: function(data) {
                        $(".show_get_report_exam_routine").html(data);
                    }
                })
            });
        } else if (choose_report_type == '6') {
            $('#teacher_report').hide();
            $('#student_report').hide();
            $('#staff_report').hide();
            $('#routine_report').hide();
            $('#exam_report').hide();
            $('#student_attendence_report').show();
            
            $(".std_atten_session").on('change', function(e) {
                $(".show_class").removeClass('d-none');
            });
            $(".show_class").on('change', function(e) {
                $(".show_class").removeClass('d-none');
            });
            $(".std_atten_class").on('change', function(e) {
                $(".show_section").removeClass('d-none');
            });
            $(".std_atten_section").on('change', function(e) {
                $(".show_type").removeClass('d-none');
            });
            
            $(".std_atten_select_type").on('change', function(e) {
                if($(this).val() == 'date'){
                    $(".show_monthly").addClass('d-none');
                    $(".show_day").removeClass('d-none');
                }else{
                    $(".show_day").addClass('d-none');
                    $(".show_monthly").removeClass('d-none');
                }
            });


            $('.get_student_mark').click(function(e) {
                var serialize = $("#student_attendence_report_form").serialize();

                $.ajax({
                    url: "{{route('backend.get_student_attendence_report')}}",
                    type: 'GET',
                    data: serialize,
                    success: function(data) {
                        $(".show_student_attendence_report").html(data);
                    }
                })
            });

            $('.std_atten_class').on('change', function(e) {
                var class_id = $(this).val();
                $.ajax({
                    url: "{{route('backend.get_section')}}",
                    type: 'GET',
                    data: {
                        'class_id': class_id
                    },
                    success: function(data) {
                        $(".std_atten_section").html(data);
                    }
                })
            });
        } else if (choose_report_type == '7') {
            $('#teacher_report').hide();
            $('#student_report').hide();
            $('#staff_report').hide();
            $('#routine_report').hide();
            $('#exam_report').hide();
            $('#student_attendence_report').hide();
            $('#teacher_attendence_report').show();

            $('.get_teacher_list').click(function(e){
                get_teacher_list();
            });

            function get_teacher_list(){
                var attendence_date = $("#attendence_date").val();
                $.ajax({
                    url: "{{route('backend.get_teacher_attendence_list')}}",
                    type: 'GET',
                    data: {
                        'attendence_date': attendence_date
                    },
                    success: function(data) {
                        $(".show_teacher_list").html(data);
                    }
                })
            }

            $(document).delegate('.save_teacher_attendance', 'click', function() {
                var fromData = $("#save_teacher_attendance").serialize();

                $.ajax({
                    url: "{{route('backend.save_teacher_attendance')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: fromData,
                    success: function(data) {
                        if(data.success){
                            iziToast.success({
                                message: 'Teacher attendance update Successfully!',
                                position: 'topRight', 
                            })
                        }
                    }
                })
            });

        } else {
            $('#student_report').hide();
            $('#teacher_report').hide();
            $('#staff_report').hide();
            $('#routine_report').hide();
            $('#exam_report').hide();
            $('#student_attendence_report').hide();
            $('#teacher_attendence_report').hide();
        }
    });

    $(document).on('click', 'li', function() {
        var value = $(this).text();
        var id = $(this).attr('data-id');
        $('#parents_id').val(value);
        $('#parents_id_hidden').val(id);
        $('#parent_list').html("");
    });

    $("body").delegate('#class_id', "change", function() {
        var class_id = $(this).val();
        $.ajax({
            url: "{{route('backend.get_section')}}",
            type: 'GET',
            data: {
                'class_id': class_id
            },
            success: function(data) {
                $(".section_name").html(data);
            }
        })
    });

    $('.dropify').dropify();

    $(".attendence_date").flatpickr({
        dateFormat: "Y-m-d",
        maxDate: "today",
        defaultDate: "today"
    });
    $(document).ready(function() {
        $("#class_id").on('change', function(e) {
            $(".show_section").css('display', 'block');
        });
        $("#section_id").on('change', function(e) {
            $(".show_button").css('display', 'block');
        });

        $('#class_id').on('change', function(e) {
            var class_id = $(this).val();
            $.ajax({
                url: "{{route('backend.get_section')}}",
                type: 'GET',
                data: {
                    'class_id': class_id
                },
                success: function(data) {
                    $(".section_name").html(data);
                }
            })
        });

        $(document).delegate('.get_student_list', 'click', function() {

            let fromData = $("#get_student_list_form").serializeArray();
            return asyncHandler("{{route('backend.admin-showstudent-attendencelist')}}", "POST", (res) => $('#student_attendance_response_list').html(res),
            (err) => {
                return errorHandler([
                    {name: '.stdatd_class_name_error', data: err.responseJSON.errors.class_id},
                    {name: '.stdatd_section_name_error', data: err.responseJSON.errors.section_id},
                    {name: '.stdatd_attendence_date_error', data: err.responseJSON.errors.attendence_date},
                ])
            }, fromData);

        });

        $(document).delegate('.save_student_attendance', 'click', function() {
            var fromData = $("#save_student_attendance").serialize();
            $.ajax({
                url: "{{route('backend.save_student_attendance')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: fromData,
                success: function(data) {
                    //console.log(data);
                    if (data.success) {
                        iziToast.success({
                            message: 'Student attendance update Successfully!',
                            position: 'topRight',
                        })
                    }
                }
            })
        });

        $(document).delegate('.get_teacher_list', 'click', function() {
            var attendence_date = $(".attendence_date").val();
            $.ajax({
                url: "{{route('backend.admin-showteacher-attendencelist')}}",
                type: 'POST',
                data: {
                    'attendence_date': attendence_date
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#teacher_attendance_response_list').html(data);
                }
            })
        });

        $(document).delegate('.save_teacher_attendance', 'click', function() {
            var fromData = $("#save_teacher_attendance").serialize();
            $.ajax({
                url: "{{route('backend.save_teacher_attendance')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: fromData,
                success: function(data) {

                    // $('#teacher_attendance_response_list').html(data);

                    if (data.success) {
                        iziToast.success({
                            message: 'Teacher attendance update Successfully!',
                            position: 'topRight',
                        })
                    }

                }
            })
        });

        $(document).delegate('.get_student_report', 'click', function() {
            let serialize = $("#student_report_form").serializeArray();
            return asyncHandler("{{route('backend.get_student_report')}}", "GET",
                (res) => $('.show_student_report').html(res),
                (err) => {
                    return errorHandler([
                        {name: '.class_name_error', data: err.responseJSON.errors.class_id},
                        {name: '.section_name_error', data: err.responseJSON.errors.section_id},
                    ])
                }, serialize);
        });

        $('#save_event').click(function (){
            let serialize = $("#eventFrom").serializeArray();
            return asyncHandler("{{route('backend.save-calender-event')}}", "POST",
                (res) => $('#createEvent').modal('hide'),
                (err) => {
                    return errorHandler([
                        {name: '.event_title_error', data: err.responseJSON.errors.event_title},
                        {name: '.event_startdate_error', data: err.responseJSON.errors.start_date},
                        {name: '.event_enddate_error', data: err.responseJSON.errors.end_date},
                    ])
                }, serialize);
        });

    });

    "use strict";
    ! function(e) {
        function a() {
            this.$realData = []
        }
        a.prototype.createBarChart = function(e, a, r, t, o, i) {
            Morris.Bar({
                element: e,
                data: a,
                xkey: r,
                ykeys: t,
                labels: o,
                hideHover: "auto",
                resize: !0,
                gridLineColor: "rgba(173, 181, 189, 0.1)",
                barSizeRatio: .2,
                dataLabels: !1,
                barColors: i
            })
        }, a.prototype.createLineChart = function(e, a, r, t, o, i, n, s, l) {
            Morris.Line({
                element: e,
                data: a,
                xkey: r,
                ykeys: t,
                labels: o,
                fillOpacity: i,
                pointFillColors: n,
                pointStrokeColors: s,
                behaveLikeLine: !0,
                gridLineColor: "rgba(173, 181, 189, 0.1)",
                hideHover: "auto",
                resize: !0,
                pointSize: 0,
                dataLabels: !1,
                lineColors: l
            })
        }, a.prototype.createDonutChart = function(e, a, r) {
            Morris.Donut({
                element: e,
                data: a,
                resize: !0,
                colors: r,
                backgroundColor: "transparent"
            })
        }, a.prototype.init = function() {
            e("#morris-bar-example").empty(), e("#morris-line-example").empty(), e("#morris-donut-example").empty();
            this.createBarChart("morris-bar-example", [{
                y: "2010",
                a: 75
            }, {
                y: "2011",
                a: 42
            }, {
                y: "2012",
                a: 75
            }, {
                y: "2013",
                a: 38
            }, {
                y: "2014",
                a: 19
            }, {
                y: "2015",
                a: 93
            }], "y", ["a"], ["Statistics"], ["#188ae2"]);
            this.createLineChart("morris-line-example", [{
                y: "2008",
                a: 50,
                b: 0
            }, {
                y: "2009",
                a: 75,
                b: 50
            }, {
                y: "2010",
                a: 30,
                b: 80
            }, {
                y: "2011",
                a: 50,
                b: 50
            }, {
                y: "2012",
                a: 75,
                b: 10
            }, {
                y: "2013",
                a: 50,
                b: 40
            }, {
                y: "2014",
                a: 75,
                b: 50
            }, {
                y: "2015",
                a: 100,
                b: 70
            }], "y", ["a", "b"], ["Series A", "Series B"], ["0.9"], ["#ffffff"], ["#999999"], ["#10c469", "#188ae2"]);
            this.createDonutChart("morris-donut-example", [{
                label: "Download Sales",
                value: 12
            }, {
                label: "In-Store Sales",
                value: 30
            }, {
                label: "Mail-Order Sales",
                value: 20
            }], ["#ff8acc", "#5b69bc", "#35b8e0"])
        }, e.Dashboard1 = new a, e.Dashboard1.Constructor = a
    }(window.jQuery),
    function(a) {
        a.Dashboard1.init(), window.addEventListener("adminto.setBoxed", function(e) {
            a.Dashboard1.init()
        }), window.addEventListener("adminto.setFluid", function(e) {
            a.Dashboard1.init()
        })
    }(window.jQuery);
</script>
@endsection