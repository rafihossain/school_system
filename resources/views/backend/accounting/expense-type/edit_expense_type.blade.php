@extends('backend.layouts.app')
@section('title', 'Edit Expense Type')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-expense-type') }}" class="btn btn-primary">List Expense Type</a>
        </h4>
    </div>
</div>

<div class="card">
	<div class="card-body">
		<form id="formFeetype" action="{{route('backend.update-expense-type')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{ $expensetype->id }}">

            <div class="mb-2">
                <label class="form-label">Expense Name</label>
                <input type="text" name="expense_name" class="form-control" value="{{ $expensetype->expense_name }}">
                @error('expense_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Upload Expense Type</label>
                <input type="file" class="dropify" name="expense_image" data-default-file="{{ asset($expensetype->expense_image) }}">
                @error('expense_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

			<div class="mt-4">
		        <button class="btn btn-primary" type="submit"> Update </button>
		    </div>
		</form>
	</div>
</div>

@endsection

@section('script')

    <script type="text/javascript">
        $('.dropify').dropify();

        $('.delete').click(function(e) {
            e.preventDefault();
            var deleteKey = $(this).data('delete');
            var deleteId = $(this).data('syllabus');
            jQuery.ajax({
                type: 'post',
                url: "{{route('backend.delete-syllabus-image')}}",
                data: {
                    delete_id: deleteId,
                    _token : "{{csrf_token()}}"
                },
                success: function(data) {
                    $('#syllabus_' + deleteKey).remove();
                    location.reload();
                }
            });
        });

    </script>
    
@endsection