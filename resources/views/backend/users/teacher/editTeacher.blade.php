@extends('backend.layouts.app')
@section('title', 'Edit Teacher')
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
                        <form action="{{route('backend.teacher.basic_info_update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $teacher_edit->id }}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{$teacher_edit->name}}" placeholder="Enter Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Email</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" 
                                    value="{{$teacher_edit->email}}" placeholder="Enter Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Password</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" name="password"
                                    placeholder="Enter Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Phone</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" 
                                    value="{{$teacher_edit->mobile}}" placeholder="Enter Phone">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Upload Teacher Profile Picture</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="form-control dropify" name="teacher_profile_pic" 
                                    data-default-file="{{ asset('images/teacher/'.$teacher_edit->user_Image) }}">
                                    @error('teacher_profile_pic')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Gender</h5>
                                </div>
                                <div class="col-md-8">
                                    <select name="gender" id="" class="form-control">
                                        <option value="male" {{$teacher_edit->gender == 'male'? 'selected':''}}>Male</option>
                                        <option value="female" {{$teacher_edit->gender == 'female'? 'selected':''}}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form action="{{route('backend.teacher.teacher_additional_info_update')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $teacher_edit->id }}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Date Of Birth</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{$teacher_additional_info->date_of_birth}}">
                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Department</h5>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{($department->id == $teacher_additional_info->department_id)?'selected':''}}>{{$department->department_name}}</option>              
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Designation</h5>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control @error('designation_id') is-invalid @enderror" name="designation_id" id="">
                                        <option value="">Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}" {{($designation->id == $teacher_additional_info->designation_id)?'selected':''}}>{{$department->department_name}}>{{$designation->designation_name}}</option>              
                                        @endforeach
                                    </select>
                                    @error('designation_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Blood Group</h5>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="blood_id">
                                        <option value="">Select blood group</option>
                                        @foreach($bloods as $blood)
                                            <option value="{{ $blood->id }}"
                                            {{ $blood->id == $teacher_additional_info->blood_id ? 'selected' : '' }}>{{ $blood->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_group')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Address</h5>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control @error('present_address') is-invalid @enderror" name="present_address" cols="30" rows="2">{{$teacher_additional_info->present_address}}</textarea>
                                    @error('present_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Account Status</h5>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="">
                                        <option value="">---Select---</option>
                                        <option value="1" {{($teacher_edit->status == '1')?'selected':''}}>Active</option>
                                        <option value="2" {{($teacher_edit->status == '2')?'selected':''}}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <form action="{{route('backend.teacher.teacher_document_checklist_update')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$teacher_edit->id}}">
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested 02 recent passport size photographs</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_passport_size_photograph" value="0">
                                    <input type="checkbox" name="attested_passport_size_photograph" value="1" {{($TeacherDocumentChecklist->attested_passport_size_photograph == '1')?'checked':''}}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested photocopy national I.D Card</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_national_id_card" value="0">
                                    <input type="checkbox" name="attested_national_id_card" value="1" {{($TeacherDocumentChecklist->attested_national_id_card == '1')?'checked':''}}> 
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

        $('.nav-pills button').on('shown.bs.tab', function(e) { 
            localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#pills-tab button[data-bs-target="' + activeTab + '"]').tab('show');
        }
    });
</script>
@endsection