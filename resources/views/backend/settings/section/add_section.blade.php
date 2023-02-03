@extends('backend.layouts.app')
@section('title', 'Add Section')
@section('content')
<div class="card">
    <div class="card-body">
        <form id="formSection" action="{{route('backend.save-section')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-2">
                <label>Class Name</label>
                <select name="class_id" class="form-control">
                    <option value="">Select Name</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Section Name</label>
                <input type="text" class="form-control" name="section_name" value="{{old('section_name')}}">
                @error('section_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Section Capacity</label>
                <input type="number" class="form-control" name="section_capacity" value="{{old('section_capacity')}}">
                @error('section_capacity')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center">
                <button class="btn btn-primary" type="submit" id="submitClass"> Add Section </button>
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
