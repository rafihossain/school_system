@extends('backend.layouts.app')
@section('title', 'Edit Session')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
             <a href="{{ route('backend.manage-session') }}" class="btn btn-primary"> Session List</a>
        </h4>
    </div>
</div>

<div class="card">
	<div class="card-body">
		<form id="formSession" action="{{route('backend.update-session')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{ $session->id }}">

			<div class="mb-2">
                <label>Session Name</label>
                <input type="text" class="form-control session_name" name="session_name" value="{{ $session->session_name }}">
                <div class="session_name_error"></div>
                @error('session_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Start Date</label>
                <input type="date" class="form-control start_date" name="start_date" value="{{ $session->start_date }}">
                <div class="start_date_error"></div>
                @error('start_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>End Date</label>
                <input type="date" class="form-control end_date" name="end_date" value="{{ $session->end_date }}">
                <div class="end_date_error"></div>
                @error('end_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-check form-switch mb-2">
                <input type="hidden" name="session_status" value="0">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="session_status" value="1"
                {{ $session->session_status == 1 ? 'checked' : '' }} >

                <label class="form-check-label" for="customSwitch1">Publish</label>
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