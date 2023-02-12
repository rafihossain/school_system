@extends('backend.layouts.app')
@section('title', 'Exam Schedule Create')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" href="{{ route('backend.schedule.index') }}">Back</a>
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="alert alert-success d-none success_msg_show" style="text-align: center;">

        </div>

        <div class="card">
            <div class="card-body table-responsive">
                <form action="{{route('backend.schedule.save')}}" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">Exam</label>
                                <select name="exam_id" id="" class="form-control">
                                    <option value="">Select Exam</option>
                                    @foreach($exam_lists as $exam_list)
                                    <option value="{{$exam_list->id}}">{{$exam_list->name}}</option>
                                    @endforeach
                                </select>
                                @error('exam_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">Class</label>
                                <select name="class_id" id="class_id" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $classe)
                                    <option value="{{$classe->id}}">{{$classe->class_name}}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">Section</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="">Select Section</option>
                                </select>
                                @error('section_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">Class Room</label>
                                <select name="class_room_id" id="" class="form-control">
                                    <option value="">Select Class Room</option>
                                    @foreach($class_room as $class_rooms)
                                    <option value="{{$class_rooms->id}}">{{$class_rooms->classroom_name}}</option>
                                    @endforeach
                                </select>
                                @error('class_room_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">Subject</label>
                                <select name="subject_id" id="subject_id" class="form-control">
                                    <option value="">Select Subject</option>
                                </select>
                                @error('subject_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="recipient-name" class="col-form-label">Exam Date</label>
                                        <input type="date" class="form-control" name="exam_date">
                                        @error('exam_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="recipient-name" class="col-form-label">Start Time</label>
                                        <input type="time" class="form-control" name="start_time">
                                        @error('start_time')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="recipient-name" class="col-form-label">End Time</label>
                                        <input type="time" class="form-control" name="end_time">
                                        @error('end_time')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary">Svae</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- end row -->

<script>
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
</script>
@endsection