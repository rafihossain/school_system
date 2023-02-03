@extends('backend.layouts.app')
@section('title', 'Edit Designation')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
          <a href="{{ route('backend.manage-designation') }}" class="btn btn-primary">List Designation</a>
        </h4>
    </div>
</div>
<div class="card">
	<div class="card-body">
		<form id="formDesignation" action="{{route('backend.update-designation')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{$designation->id}}">

			<div class="mb-2">
				<label>Designation Name</label>
				<input type="text" class="form-control" name="designation_name"
                value="{{$designation->designation_name}}">
                @error('designation_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
			</div>
            <div class="mb-2">
                <label>Designation Short Name</label>
                <input type="text" class="form-control" name="designation_short_name"
                value="{{$designation->designation_short_name}}">
                @error('designation_short_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
			<div class="mb-2">
                <label>Description</label>
                <textarea id="editor" class="form-control" name="description">{{$designation->description}}</textarea>

                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
			<div class="form-check form-switch mb-2">
                <input type="hidden" name="designation_status" value="0">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="designation_status" value="1"
                {{ $designation->designation_status == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="customSwitch1">Active</label>
            </div>
			<div class="mt-4">
		        <button class="btn btn-primary" type="submit"> Update Description </button>
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