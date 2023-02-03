@extends('backend.layouts.app')
@section('title', 'Homework Create')
@section('content')

 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
           <a class="btn btn-primary" href="{{route('backend.homework.create')}}">+ Create</a>
        </h4>
    </div>
</div>

@if(Session::has('success'))
<div class="alert alert-success" style="text-align: center;">
    {{ Session::get('success') }}
</div>
@endif

<div class="col-md-6 m-auto mb-3">
  <form action="{{route('backend.homework.save')}}" method="POST">
    @csrf
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="mb-2">
                    <label>Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" value="{{old('title')}}" placeholder="Enter Name">
                    @error('title')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Teacher <span class="text-danger">*</span></label>
                            <select name="teacher_id" id="teacher_id" class="form-control">
                                <option value="">Select Teacher</option>
                                @foreach($teachers as $teacher)
                                 <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Class <span class="text-danger">*</span></label>
                            <select name="class_id" id="class_id" class="form-control">
                                <option value="">Select Name</option>
                                @foreach($classes as $class)
                                 <option value="{{ $class->id }}">{{$class->class_name}}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Section <span class="text-danger">*</span></label>
                            <select name="section_id" id="section_id" class="form-control">
                              <option value="">Select Section</option>
                            </select>
                            @error('section_id')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" id="subject_id" class="form-control">
                               <option value="">Select Subject</option>
                            </select>
                            @error('subject_id')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Start Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{old('start_date')}}">
                            @error('start_date')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>End Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{old('end_date')}}">
                            @error('end_date')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <label>Description<span class="text-danger">*</span></label>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">

                    </textarea>
                    @error('end_date')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
  </form> 
</div>


<script>

    $(document).ready(function() {
        $('#class_id').on('change', function(e) {
        var class_id = $(this).val();
        $.ajax({
            url: "{{route('backend.get_section_subject')}}",
            type: 'GET',
            data: {
                'class_id': class_id
            },
            success: function(data) {
                $("#section_id").html(data['sectons']);
                $("#subject_id").html(data['subjects']);

            }
         })
      });

    });
</script>
@endsection