@extends('backend.layouts.app')
@section('title', 'Add Class')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
             <a href="{{ route('backend.manage-class') }}" class="btn btn-primary"> Class List</a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="formClass" action="{{route('backend.save-class')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-2">
                <label>Class Name</label>
                <input type="text" class="form-control class_name" name="class_name" value="{{old('class_name')}}">
                @error('class_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Class Numeric</label>
                <input type="input" class="form-control class_numeric" name="class_numeric" value="{{old('class_numeric')}}">
                @error('class_numeric')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check form-switch mb-2">
                <input type="hidden" name="class_status" value="0">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="class_status" value="1">
                <label class="form-check-label" for="customSwitch1">Active</label>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary" type="submit" id="submitClass"> Add Class </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">

        // $(function(){
        //     $('#submitSession').click(function(e){
        //         e.preventDefault();

                

        //     });

        // });

    </script>
    
@endsection
