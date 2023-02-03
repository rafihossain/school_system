@extends('backend.layouts.app')
@section('title', 'Edit Subject')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-subject') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i> List Subject</a>
        </h4>
    </div>
</div>

<div class="card">
	<div class="card-body">
		<form id="formSubject" action="{{route('backend.update-subject')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{ $subject->id }}">

            <div class="mb-2">
                <label>Subject Name</label>
                <input type="text" class="form-control" name="subject_name" value="{{ $subject->subject_name }}">
                @error('subject_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Subject Code</label>
                <input type="text" class="form-control" name="subject_code" value="{{ $subject->subject_code }}">
                @error('subject_code')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

			<div class="mt-4">
		        <button class="btn btn-primary" type="submit"> Update Subject </button>
		    </div>
		</form>
	</div>
</div>

<script type="text/javascript">

</script>
@endsection