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
                        <form action="{{route('backend.staff.basic_info_update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$staff_edit->id}}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$staff_edit->name}}" placeholder="Enter Name">
                                    @error('name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Email</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$staff_edit->email}}" placeholder="Enter Email">
                                    @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Password</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{$staff_edit->password}}" placeholder="Enter Password">
                                    @error('password')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Phone</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$staff_edit->mobile}}" placeholder="Enter Phone">
                                    @error('phone')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Upload Teacher Profile Picture</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="form-control @error('staff_profile_pic') is-invalid @enderror" name="staff_profile_pic" value="{{$staff_edit->user_Image}}" placeholder="">
                                    @error('staff_profile_pic')
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
                                        <option value="male" {{$staff_edit->gender == 'male'? 'selected':''}}>Male</option>
                                        <option value="female" {{$staff_edit->gender == 'female'? 'selected':''}}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                      <form action="{{route('backend.staff.staff_additional_info_update')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$staff_edit->id}}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>First Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{$staff_additional_info->first_name}}">
                                    @error('first_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Last Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{$staff_additional_info->last_name}}">
                                    @error('last_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Date Of Birth</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{$staff_additional_info->date_of_birth}}">
                                    @error('date_of_birth')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Whatsapp#</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{$staff_additional_info->whatsapp}}">
                                    @error('whatsapp')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Blood Group</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('blood_group') is-invalid @enderror" name="blood_group" value="{{$staff_additional_info->blood_group}}">
                                    @error('blood_group')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Present Address</h5>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control @error('present_address') is-invalid @enderror" name="present_address" cols="30" rows="2">{{$staff_additional_info->present_address}}</textarea>
                                    @error('present_address')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Permanent Address</h5>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control @error('permanent_address') is-invalid @enderror" name="permanent_address" cols="30" rows="2">{{$staff_additional_info->permanent_address}}</textarea>
                                    @error('office_address')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                      <form action="{{route('backend.staff.staff_document_checklist_update')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$staff_edit->id}}">
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested 02 recent passport size photographs</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_passport_size_photograph" value="0">
                                    <input type="checkbox" name="attested_passport_size_photograph" value="1" {{($StaffDocumentChecklist->attested_passport_size_photograph == '1')?'checked':''}}>
                                    
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested photocopy national I.D Card</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_national_id_card" value="0">
                                    <input type="checkbox" name="attested_national_id_card" value="1" {{($StaffDocumentChecklist->attested_national_id_card == '1')?'checked':''}}> 
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
        $('.nav-pills button').on('shown.bs.tab', function(e) {
            //console.log($(e.target).attr('data-bs-target'));   
            localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#pills-tab button[data-bs-target="' + activeTab + '"]').tab('show');
        }
    });
</script>
@endsection