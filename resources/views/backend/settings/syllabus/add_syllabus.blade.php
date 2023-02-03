@extends('backend.layouts.app')
@section('title', 'Add Syllabus')
 
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-syllabus') }}" class="btn btn-primary">List Syllabus</a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="formSyllabus" action="{{route('backend.save-syllabus')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-2">
                <label class="form-label">Syllabus Title</label>
                <input type="text" class="form-control" name="syllabus_title">
                @error('syllabus_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Class Name</label>
                <select name="class_id" class="form-control">
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Section Name</label>
                <select name="section_id" class="form-control">
                    <option value="">Select Section</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                    @endforeach
                </select>
                @error('section_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Subject Name</label>
                <select name="subject_id" class="form-control">
                    <option value="">Select Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                    @endforeach
                </select>
                @error('subject_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label class="form-label">Upload Syllabus</label>
                <input type="file" class="dropify" id="syllabusImage" name="syllabus_image[]" multiple>
                @error('syllabus_image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button class="btn btn-primary" type="submit" id="submitSyllabus"> Add Submit </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">
        $('.dropify').dropify();

        $('#submitSyllabus').click(function(e){
            e.preventDefault();

            var $fileUpload = $("#syllabusImage");
            if (parseInt($fileUpload.get(0).files.length)>10){
                alert("You can only upload a maximum of 10 ammendment files");
                return false;
            }else{
                $('#formSyllabus').submit();
            }
        });

    </script>
    
@endsection
