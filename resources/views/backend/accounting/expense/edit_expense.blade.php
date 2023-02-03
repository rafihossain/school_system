@extends('backend.layouts.app')
@section('title', 'Edit Expense')

@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-expense') }}" class="btn btn-primary">List Expense</a>
        </h4>
    </div>
</div>
<div class="card">
	<div class="card-body">
		<form id="formFeetype" action="{{route('backend.update-expense')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{ $expense->id }}">

            <div class="col-md-8 m-auto">
                <div class="mb-2">
                    <label class="form-label">Expense Type</label>
                    <select class="form-control" name="expensetype_id">
                        <option value="">Select Expense Type</option>
                        @foreach($expensetypes as $expensetype)
                            <option value="{{ $expensetype->id }}">{{ $expensetype->expense_name }}</option>
                        @endforeach
                    </select>
                    @error('expensetype_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Expense Ammount</label>
                    <input type="number" class="form-control" name="expense_ammount" value="{{ $expense->expense_ammount }}">
                    @error('expense_ammount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Expense Description</label>
                    <textarea class="form-control" name="expense_description">{{ $expense->expense_description }}</textarea>
                    @error('expense_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary" type="submit"> Update </button>
                </div>
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