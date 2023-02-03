@extends('backend.layouts.app')
@section('title', 'Add Expense Type')

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
        <form id="formFeetype" action="{{route('backend.save-expense-type')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-2">
                <label class="form-label">Expense Name</label>
                <input type="text" class="form-control" name="expense_name">
                @error('expense_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label class="form-label">Upload Expense Image</label>
                <input type="file" class="dropify" id="expenseImage" name="expense_image">
                @error('expense_image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button class="btn btn-primary" type="submit" id="submitFeetype"> Submit </button>
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
