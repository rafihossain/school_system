@extends('backend.layouts.app')
@section('title', 'Add Feetype')

@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-feetype') }}" class="btn btn-primary">List Feetype</a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="formFeetype" action="{{route('backend.save-feetype')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-2">
                <label class="form-label">Feetype Name</label>
                <input type="text" class="form-control" name="feetype_name">
                @error('feetype_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label class="form-label">Upload Feetype</label>
                <input type="file" class="dropify" id="feetypeImage" name="feetype_image">
                @error('feetype_image')
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
