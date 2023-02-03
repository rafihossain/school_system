@extends('backend.layouts.app')
@section('title', 'Edit Section')
@section('content')

<div class="text-end mb-3">
    <a href="{{ route('backend.manage-section') }}" class="btn btn-primary">List Section</a>
</div>

<div class="card">
	<div class="card-body">
		<form id="formSection" action="{{route('backend.update-section')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{ $section->id }}">

            <div class="mb-2">
                <label>Class Name</label>
                <select name="class_id" class="form-control">
                    <option value="">Select Name</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}"  
                        {{ $class->id ==  $section->class->id ? 'selected' : '' }} >{{ $class->class_name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Section Name</label>
                <input type="text" class="form-control" name="section_name" value="{{ $section->section_name }}">
                @error('section_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Section Capacity</label>
                <input type="number" class="form-control" name="section_capacity" value="{{ $section->section_capacity }}">
                @error('section_capacity')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

			<div class="text-center">
		        <button class="btn btn-primary" type="submit"> Update Section </button>
		    </div>
		</form>
	</div>
</div>

<script type="text/javascript">

</script>
@endsection