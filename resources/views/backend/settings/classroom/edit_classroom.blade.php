@extends('backend.layouts.app')
@section('title', 'Edit Class Room')
@section('content')

 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-classroom') }}" class="btn btn-primary">List Classroom</a>
        </h4>
    </div>
</div>

<div class="card">
	<div class="card-body">
		<form id="formClassroom" action="{{route('backend.update-classroom')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{ $classroom->id }}">

            <div class="mb-2">
                <label>Classroom Name</label>
                <input type="text" class="form-control" name="classroom_name" value="{{ $classroom->classroom_name }}">
                @error('classroom_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Description</label>
                <textarea class="form-control" name="classroom_description">{!! $classroom->classroom_description !!}</textarea>
                @error('classroom_description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

			<div class="mt-4">
		        <button class="btn btn-primary" type="submit"> Update Classroom </button>
		    </div>
		</form>
	</div>
</div>

<script type="text/javascript">

</script>
@endsection