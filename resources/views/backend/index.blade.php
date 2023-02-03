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
                        <h2 class="fw-normal pt-2 mb-1"> 256 </h2>
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
                        <h2 class="fw-normal pt-2 mb-1"> 156 </h2>
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
                        <h2 class="fw-normal pt-2 mb-1"> 25 </h2>
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
                        <h2 class="fw-normal pt-2 mb-1"> 6 </h2>
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
                            <select name="section_id" id="section_id" class="form-control">
                                <option value="">Select Section</option>
                            </select>
                            <span class="text-danger stdatd_section_name_error"></span>
                        </div>
                        <div class="col-md-3 show_button">
                            <button type="button" class="btn btn-primary get_student_list">Get Student List</button>
                        </div>
                    </div>
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
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Report </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="choose_report_type mb-3">
                    <select class="form-control">
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
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-3">
                            <select name="class_id" id="getSection" class="form-control">
                                <option value="">Select Class</option>
                                <option value="1">Class one</option>
                                <option value="2">Class two</option>
                                <option value="3">Class three</option>
                            </select>
                        </div>
                        <div class="col-md-3 show_section">
                            <select name="section_id" id="getInfo" class="form-control">
                                <option value="">Select Section</option>
                                <option value="1">Section-A</option>
                                <option value="4">Section-C</option>
                                <option value="6">Home Banner</option>
                            </select>
                        </div>
                        <div class="col-md-3 show_student">
                            <button type="button" class="btn btn-primary get_student_report">Get Student List</button>
                        </div>
                    </div>
                    <table class="table table-bordered table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>ROLL NUMBER</th>
                                <th>GENDER</th>
                                <th>DATE OF BIRTH</th>
                                <th>BLOOD GROUP</th>
                                <th>ADMISSION DATE</th>
                                <th>PARENT NAME</th>
                                <th>PARENT PHONE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rafi</td>
                                <td>1</td>
                                <td>male</td>
                                <td>2023-01-04</td>
                                <td>Ut sit hic odio porr</td>
                                <td>2018-05-26</td>
                                <td>Ursa Macdonald</td>
                                <td>+1 (578) 718-9931</td>
                                <td><a href="http://schoolmanagment.test/public/admin/student/view/4" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                            </tr>
                            <tr>
                                <td>Shovon</td>
                                <td>104</td>
                                <td>male</td>
                                <td></td>
                                <td></td>
                                <td>2023-01-09</td>
                                <td>Nazmul</td>
                                <td></td>
                                <td><a href="http://schoolmanagment.test/public/admin/student/view/6" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div id="teacher_report">
                    <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap teacher_report_datatable">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>DEPARTMENT</th>
                                <th>GENDER</th>
                                <th>PHONE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
                        <span class="text-danger" id="event_title_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Starting Date</label>
                            <input type="date" class="form-control" name="start_date">
                            <span class="text-danger" id="startdate_error"></span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Ending Date</label>
                            <input type="date" class="form-control" name="end_date">
                            <span class="text-danger" id="enddate_error"></span>
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
            success: (res) => resCallback(res),
            error: (err) => errCallback(err)
        })
    }

    const errorHandler = (param) => {
        for (let i=0; i <= param.length; i++) {
            $(param[i].name).text(param[i].data);
        }
    }


    $(document).ready(function() {

        /*=====================================================
                            New Implemented Code
        ========================================================*/

        $('#open_user_model').on('click', function() {

            asyncHandler("{{route('backend.add-user-modal')}}", "GET", (res) => {
                $('#add_user_modal_data').html(res);
                $('#addUser').modal('show');
            }, (err) => {
                console.log(err);
            });


            // $.ajax({
            //     url: "route('backend.add-user-modal')",
            //     success: function(data) {
            //         $('#add_user_modal_data').html(data);
            //         $('#addUser').modal('show');
            //     }
            // })
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
            var serialize = $('#add_student').serialize();
            $.ajax({
                url: "{{route('backend.admin-save-student')}}",
                type: "POST",
                data: serialize,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // $('#add_user_modal_data').html(data);

                    // $('#parent_content').hide();
                    // $('#student_content').hide();

                    // $('#addSection').modal('hide');
                    $('#addUser').modal('hide');
                },
                error: function(response) {
                    $('.student_name_error').text(response.responseJSON.errors.name);
                    $('.student_email_error').text(response.responseJSON.errors.email);
                    $('.student_password_error').text(response.responseJSON.errors.password);
                    $('.student_parent_error').text(response.responseJSON.errors.parent_id);
                    $('.student_department_error').text(response.responseJSON.errors.department_id);
                    $('.student_class_error').text(response.responseJSON.errors.class_id);
                    $('.student_section_error').text(response.responseJSON.errors.section_id);
                    $('.student_rollno_error').text(response.responseJSON.errors.roll_no);
                    $('.admission_date_error').text(response.responseJSON.errors.admission_date);
                    $('.student_gender_error').text(response.responseJSON.errors.gender);
                }
            });
        });
        $(document).delegate('.teacherinfosave', 'click', function(e) {
            e.preventDefault();

            var fromData = new FormData(document.getElementById("add_teacher"));
            $.ajax({
                url: "{{route('backend.admin-save-teacher')}}",
                type: "POST",
                data: fromData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#addUser').modal('hide');
                },
                error: function(response) {
                    $('.teacher_name_error').text(response.responseJSON.errors.name);
                    $('.teacher_email_error').text(response.responseJSON.errors.email);
                    $('.teacher_password_error').text(response.responseJSON.errors.password);
                    $('.teacher_phone_error').text(response.responseJSON.errors.phone);
                    $('.teacher_gender_error').text(response.responseJSON.errors.gender);
                }
            });
        });
        $(document).delegate('.staffinfosave', 'click', function(e) {
            e.preventDefault();

            var fromData = new FormData(document.getElementById("add_staff"));
            $.ajax({
                url: "{{route('backend.admin-save-staff')}}",
                type: "POST",
                data: fromData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#addUser').modal('hide');
                },
                error: function(response) {
                    $('.staff_name_error').text(response.responseJSON.errors.name);
                    $('.staff_email_error').text(response.responseJSON.errors.email);
                    $('.staff_password_error').text(response.responseJSON.errors.password);
                    $('.staff_phone_error').text(response.responseJSON.errors.phone);
                    $('.staff_gender_error').text(response.responseJSON.errors.gender);
                }
            });
        });
        $(document).delegate('.operatorinfosave', 'click', function(e) {
            e.preventDefault();

            var fromData = new FormData(document.getElementById("add_operator"));
            $.ajax({
                url: "{{route('backend.admin-save-operator')}}",
                type: "POST",
                data: fromData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#addUser').modal('hide');
                },
                error: function(response) {
                    $('.operator_name_error').text(response.responseJSON.errors.name);
                    $('.operator_email_error').text(response.responseJSON.errors.email);
                    $('.operator_password_error').text(response.responseJSON.errors.password);
                    $('.operator_phone_error').text(response.responseJSON.errors.phone);
                    $('.operator_gender_error').text(response.responseJSON.errors.gender);
                }
            });
        });
        $(document).delegate('.saveroutineinfo', 'click', function(e) {
            // alert('hi');
            var fromData = new FormData(document.getElementById("routineFrom"));
            $.ajax({
                url: "{{route('backend.save-class-routine')}}",
                type: "POST",
                data: fromData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#createRoutineModal').modal('hide');
                },
                error: function(response) {
                    $('.routine_class_error').text(response.responseJSON.errors.class_id);
                    $('.routine_section_error').text(response.responseJSON.errors.section_id);
                    $('.routine_subject_error').text(response.responseJSON.errors.subject_id);
                    $('.routine_classroom_error').text(response.responseJSON.errors.classroom_id);
                    $('.routine_teacher_error').text(response.responseJSON.errors.teacher_id);
                    $('.routine_day_error').text(response.responseJSON.errors.day_id);
                    $('.routine_starttime_error').text(response.responseJSON.errors.start_time);
                    $('.routine_endtime_error').text(response.responseJSON.errors.end_time);
                }
            });
        })
        $(document).delegate('.examscheduleinfo', 'click', function(e) {
            // alert('hi');
            var fromData = new FormData(document.getElementById("examSchedule"));
            $.ajax({
                url: "{{route('backend.save-examschedule-info')}}",
                type: "POST",
                data: fromData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#AddExamSchedule').modal('hide');
                },
                error: function(response) {
                    $('.exam_name_error').text(response.responseJSON.errors.exam_id);
                    $('.exam_classname_error').text(response.responseJSON.errors.class_id);
                    $('.exam_sectionname_error').text(response.responseJSON.errors.section_id);
                    $('.exam_classroom_name_error').text(response.responseJSON.errors.class_room_id);
                    $('.exam_subject_name_error').text(response.responseJSON.errors.subject_id);
                    $('.exam_date_error').text(response.responseJSON.errors.exam_date);
                    $('.start_time_error').text(response.responseJSON.errors.start_time);
                    $('.end_time_error').text(response.responseJSON.errors.end_time);
                }
            });
        })
        $(document).delegate('#submitSyllabus', 'click', function(e) {
            // alert('hi');
            var fromData = new FormData(document.getElementById("formSyllabus"));
            $.ajax({
                url: "{{route('backend.save-syllabus-info')}}",
                type: "POST",
                data: fromData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#addSyllabus').modal('hide');
                },
                error: function(response) {
                    $('.syllabus_title_error').text(response.responseJSON.errors.syllabus_title);
                    $('.syllabus_class_name_error').text(response.responseJSON.errors.class_id);
                    $('.syllabus_section_name_error').text(response.responseJSON.errors.section_id);
                    $('.syllabus_subject_name_error').text(response.responseJSON.errors.subject_id);
                    $('.syllabus_image_error').text(response.responseJSON.errors.syllabus_image);
                }
            });
        })
        $(document).delegate('.savefeebasicinfo', 'click', function(e) {
            // alert('hi');
            var fromData = new FormData(document.getElementById("feeFrom"));
            $.ajax({
                url: "{{route('backend.save-feebasic-info')}}",
                type: "POST",
                data: fromData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#addFee').modal('hide');
                },
                error: function(response) {
                    $('.fee_invoicetype_error').text(response.responseJSON.errors.syllabus_title);
                    $('.fee_feetype_error').text(response.responseJSON.errors.class_id);
                    $('.fee_class_error').text(response.responseJSON.errors.section_id);
                    $('.fee_section_error').text(response.responseJSON.errors.subject_id);
                    $('.fee_amountdue_error').text(response.responseJSON.errors.syllabus_image);
                    $('.fee_duedate_error').text(response.responseJSON.errors.syllabus_image);
                    $('.fee_status_error').text(response.responseJSON.errors.syllabus_image);
                    $('.fee_description_error').text(response.responseJSON.errors.syllabus_image);
                }
            });
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
        var serialize = $('#parentFrom').serialize();
        $.ajax({
            url: "{{route('backend.admin-save-parent')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#add_user_modal_data').html(data);

                $('#parent_content').hide();
                $('#student_content').show();

                $('#addparent').modal('hide');
                $('#addUser').modal('show');
            },
            error: function(response) {
                $('.parent_name_error').text(response.responseJSON.errors.name);
                $('.parent_email_error').text(response.responseJSON.errors.email);
                $('.parent_password_error').text(response.responseJSON.errors.password);
                $('.parent_phone_error').text(response.responseJSON.errors.phone);
                $('.parent_gender_error').text(response.responseJSON.errors.gender);
            }
        })
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
        var serialize = $('#formClass').serialize();
        $.ajax({
            url: "{{route('backend.admin-save-class')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#add_user_modal_data').html(data);

                $('#parent_content').hide();
                $('#student_content').show();

                $('#addClass').modal('hide');
                $('#addUser').modal('show');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        })
    });
    $("body").on("click", ".addRoutineClass", function() {
        $('#addClass').modal('show');
        $('#addClass').find('.submitClass').addClass('NewClassRoutineSubmit');
        $('#addClass').find('.submitClass').removeClass('submitClass');
        $('#createRoutineModal').modal('hide');
    });

    $("body").on("click", ".NewClassRoutineSubmit", function() {
        var serialize = $('#formClass').serialize();
        $.ajax({
            url: "{{route('backend.add-routine-class')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#routine_response_modal_data').html(data);
                $('#addClass').modal('hide');
                $('#createRoutineModal').modal('show');
                $('#addClass').find('.NewClassRoutineSubmit').addClass('submitClass');
                $('#addClass').find('.NewClassRoutineSubmit').removeClass('NewClassRoutineSubmit');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        })

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

        var serialize = $('#formClass').serialize();
        $.ajax({
            url: "{{route('backend.admin-routine-class')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#section_response_data').html(data);

                $('#addClass').modal('hide');
                $('#addSection').modal('show');
                $('#addClass').find('.submitRoutineClass').addClass('submitClass');
                $('#addClass').find('.submitRoutineClass').removeClass('submitRoutineClass');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        })
    });
    $("body").on("click", ".NewRoutineSactionSubmit", function() {

        var serialize = $('#formSection').serialize();
        $.ajax({
            url: "{{route('backend.add-routine-section')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#routine_response_modal_data').html(data);

                $('#addSection').modal('hide');
                $('#createRoutineModal').modal('show');
                $('#addSection').find('.NewRoutineSactionSubmit').addClass('submitSection');
                $('#addSection').find('.NewRoutineSactionSubmit').removeClass('NewRoutineSactionSubmit');

            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_id);
                $('.section_name_error').text(response.responseJSON.errors.section_name);
                $('.section_capacity_error').text(response.responseJSON.errors.section_capacity);
            }
        })

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

        var serialize = $('#formSection').serialize();
        $.ajax({
            url: "{{route('backend.admin-save-section')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#add_user_modal_data').html(data);

                $('#parent_content').hide();
                $('#student_content').show();

                $('#addSection').modal('hide');
                $('#addUser').modal('show');

            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_id);
                $('.section_name_error').text(response.responseJSON.errors.section_name);
                $('.section_capacity_error').text(response.responseJSON.errors.section_capacity);
            }
        })

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

        var serialize = $('#formClass').serialize();
        $.ajax({
            url: "{{route('backend.user-save-class')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#section_response_data').html(data);

                $('#addSection').modal('show');
                $('#addClass').modal('hide');
                $('#addClass').find('.NewClassSactionSubmit').addClass('submitClass');
                $('#addClass').find('.NewClassSactionSubmit').removeClass('NewClassSactionSubmit');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        })

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
        var serialize = $('#formSubject').serialize();
        $.ajax({
            url: "{{route('backend.admin-save-subject')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#routine_response_modal_data').html(data);

                $('#AddSubject').modal('hide');
                $('#createRoutineModal').modal('show');
            },
            error: function(response) {
                $('.routine_subject_classname_error').text(response.responseJSON.errors.class_id);
                $('.routine_subjectname_error').text(response.responseJSON.errors.subject_name);
                $('.routine_subject_code_error').text(response.responseJSON.errors.subject_code);
            }
        })
    });
    $("body").on("click", ".addClassroomClass", function() {
        $('#createRoutineModal').modal('hide');
        $('#AddClassRoom').modal('show');
    });
    $("body").on("click", ".submitClassroom", function() {
        var serialize = $('#formClassroom').serialize();
        $.ajax({
            url: "{{route('backend.admin-save-classroom')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#routine_response_modal_data').html(data);

                $('#createRoutineModal').modal('show');
                $('#AddClassRoom').modal('hide');
            },
            error: function(response) {
                $('.routine_classroom_name_error').text(response.responseJSON.errors.classroom_name);
                $('.routine_classroom_description_error').text(response.responseJSON.errors.classroom_description);
            }
        })
    });

    $("body").on("click", ".addRoutineTeacher", function() {
        $('#Addteacher').modal('show');
        $('#createRoutineModal').modal('hide');
    });
    $("body").on("click", ".saveteacher", function() {

        var fromData = new FormData(document.getElementById("routine_addteacher"));
        $.ajax({
            url: "{{route('backend.routine-save-teacher')}}",
            type: "POST",
            data: fromData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#routine_response_modal_data').html(data);

                $('#Addteacher').modal('hide');
                $('#createRoutineModal').modal('show');
            },
            error: function(response) {
                $('.teacher_name_error').text(response.responseJSON.errors.name);
                $('.teacher_email_error').text(response.responseJSON.errors.email);
                $('.teacher_password_error').text(response.responseJSON.errors.password);
                $('.teacher_phone_error').text(response.responseJSON.errors.phone);
                $('.teacher_gender_error').text(response.responseJSON.errors.gender);
            }
        });

    });
    $("body").on("click", ".addExam", function() {
        $('#AddExamSchedule').modal('hide');
        $('#addExam').modal('show');
    });

    $("body").on("click", ".create_exam", function() {
        var serialize = $("#create_exam_save").serialize();
        $.ajax({
            url: "{{route('backend.exam-save-examschedule')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#exam_schedule_response_modal_data').html(data);

                $('#AddExamSchedule').modal('show');
                $('#addExam').modal('hide');
            },
            error: function(response) {
                $('.exam_name_error').text(response.responseJSON.errors.name);
                $('.exam_startdate_error').text(response.responseJSON.errors.start_date);
                $('.exam_enddate_error').text(response.responseJSON.errors.end_date);
                $('.exam_note_error').text(response.responseJSON.errors.note);
            }
        });
    });
    $("body").on("click", ".addExamClass", function() {
        $('#addClass').modal('show');
        $('#AddExamSchedule').modal('hide');
        $('#addClass').find('.submitClass').addClass('NewClassExamSubmit');
        $('#addClass').find('.submitClass').removeClass('submitClass');
    });
    $("body").on("click", ".NewClassExamSubmit", function() {

        var serialize = $("#formClass").serialize();
        $.ajax({
            url: "{{route('backend.class-save-examschedule')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#exam_schedule_response_modal_data').html(data);

                $('#AddExamSchedule').modal('show');
                $('#addClass').modal('hide');
                $('#addClass').find('.NewClassExamSubmit').addClass('submitClass');
                $('#addClass').find('.NewClassExamSubmit').removeClass('NewClassExamSubmit');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        });
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

        var serialize = $("#formClass").serialize();
        $.ajax({
            url: "{{route('backend.exam-schedule-class')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#section_response_data').html(data);

                $('#addClass').modal('hide');
                $('#addSection').modal('show');

                $('#addSection').find('.submitExamSectionClass').addClass('submitExamSectionData');
                $('#addSection').find('.submitExamSectionClass').removeClass('submitExamSectionClass');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        });

    });
    $("body").on("click", ".submitExamSectionData", function() {
        // console.log('hi');
        var serialize = $('#formSection').serialize();
        $.ajax({
            url: "{{route('backend.save-examschedule-section')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#exam_schedule_response_modal_data').html(data);

                $('#AddExamSchedule').modal('show');
                $('#addSection').modal('hide');
                $('#addSection').find('.submitExamSectionData').addClass('submitSection');
                $('#addSection').find('.submitExamSectionData').removeClass('submitExamSectionData');

            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_id);
                $('.section_name_error').text(response.responseJSON.errors.section_name);
                $('.section_capacity_error').text(response.responseJSON.errors.section_capacity);
            }
        })


    });



    $("body").on("click", ".addExamclassroom", function() {

        var serialize = $("#formClassroom").serialize();
        $.ajax({
            url: "{{route('backend.classroom-save-examschedule')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#exam_schedule_response_modal_data').html(data);

                $('#AddExamSchedule').modal('hide');
                $('#AddClassRoom').modal('show');
                $('#AddClassRoom').find('.submitClassroom').addClass('submitExamClassroom');
                $('#AddClassRoom').find('.submitClassroom').removeClass('submitClassroom');
            },
            error: function(response) {
                $('.classroom_name_error').text(response.responseJSON.errors.classroom_name);
                $('.classroom_description_error').text(response.responseJSON.errors.classroom_description);
            }
        });

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

        var serialize = $('#formSubject').serialize();
        $.ajax({
            url: "{{route('backend.save-examschedule-subject')}}",
            type: 'POST',
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#routine_response_modal_data').html(data);

                $('#AddSubject').modal('hide');
                $('#AddExamSchedule').modal('show');
                $('#AddSubject').find('.AddExamSubjectSubmit').addClass('AddSubjectSubmit');
                $('#AddSubject').find('.AddExamSubjectSubmit').removeClass('AddExamSubjectSubmit');
            },
            error: function(response) {
                $('.routine_subject_classname_error').text(response.responseJSON.errors.class_id);
                $('.routine_subjectname_error').text(response.responseJSON.errors.subject_name);
                $('.routine_subject_code_error').text(response.responseJSON.errors.subject_code);
            }
        })

    });
    $("body").on("click", ".addSyllabusClass", function() {
        $('#addSyllabus').modal('hide');
        $('#addClass').modal('show');
        $('#addClass').find('.submitClass').addClass('submitSyllabusClass');
        $('#addClass').find('.submitClass').removeClass('submitClass');
    });
    $("body").on("click", ".submitSyllabusClass", function() {

        var serialize = $("#formClass").serialize();
        $.ajax({
            url: "{{route('backend.save-syllabus-class')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#syllabus_response_modal_data').html(data);

                $('#addSyllabus').modal('show');
                $('#addClass').modal('hide');

                $('#addClass').find('.submitSyllabusClass').addClass('submitClass');
                $('#addClass').find('.submitSyllabusClass').removeClass('submitSyllabusClass');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        });

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

        var serialize = $("#formSection").serialize();
        $.ajax({
            url: "{{route('backend.save-syllabus-section')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#syllabus_response_modal_data').html(data);

                $('#addSection').modal('hide');
                $('#addSyllabus').modal('show');
                $('#addSection').find('.submitSyllabusSection').addClass('submitSection');
                $('#addSection').find('.submitSyllabusSection').removeClass('submitSyllabusSection');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_id);
                $('.section_name_error').text(response.responseJSON.errors.section_name);
                $('.section_capacity_error').text(response.responseJSON.errors.section_capacity);
            }
        });

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

        var serialize = $("#formClass").serialize();
        $.ajax({
            url: "{{route('backend.add-syllabus-class')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#section_response_data').html(data);

                $('#addSection').modal('show');
                $('#addClass').modal('hide');
                $('#addClass').find('.submitSyllabusSectionClass').addClass('addSyllabusSectionClass');
                $('#addSection').find('.submitSyllabusSectionClass').removeClass('submitSyllabusSectionClass');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        });

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

        var serialize = $("#formSubject").serialize();
        $.ajax({
            url: "{{route('backend.save-syllabus-subject')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#syllabus_response_modal_data').html(data);

                $('#AddSubject').modal('hide');
                $('#addSyllabus').modal('show');
                $('#AddSubject').find('.submitSyllabusSubjectClass').addClass('AddSubjectSubmit');
                $('#AddSubject').find('.submitSyllabusSubjectClass').removeClass('submitSyllabusSubjectClass');
            },
            error: function(response) {
                $('.routine_subject_classname_error').text(response.responseJSON.errors.class_id);
                $('.routine_subjectname_error').text(response.responseJSON.errors.subject_name);
                $('.routine_subject_code_error').text(response.responseJSON.errors.subject_code);
            }
        });
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

        var serialize = $("#formClass").serialize();
        $.ajax({
            url: "{{route('backend.save-fee-class')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#fee_response_modal_data').html(data);

                $('#addFee').modal('show');
                $('#addClass').modal('hide');
                $('#addClass').find('.submitfeeClass').addClass('submitClass');
                $('#addClass').find('.submitfeeClass').removeClass('submitfeeClass');

            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        });

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

        var serialize = $("#formSection").serialize();
        $.ajax({
            url: "{{route('backend.save-fee-section')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#fee_response_modal_data').html(data);

                $('#addSection').modal('hide');
                $('#addFee').modal('show');
                $('#addSection').find('.submitFeeSection').addClass('submitSection');
                $('#addSection').find('.submitFeeSection').removeClass('submitFeeSection');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_id);
                $('.section_name_error').text(response.responseJSON.errors.section_name);
                $('.section_capacity_error').text(response.responseJSON.errors.section_capacity);
            }
        });

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

        var serialize = $("#formClass").serialize();
        $.ajax({
            url: "{{route('backend.add-fee-class')}}",
            type: "POST",
            data: serialize,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#section_response_data').html(data);

                $('#addSection').modal('show');
                $('#addClass').modal('hide');
                $('#addClass').find('.submitfeeClasss').addClass('submitClass');
                $('#addClass').find('.submitfeeClasss').removeClass('submitfeeClasss');
            },
            error: function(response) {
                $('.class_name_error').text(response.responseJSON.errors.class_name);
                $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
            }
        });

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
    $("body").delegate('.choose_report_type .form-control', "change", function() {
        var choose_report_type = $(this).val();
        if (choose_report_type == '1') {
            $('#student_report').show();
            $('#teacher_report').hide();
        } else if (choose_report_type == '2') {
            $('#teacher_report').show();
            $('#student_report').hide();
        } else {
            $('#student_report').hide();
            $('#teacher_report').hide();
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
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();
            var attendence_date = $(".attendence_date").val();
            $.ajax({
                url: "{{route('backend.admin-showstudent-attendencelist')}}",
                type: 'POST',
                data: {
                    'class_id': class_id,
                    'section_id': section_id,
                    'attendence_date': attendence_date
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#student_attendance_response_list').html(data);
                },
                error: function(response) {
                    $('.stdatd_class_name_error').text(response.responseJSON.errors.class_id);
                    $('.stdatd_section_name_error').text(response.responseJSON.errors.section_id);
                    $('.stdatd_attendence_date_error').text(response.responseJSON.errors.attendence_date);
                }
            })
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