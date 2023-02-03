@extends('backend.layouts.app')
@section('title', 'Create Operator')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
             <form action="{{route('backend.save-operator')}}" method="post">
                @csrf
                <div class="row justify-content-center">
                  <div class="col-md-6">
                    <div class="mb-2">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter Name">
                        @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label>Email<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter Email">
                        @error('email')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label>Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Enter Password">
                        @error('password')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label>Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Enter Phone">
                        @error('phone')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label>Gender<span class="text-danger">*</span></label>
                        <div class="d-flex">
                            <div class="form-check me-2">
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
                        </div>
                        @error('gender')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-2 text-center">
                        <button class="btn btn-primary">Save</button>
                    </div>
                    </div>    
                 </div>
               </form>  
            </div>
        </div>
    </div>
</div> <!-- end row -->

@endsection