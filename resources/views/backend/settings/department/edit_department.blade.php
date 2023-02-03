@extends('backend.layouts.app')
@section('title', 'Edit Department')
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
		<form id="formDepartment" action="{{route('backend.update-department')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{$department->id}}">

			<div class="mb-2">
				<label class="form-label">Department Name</label>
				<input type="text" class="form-control" name="department_name"
                value="{{$department->department_name}}">
                @error('department_name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			<div class="mb-2">
                <label class="form-label">Description</label>
                <textarea id="editor" class="form-control" name="description">{{$department->description}}</textarea>

                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label class="form-label">Department Image</label>
                <input type="file" class="dropify" name="department_image" 
                data-default-file="{{asset('images/department/'.$department->department_image)}}">
                @error('department_image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
			<div class="form-check form-switch mb-2">
                <input type="hidden" name="department_status" value="0">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="department_status" value="1"
                {{ $department->department_status == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="customSwitch1">Publish</label>
            </div>
			<div class="mt-4">
		        <button class="btn btn-primary" type="submit"> Update Department </button>
		    </div>
		</form>
	</div>
</div>
@endsection

@section('script')

    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
    
@endsection