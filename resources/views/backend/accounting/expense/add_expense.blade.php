@extends('backend.layouts.app')
@section('title', 'Add Expense')

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
        <form id="formFeetype" action="{{route('backend.save-expense')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-8 m-auto">
                <div class="mb-2">
                    <label class="form-label">Expense Type</label>
                    <select class="form-control" name="expensetype_id">
                        <option value="">Select Expense</option>
                        @foreach($expensetypes as $expensetype)
                            <option value="{{ $expensetype->id }}">{{ $expensetype->expense_name }}</option>
                        @endforeach
                    </select>
                    @error('expense_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Expense Ammount</label>
                    <input type="number" class="form-control" name="expense_ammount">
                    @error('expense_ammount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Expense Description</label>
                    <textarea class="form-control" name="expense_description"></textarea>
                    @error('expense_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                 <div class="mt-4">
                    <button class="btn btn-primary" type="submit" id="submitFeetype"> Submit </button>
                </div>
            </div>

           
        </form>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">
        $('.dropify').dropify();

        // $('#submitFeetype').click(function(e){
        //     e.preventDefault();

        //     var $fileUpload = $("#syllabusImage");
        //     if (parseInt($fileUpload.get(0).files.length)>10){
        //         alert("You can only upload a maximum of 10 ammendment files");
        //         return false;
        //     }else{
        //         $('#formSyllabus').submit();
        //     }
        // });

    </script>
    
@endsection
