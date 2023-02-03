@extends('backend.layouts.app')
@section('title', 'Edit Parent')
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
                        <form action="{{route('backend.parent.basic_info_update')}}" method="post" id="add_parent">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$parent_edit->id}}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$parent_edit->name}}" placeholder="Enter Name">
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
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$parent_edit->email}}" placeholder="Enter Email">
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
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
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
                                    value="{{$parent_edit->mobile}}" placeholder="Enter Phone">
                                    @error('phone')
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
                                        <option value="male" {{ $parent_edit->gender == 'male' ? 'selected':'' }}>Male</option>
                                        <option value="female" {{ $parent_edit->gender == 'female' ? 'selected':'' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Account Status</h5>
                                </div>
                                <div class="col-md-8">
                                    <select name="status" id="" class="form-control">
                                        <option value="1" {{ $parent_edit->status == 1 ?'selected':'' }}>Active</option>
                                        <option value="2" {{ $parent_edit->status == 2 ?'selected':'' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form action="{{route('backend.parent.additional_info_update')}}" method="post" id="parent_additional_info_update">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$parents_additional_info->user_id}}">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Father's Occupation</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('father_occupation') is-invalid @enderror" name="father_occupation" value="{{$parents_additional_info->father_occupation}}">
                                    @error('father_occupation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Father's NID#</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('father_cnic') is-invalid @enderror" name="father_cnic" value="{{$parents_additional_info->father_cnic}}">
                                    @error('father_cnic')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Mother's Name</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" value="{{$parents_additional_info->mother_name}}">
                                    @error('mother_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Mother's NID#</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('mother_nid') is-invalid @enderror" name="mother_nid" 
                                    value="{{ $parents_additional_info->mother_nid }}">
                                    @error('mother_nid')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <h5>Mother's Occupation</h5>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('mother_occupation') is-invalid @enderror" name="mother_occupation" 
                                    value="{{ $parents_additional_info->mother_occupation }}">
                                    @error('mother_occupation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <form action="{{route('backend.parent.parent_document_checklist_update')}}" method="post" id="parent_document_checklist_update">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$parent_edit->id}}">
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested father 02 recent passport size photographs</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_father_passport_size_photograph" value="0">
                                    <input type="checkbox" name="attested_father_passport_size_photograph" value="1" 
                                    {{ $ParentDocumentChecklist->attested_father_passport_size_photograph == '1' ? 'checked':'' }}>
                                    
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested father photocopy national I.D Card</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_father_national_id_card" value="0">
                                    <input type="checkbox" name="attested_father_national_id_card" value="1" 
                                    {{ $ParentDocumentChecklist->attested_father_national_id_card == 1 ? 'checked': '' }}> 
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested mother 02 recent passport size photographs</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_mather_passport_size_photograph" value="0">
                                    <input type="checkbox" name="attested_mather_passport_size_photograph" value="1" 
                                    {{ $ParentDocumentChecklist->attested_mather_passport_size_photograph == '1' ? 'checked':'' }}>
                                    
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <h5>Attested mother photocopy national I.D Card</h5>
                                </div>
                                <div class="col-md-7">
                                    <input type="hidden" name="attested_mother_national_id_card" value="0">
                                    <input type="checkbox" name="attested_mother_national_id_card" value="1" 
                                    {{ $ParentDocumentChecklist->attested_mother_national_id_card == 1 ? 'checked': '' }}> 
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