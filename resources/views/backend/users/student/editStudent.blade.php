@extends('backend.layouts.app')
@section('title', 'Edit Student')
@section('content')

<div class="card">
    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">BASIC INFORMATION</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">ADDITIONAL INFORMATION</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">DOCUMENTS CHECKLIST</button>
            </li>
        </ul>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form action="{{route('backend.student.student_basic_info_update')}}" method="post" enctype="multipart/form-data" id="edit_student">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$student->getStudent->id}}">
                            <input type="hidden" name="parent_id" value="{{$student->parent_id}}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Student Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" value="{{ $student->getStudent->name }}" placeholder="">
                                    @error('name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Date Of Birth</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" class="form-control" name="date_of_birth" value="{{ $student->date_of_birth }}" placeholder="Enter Password">
                                    @error('date_of_birth')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Gender</h5>
                                </div>
                                <div class="col-md-8">
                                    <select name="gender" id="" class="form-control">
                                        <option value="male" {{($student->getStudent->gender == 'male')?'selected':''}}>Male</option>
                                        <option value="female" {{($student->getStudent->gender == 'female')?'selected':''}}>Female</option>
                                    </select>
                                    @error('gender')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>B Form#</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="b_form" value="{{$student->b_form}}" placeholder="">
                                    @error('b_form')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Registration#</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="registration" value="{{$student->registration}}" placeholder="">
                                    @error('registration')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Department</h5>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="department_id" id="">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->id}}" 
                                        {{($department->id == $student->department_id)?'selected':''}}>{{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Class</h5>
                                </div>
                                <div class="col-md-8">
                                    <select name="class_id" id="" class="form-control">
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}" 
                                        {{($class->id == $student->class_id)?'selected':''}}>{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Section</h5>
                                </div>
                                <div class="col-md-8">
                                    <select name="section_id" id="" class="form-control">
                                        @foreach($sections as $section)
                                        <option value="{{$section->id}}" 
                                        {{($section->id == $student->section_id)?'selected':''}}>{{$section->section_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Parents</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" id="parents_id" class="form-control" autocomplete="off" value="{{$student->getParent->name}}">
                                    <input type="hidden" name="parent_id" id="parents_id_hidden" class="form-control" autocomplete="off" value="{{$student->parent_id}}">
                                    <div id="parent_list"></div>
                                    @error('section_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Father's Occupation</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="father_occupation" class="form-control" name="father_occupation" value="{{ $student->getparentBasicInfo->father_occupation }}">
                                    @error('father_occupation')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Father's CNIC #</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="father_cnic" class="form-control" name="father_cnic" value="{{ $student->getparentBasicInfo->father_cnic }}">
                                    @error('father_cnic')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Mothers's Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="mother_name" class="form-control" name="mother_name" value="{{ $student->getparentBasicInfo->mother_name }}">
                                    @error('mother_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Mother's Occupation</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="mother_occupation" class="form-control" name="mother_occupation" value="{{ $student->getparentBasicInfo->mother_name }}">
                                    @error('mother_occupation')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Guardian Name (if any)</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="guardian_name" value="{{ $student->getparentBasicInfo->guardian_name }}" placeholder="">
                                    @error('guardian_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5 class="father_info">Father's Office Address</h5>
                                    <h5 class="guardian_info">Guardian's Office Address</h5>
                                </div>
                                <div class="col-md-8">
                                    <textarea type="text" class="form-control" name="guardian_office_address">{{$student->guardian_office_address}}</textarea>
                                    @error('guardian_office_address')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5 class="father_info">Father's Office Phone#</h5>
                                    <h5 class="guardian_info">Guardian's Office Phone#</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="guardian_office_phone" value="{{$student->guardian_office_phone}}" placeholder="">
                                    @error('guardian_office_phone')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5 class="father_info">Father's Mobile Phone#</h5>
                                    <h5 class="guardian_info">Guardian's Mobile Phone#</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="guardian_mobile_phone" value="{{$student->guardian_mobile_phone}}" placeholder="">
                                    @error('guardian_mobile_phone')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5 class="father_info">Father's Whatsapp#</h5>
                                    <h5 class="guardian_info">Guardian's Whatsapp#</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="guardian_mobile_whatsapp" value="{{$student->guardian_mobile_whatsapp}}" placeholder="">
                                    @error('guardian_mobile_whatsapp')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5 class="father_info">Father's Email#</h5>
                                    <h5 class="guardian_info">Guardian's Email#</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="guardian_mobile_email" value="{{$student->guardian_mobile_email}}" placeholder="">
                                    @error('guardian_mobile_email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Upload Student Profile Picture</h5>
                                </div>
                                <div class="col-md-8">
                                    
                                    <input type="file" class="dropify" name="student_profile_pic"
                                    data-default-file="{{ asset('images/student/'.$student->student_profile_pic) }}">

                                    @error('student_profile_pic')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form action="{{route('backend.student.student_additional_info_update')}}" method="post" id="student_additional_info_update">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$student->getStudent->id}}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Residential Address</h5>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="residential_address" cols="2" rows="2">{{$StudentAdditionalInfo->residential_address}}</textarea>
                                    @error('residential_address')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Phone #</h5>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="student_phone" value="{{$StudentAdditionalInfo->student_phone}}">
                                    @error('student_phone')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Mobile Phone #</h5>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="student_mobile" value="{{$StudentAdditionalInfo->student_mobile}}">
                                    @error('student_mobile')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>whatsapp #</h5>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="student_whatsapp" value="{{$StudentAdditionalInfo->student_whatsapp}}">
                                    @error('student_whatsapp')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Email Address</h5>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="email" value="{{$student->getStudent->email}}">
                                    @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Religion</h5>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="religion" value="{{$StudentAdditionalInfo->religion}}">
                                    @error('religion')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Nationality</h5>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="nationality" value="{{$StudentAdditionalInfo->nationality}}">
                                    @error('nationality')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Domicile</h5>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="domicile" value="{{$StudentAdditionalInfo->domicile}}">
                                    @error('domicile')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Blood Group</h5>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="blood_group" value="{{$StudentAdditionalInfo->blood_group}}">
                                    @error('blood_group')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Medical History</h5>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="medical_history" value="{{$StudentAdditionalInfo->medical_history}}">
                                    @error('medical_history')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Any Special Instructons</h5>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="special_instruction" cols="2" rows="2">{{$StudentAdditionalInfo->special_instruction}}</textarea>
                                    @error('special_instruction')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Admission Date</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" name="admission_date" value="{{$student->admission_date}}" class="form-control">
                                    @error('admission_date')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Admission Cancel Date</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" name="admission_cancel_date" value="{{$StudentAdditionalInfo->admission_cancel_date}}" class="form-control">
                                    @error('admission_cancel_date')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Transport Required</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="transport_required" value="0">
                                    <input type="checkbox" name="transport_required" value="1" 
                                    {{($StudentAdditionalInfo->transport_required == '1')?'checked':''}}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Free Student</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="free_student" value="0">
                                    <input type="checkbox" name="free_student" value="1" 
                                    {{($StudentAdditionalInfo->free_student == '1')?'checked':''}}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Account Status</h5>
                                </div>
                                <div class="col-md-8">
                                    <select name="status" id="" class="form-control">
                                        <option value="active" 
                                        {{($StudentAdditionalInfo->status == 'active')?'selected':''}}>Active</option>
                                        <option value="inactive" 
                                        {{($StudentAdditionalInfo->status == 'inactive')?'selected':''}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <form action="{{route('backend.student.student_document_checklist_update')}}" method="post" id="student_document_checklist_update">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$student->getStudent->id}}">
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested 02 recent passport size photographs</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_passport_size_photograph" value="0">
                                    <input type="checkbox" name="attested_passport_size_photograph" value="1" {{($StudentDocumentChecklist->attested_passport_size_photograph == '1')?'checked':''}}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested photocopy of Parent's/Gurdians national I.D Card</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_national_id_card" value="0">
                                    <input type="checkbox" name="attested_national_id_card" value="1" 
                                    {{($StudentDocumentChecklist->attested_national_id_card == '1')?'checked':''}}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested photocopy of all certificats/degrees</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_all_certificate" value="0">
                                    <input type="checkbox" name="attested_all_certificate" value="1" 
                                    {{($StudentDocumentChecklist->attested_all_certificate == '1')?'checked':''}}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested any other relevent documents</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_relevent_document" value="0">
                                    <input type="checkbox" name="attested_relevent_document" value="1" 
                                    {{($StudentDocumentChecklist->attested_relevent_document == '1')?'checked':''}}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Migration Certificate in case of different Board/University</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="migration_certificate_different_board" value="0">
                                    <input type="checkbox" name="migration_certificate_different_board" value="1" {{($StudentDocumentChecklist->migration_certificate_different_board == '1')?'checked':''}}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Previous school leaving certificate</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="previous_school_leaving_certificate" value="0">
                                    <input type="checkbox" name="previous_school_leaving_certificate" value="1" 
                                    {{($StudentDocumentChecklist->	previous_school_leaving_certificate == '1')?'checked':''}}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>'B' form issued from Goverment</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="b_from_goverment" value="0">
                                    <input type="checkbox" name="b_from_goverment" value="1" 
                                    {{($StudentDocumentChecklist->b_from_goverment == '1')?'checked':''}}>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end row -->

<script>
    $(document).ready(function() {
        
        $('.dropify').dropify();

        $('.father_info').hide();
        $('.nav-pills button').on('shown.bs.tab', function(e) {
            //console.log($(e.target).attr('data-bs-target'));   
            localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#pills-tab button[data-bs-target="' + activeTab + '"]').tab('show');
        }

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

        $(document).on('click', 'li', function() {
            var value = $(this).text();
            var id = $(this).attr('data-id');
            $('#parents_id').val(value);
            $('#parents_id_hidden').val(id);
            $('#parent_list').html("");

            $.ajax({
                url: "{{route('backend.parent_additional_info')}}",
                type: 'GET',
                data: {
                    'parent_id': id
                },
                success: function(data) {

                    $("#father_name").val(data.father_name);
                    $("#father_occupation").val(data.father_occupation);
                    $("#father_cnic").val(data.father_cnic);
                    $("#mother_name").val(data.mother_name);
                    $("#mother_occupation").val(data.mother_occupation);
                }
            })
        });
    });
</script>
@endsection