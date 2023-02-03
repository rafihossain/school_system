@extends('backend.layouts.app')
@section('title', 'Edit Class Teacher')
 

@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-class-teacher') }}" class="btn btn-primary">List Class Teacher</a>
        </h4>
    </div>
</div>

<div class="card">
	<div class="card-body">
		<form id="formTeacherClass" action="{{route('backend.update-class-teacher')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{ $classteacher->id }}">

            <div class="mb-2">
                <label class="form-label">Class Name</label>
                <select name="class_id" class="form-control">
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $class->id == $classteacher->class_id ? 'selected' : '' }}
                            >{{ $class->class_name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Section Name</label>
                <select name="section_id" class="form-control">
                    <option value="">Select Section</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ $section->id == $classteacher->section_id ? 'selected' : '' }}
                        >{{ $section->section_name }}</option>
                    @endforeach
                </select>
                @error('section_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Teacher Name</label>
                <select name="teacher_id" class="form-control">
                    <option value="">Select Teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $teacher->id == $classteacher->teacher_id ? 'selected' : '' }}
                        >{{ $teacher->trainer_name }}</option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

			<div class="mt-4">
		        <button class="btn btn-primary" type="submit"> Update Class </button>
		    </div>
		</form>
	</div>
</div>
<script type="text/javascript">

</script>
@endsection