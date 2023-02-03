@extends('backend.layouts.app')
@section('title', 'Add Subject')
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
        <form id="formSubject" action="{{route('backend.save-subject')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
             <div class="mb-2">
                <label>Class Name</label>
                <select name="class_id" id="getSection" class="form-control">
                    <option value="">Select Class</option>
                    @foreach($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->class_name }}</option>
                    @endforeach
                </select>

                @error('class_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Subject Name</label>
                <input type="text" class="form-control" name="subject_name" value="{{old('subject_name')}}">
                @error('subject_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Subject Code</label>
                <input type="text" class="form-control" name="subject_code" value="{{old('subject_code')}}">
                @error('subject_code')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button class="btn btn-primary" type="submit"> Add Subject </button>
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
