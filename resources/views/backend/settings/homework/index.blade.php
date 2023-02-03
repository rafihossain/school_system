@extends('backend.layouts.app')
@section('title', 'Homework Create')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
           <a class="btn btn-primary" href="#">+ Create</a>
        </h4>
    </div>
</div>
@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <select name="class_id" id="getSection" class="form-control">
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 show_section d-none">
                <select name="section_id" id="getInfo" class="form-control"></select>
            </div>
            <div class="col-md-2 show_route d-none">
                <button type="button" class="btn btn-primary get_homework">Get Homework</button>
            </div>
        </div>
    </div>
    <div class="card-body">
         <div class="show_class_routine"></div>
         <div class="mt-4 show_section" style="display: none;">
            <button type="button" class="btn btn-primary get_exam_schedule">Get Exam</button>
        </div>
        <div class="show_student_homework"></div>
    </div>
   
</div>

 




<div id="createHomeWorkModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="homeworkFrom" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Create Routine</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" id="save_close_homework">Close</button>
                    <button type="button" class="btn btn-primary" id="save_homework">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="updateHomeWorkModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateRoutineFrom" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Update Routine</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body showRoutineInfo">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateRoutine">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        // //create_report
        // $('.get_homework').on("click", function() {
        //     $('#routineFrom')[0].reset();
        //     $('#createRoutineModal').modal('show');

        //     $('.class').val($('#getSection').val());
        //     $('.section').val($('#getInfo').val());
        // });

        // $('#save_close_homework').on("click", function(e) {
        //     e.preventDefault();
        //     manage_ajax_create_homework(0);
        // });

        // $('#save_homework').on("click", function(e) {
        //     e.preventDefault();
        //     manage_ajax_create_homework(1);
        // });

        $('#updateRoutine').on("click", function(e) {
            e.preventDefault();

            var fromData = new FormData(document.getElementById("updateRoutineFrom"));
            $.ajax({
                url: "{{ route('backend.save-class-routine') }}",
                type: "POST",
                data: fromData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if (response.error == true) {
                        if (confirm('Schedule already exist!! Are you sure to overwrite this?')) {
                            routine_overwrite_check_update(response.data);
                        }
                    } else {
                        $('#updateRoutineModal').modal("hide");
                        $('.show_class_routine').html(response.data);
                    }

                },
                error: function(response) {
                    // console.log(response);
                    $('#class_error').text(response.responseJSON.errors.class_id);
                    $('#section_error').text(response.responseJSON.errors.section_id);
                    $('#subject_error').text(response.responseJSON.errors.subject_id);
                    $('#classroom_error').text(response.responseJSON.errors.classroom_id);
                    $('#teacher_error').text(response.responseJSON.errors.teacher_id);
                    $('#day_error').text(response.responseJSON.errors.day_id);
                    $('#starttime_error').text(response.responseJSON.errors.start_time);
                    $('#endtime_error').text(response.responseJSON.errors.end_time);
                }
            });
        });

        $(document).delegate('#delete', 'click', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete?')) {
                var deleteId = $(this).data('id');
                // console.log(deleteId);
                $.ajax({
                    url: "{{ route('backend.delete-class-routine') }}",
                    type: "POST",
                    data: {
                        'delete_id': deleteId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'html',
                    success: function(response) {
                        // console.log(deleteId);
                        $('.row_' + deleteId).remove();
                    }
                });
            }
        });

        $(document).delegate('.routine_edit', 'click', function(e) {
            e.preventDefault();

            var routineId = $(this).data('id');
            console.log(routineId);

            $.ajax({
                url: "{{ route('backend.edit-class-routine') }}",
                type: "get",
                data: {
                    routine_id: routineId
                },
                success: function(response) {
                    $('.showRoutineInfo').html(response);
                    $('#updateRoutineModal').modal('show');
                }
            });

        });

        $('#getSection').on("change", function() {

            $('.show_section').removeClass('d-none');

            $.ajax({
                url: "{{ route('backend.get-section-info') }}",
                type: "POST",
                data: {
                    'section_id': $(this).val(),
                    '_token': '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response) {

                    var sections = '';
                    sections = '<option value="" >Select Section</option>';
                    for (var i = 0; i < response.length; i++) {
                        sections += '<option value="' + response[i].id + '" >' + response[i].section_name + '</option>';
                    }
                    $('#getInfo').html(sections);

                }
            });
        });

        $(document).delegate('#getInfo', 'change', function(e) {
            $('.show_route').removeClass('d-none');
        });

        //get-routine
        $('.get_homework').click(function(e) {

            var class_id = $('#getSection').val();
            var section_id = $('#getInfo').val();
            $.ajax({
                url: "{{ route('backend.homework-save') }}",
                type: "POST",
                data: {
                    'class_id': class_id,
                    'section_id': section_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'html',
                success: function(response) {
                    $('.show_class_routine').html(response);
                }
            });
        });

        function routine_overwrite_check(data) {
            $.ajax({
                url: "{{ route('backend.routine-overwrite-check') }}",
                type: "POST",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success == true) {
                        $('#createRoutineModal').modal("hide");
                        $('.show_class_routine').html(response.data);
                    }
                }
            });
        }

        function routine_overwrite_check_update(data) {
            $.ajax({
                url: "{{ route('backend.routine-overwrite-check-update') }}",
                type: "POST",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success == true) {
                        $('#updateRoutineModal').modal("hide");
                        $('.show_class_routine').html(response.data);
                    }
                }
            });
        }

        function manage_ajax_create_routine(param) {
            var fromData = new FormData(document.getElementById("routineFrom"));
            $.ajax({
                url: "{{ route('backend.save-class-routine') }}",
                type: "POST",
                data: fromData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if (response.error == true) {
                        if (confirm(response.msg)) {
                            routine_overwrite_check(response.data);
                        }
                    } else {
                        if (param == 1) {
                            $('#createRoutineModal').modal("hide");
                        }

                        $('.subject').val('');
                        $('.day').val('');
                        $('.start_time').val('');
                        $('.end_time').val('');

                        $('.show_class_routine').html(response.data);

                        iziToast.success({
                            message: 'Successfully inserted recorded!',
                            position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                        })
                    }

                },
                error: function(response) {
                    $('#class_error').text(response.responseJSON.errors.class_id);
                    $('#section_error').text(response.responseJSON.errors.section_id);
                    $('#subject_error').text(response.responseJSON.errors.subject_id);
                    $('#classroom_error').text(response.responseJSON.errors.classroom_id);
                    $('#teacher_error').text(response.responseJSON.errors.teacher_id);
                    $('#day_error').text(response.responseJSON.errors.day_id);
                    $('#starttime_error').text(response.responseJSON.errors.start_time);
                    $('#endtime_error').text(response.responseJSON.errors.end_time);
                }
            });
        }
    });
</script>
@endsection