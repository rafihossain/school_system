@extends('backend.layouts.app')
@section('title', 'Edit Designation')
 

@section('content')

<div class="text-end mb-3">
    <a href="{{ route('backend.manage-syllabus') }}" class="btn btn-primary">List Syllabus</a>
</div>

<div class="card">
	<div class="card-body">
		<form id="formSyllabus" action="{{route('backend.update-syllabus')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{ $syllabus->id }}">

            <div class="mb-2">
                <label class="form-label">Class Name</label>
                <select name="class_id" class="form-control">
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $class->id == $syllabus->class_id ? 'selected' : '' }}
                            >{{ $class->class_name }}</option>
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
                        <option value="{{ $section->id }}" {{ $section->id == $syllabus->section_id ? 'selected' : '' }}
                        >{{ $section->section_name }}</option>
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
                        <option value="{{ $subject->id }}" {{ $subject->id == $syllabus->subject_id ? 'selected' : '' }}
                        >{{ $subject->subject_name }}</option>
                    @endforeach
                </select>
                @error('subject_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Upload Syllabus</label>
                <input type="file" class="dropify" name="syllabus_image[]" multiple>
                @error('syllabus_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="mt-2">
                    @if($syllabusimages)
                        <input type="hidden" class="get_syllabus_id" name="syllabus_id">
                        @foreach($syllabusimages as $key => $image)
                        <div class="mb-3 overflow-hidden"  id="syllabus_{{$key}}">
                            <div style="position:relative;" class="px-2 text-start">
                                <a href="#" data-delete="{{$key}}" data-syllabus="{{ $image->id }}" class="delete" style="left:0; right:0;">
                                    <span class="btn btn-primary float-end">&Cross;</span>
                                </a>
        
                                <a href="{{ asset('/images/syllabus_image/'.$image->syllabus_images) }}" >{{$image->syllabus_images}}</a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

			<div class="mt-4">
		        <button class="btn btn-primary" type="submit"> Update Syllabus </button>
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