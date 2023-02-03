@extends('backend.layouts.app')
@section('title', 'Add Department')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-department') }}" class="btn btn-primary">List Department</a>
        </h4>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form id="formDepartment" action="{{route('backend.save-department')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label class="form-label">Department Name</label>
                <input type="text" class="form-control" name="department_name"
                value="{{old('department_name')}}">
                @error('department_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Description</label>
                <textarea id="editor" class="form-control" name="description"></textarea>

                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label class="form-label">Department Image</label>
                <input type="file" class="dropify" name="department_image">
                @error('department_image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check form-switch mb-2">
                <input type="hidden" name="department_status" value="0">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="department_status" value="1">
                <label class="form-check-label" for="customSwitch1">Active</label>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary" type="submit"> Add Department </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
    <script>
        $('.dropify').dropify();
    </script>
@endsection