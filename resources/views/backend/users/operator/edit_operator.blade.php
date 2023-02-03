@extends('backend.layouts.app')
@section('title', 'Edit Operator')
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
                        <form action="{{route('backend.update-basicinfo-operator')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$operator_edit->id}}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" value="{{$operator_edit->name}}" placeholder="Enter Name">
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
                                    <input type="text" class="form-control" name="email" value="{{$operator_edit->email}}" placeholder="Enter Email">
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
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
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
                                    <input type="text" class="form-control" name="phone" value="{{$operator_edit->mobile}}" placeholder="Enter Phone">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Upload Operator Profile Picture</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="form-control dropify" name="operator_profilepic" 
                                    data-default-file="{{ asset('images/operator/'.$operator_edit->user_Image) }}" placeholder="">
                                    @error('operator_profilepic')
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
                                        <option value="male" {{$operator_edit->gender == 'male'? 'selected':''}}>Male</option>
                                        <option value="female" {{$operator_edit->gender == 'female'? 'selected':''}}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form action="{{route('backend.update-additionalinfo-operator')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$operator_edit->id}}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>First Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="first_name" value="{{$operator_additional_info->first_name}}">
                                    @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Last Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="last_name" value="{{$operator_additional_info->last_name}}">
                                    @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Date Of Birth</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" class="form-control" name="date_of_birth" value="{{$operator_additional_info->date_of_birth}}">
                                    @error('date_of_birth')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Whatsapp</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="whatsapp" value="{{$operator_additional_info->whatsapp}}">
                                    @error('whatsapp')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Blood Group</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="blood_group" value="{{$operator_additional_info->blood_group}}">
                                    @error('blood_group')
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
                                        <option value="1" {{ $operator_edit->status == 1 ? 'selected':'' }}>Active</option>
                                        <option value="2" {{ $operator_edit->status == 2 ? 'selected':'' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Present Address</h5>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="present_address" cols="30" rows="2">{{$operator_additional_info->present_address}}</textarea>
                                    @error('present_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Permanent Address</h5>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="permanent_address" cols="30" rows="2">{{$operator_additional_info->permanent_address}}</textarea>
                                    @error('permanent_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                           
                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <form action="{{route('backend.update-document-checklist-operator')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$operator_edit->id}}">
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested 02 recent passport size photographs</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_passport_size_photograph" value="0">
                                    <input type="checkbox" name="attested_passport_size_photograph" value="1" 
                                    {{ $operator_document_checklist->attested_passport_size_photograph == 1 ? 'checked':'' }}>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested photocopy national I.D Card</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_national_id_card" value="0">
                                    <input type="checkbox" name="attested_national_id_card" value="1" 
                                    {{ $operator_document_checklist->attested_national_id_card == 1 ? 'checked':'' }}
                                    >
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