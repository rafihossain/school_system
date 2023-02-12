@extends('backend.layouts.app')
@section('title', 'Homework Create')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary open_homework_modal" href="javascript:void(0)">+ Create</a>
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
                    <h4 class="modal-title" id="standard-modalLabel">Homework Create</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Enter Name">
                        <span class="text-danger title_error"></span>
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
                                <span class="text-danger teacher_error"></span>
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
                                <span class="text-danger class_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label>Section <span class="text-danger">*</span></label>
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="">Select Section</option>
                                </select>
                                <span class="text-danger section_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label>Subject <span class="text-danger">*</span></label>
                                <select name="subject_id" id="subject_id" class="form-control">
                                    <option value="">Select Subject</option>
                                </select>
                                <span class="text-danger subject_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label>Start Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{old('start_date')}}">
                                <span class="text-danger start_date_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label>End Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{old('end_date')}}">
                                <span class="text-danger end_date_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Description<span class="text-danger">*</span></label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror"></textarea>
                        <span class="text-danger description_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" id="save_close_homework">Save&Close</button>
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

        //create_homework
        $('.open_homework_modal').on("click", function() {
            $('#homeworkFrom')[0].reset();
            $('#createHomeWorkModal').modal('show');

            $('.class').val($('#getSection').val());
            $('.section').val($('#getInfo').val());
        });

        //get subject and section
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

        $('#class_id').on("click", function() {
            // $('.class').val($('#getSection').val());
            // $('.section').val($('#getInfo').val());
        });

        $('#save_close_homework').on("click", function(e) {
            e.preventDefault();
            manage_ajax_create_homework(1);
        });

        $('#save_homework').on("click", function(e) {
            e.preventDefault();
            manage_ajax_create_homework(2);
        });

        $('#updateHomework').on("click", function(e) {
            e.preventDefault();

            var serialize = $("#updateHomeworkFrom").serialize() + '&_token=' + '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route('backend.update-student-homework') }}",
                type: "POST",
                data: serialize,
                success: function(response) {
                    $('#updateHomeWorkModal').modal("hide");
                    $('.show_homework_info').html(response);
                },
                error: function(response) {
                    // console.log(response);
                    $('#title_error').text(response.responseJSON.errors.title);
                    $('#teacher_error').text(response.responseJSON.errors.teacher_id);
                    $('#class_error').text(response.responseJSON.errors.class_id);
                    $('#section_error').text(response.responseJSON.errors.section_id);
                    $('#subject_error').text(response.responseJSON.errors.subject_id);
                    $('#start_date_error').text(response.responseJSON.errors.start_date);
                    $('#end_date_error').text(response.responseJSON.errors.end_date);
                    $('#description_error').text(response.responseJSON.errors.description);
                }
            });
        });

        $(document).delegate('#delete', 'click', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete?')) {
                var deleteId = $(this).data('id');
                $.ajax({
                    url: "{{ route('backend.delete-student-homework') }}",
                    type: "POST",
                    data: {
                        'delete_id': deleteId,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('.row_' + deleteId).remove();
                    }
                });
            }
        });

        $(document).delegate('.homework_edit', 'click', function(e) {
            e.preventDefault();

            var homeworkId = $(this).data('id');
            console.log(homeworkId);

            $.ajax({
                url: "{{ route('backend.edit-student-homework') }}",
                type: "get",
                data: {
                    homework_id: homeworkId
                },
                success: function(response) {
                    $('.show_homework_info').html(response);
                    $('#updateHomeWorkModal').modal('show');
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
                url: "{{ route('backend.show-student-homework') }}",
                type: "POST",
                data: {
                    'class_id': class_id,
                    'section_id': section_id,
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('.show_student_homework').html(response);
                },
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

        function manage_ajax_create_homework(param) {
            var serialize = $("#homeworkFrom").serialize() + '&_token=' + '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route('backend.homework-save') }}",
                type: "POST",
                data: serialize,
                success: function(response) {

                    if (param == 1) {
                        $('#createHomeWorkModal').modal('hide');
                    }

                    $('.show_student_homework').html(response);
                    iziToast.success({
                        message: 'Successfully inserted recorded!',
                        position: 'topRight',
                    })

                },
                error: function(response) {
                    $('.title_error').text(response.responseJSON.errors.title);
                    $('.teacher_error').text(response.responseJSON.errors.teacher_id);
                    $('.class_error').text(response.responseJSON.errors.class_id);
                    $('.section_error').text(response.responseJSON.errors.section_id);
                    $('.subject_error').text(response.responseJSON.errors.subject_id);
                    $('.start_date_error').text(response.responseJSON.errors.start_date);
                    $('.end_date_error').text(response.responseJSON.errors.end_date);
                    $('.description_error').text(response.responseJSON.errors.description);
                }
            });
        }
    });
</script>
@endsection