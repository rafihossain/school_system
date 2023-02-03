@extends('backend.layouts.app')
@section('title', 'Edit Class')
@section('content')

 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
             <a href="{{ route('backend.manage-class') }}" class="btn btn-primary">List Class</a>
        </h4>
    </div>
</div>

<div class="card">
	<div class="card-body">
		<form id="formClass" action="{{route('backend.update-class')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{ $class->id }}">

            <div class="mb-2">
                <label>Class Name</label>
                <input type="text" class="form-control class_name" name="class_name" value="{{ $class->class_name }}">
                @error('class_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Class Numeric</label>
                <input type="input" class="form-control class_numeric" name="class_numeric" value="{{ $class->class_numeric }}">
                @error('class_numeric')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-check form-switch mb-2">
                <input type="hidden" name="class_status" value="0">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="class_status" value="1"
                {{ $class->class_status == 1 ? 'checked' : '' }} >
                <label class="form-check-label" for="customSwitch1">Publish</label>
            </div>

			<div class="mt-4">
		        <button class="btn btn-primary" type="submit"> Update Class </button>
		    </div>
		</form>
	</div>
</div>

<script type="text/javascript">

    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
            editor.ui.view.editable.element.style.height = '300px';
    } )
    .catch( error => {
        console.error( error );
    } );

	$('.imageupload').dropify();
	
	$('#relatedPost').select2({
        maximumSelectionLength: 3
    });

</script>
@endsection