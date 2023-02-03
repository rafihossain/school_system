@extends('backend.layouts.app')
@section('title', 'Class Routine')

@section('css')
    <style>
        .custom-box{
            width: 265px;
            height: 125px;
            margin: 0 252px;
        }
        .btn-custome {
            color: #fff;
            background-color: #E04600;
            box-shadow: 0px 5px 3px 0px rgb(162 56 2);
            border-radius: 5px;
            padding: 4px 20px;
        }
        .preview_routine_calender a {
            color: #71b6f9;
        }
        .preview_routine_calender a div {
            color: #71b6f9 !important;
        }
    </style>
@endsection

@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a  href="javascript:void(0)" class="btn btn-primary create_report"><i class="mdi mdi-plus"></i>  Create</a>
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
               <div class="col-md-4 show_route d-none">
                    <button type="button" class="btn btn-primary get_routine">Get Routine</button>
                    <button type="button" class="btn btn-primary preview_routine">Preview Routine</button>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <div class="show_class_routine"></div>
        </div>
    </div>

    <!-- Right modal content -->
    <div id="createRoutineModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="routineFrom" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="standard-modalLabel">Create Routine</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Class</label>
                            <select name="class_id" class="form-control class">
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="class_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Section</label>
                            <select name="section_id" class="form-control section">
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="section_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Subject</label>
                            <select name="subject_id" class="form-control subject">
                                <option value="">Select Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="subject_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Class Room</label>
                            <select name="classroom_id" class="form-control class_room">
                                <option value="">Select Classroom</option>
                                @foreach($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->classroom_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="classroom_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Teacher</label>
                            <select name="teacher_id" class="form-control teacher">
                                <option value="">Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="teacher_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Day</label>
                            <select name="day_id" class="form-control day">
                                <option value="">Select Day</option>
                                <option value="1">Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                                <option value="6">Saturday</option>
                                <option value="7">Sunday</option>
                            </select>
                            <span class="text-danger" id="day_error"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label>Start Time</label>
                                    <input type="time" class="form-control start_time" name="start_time" value="09:00">
                                    
                                    <span class="text-danger" id="starttime_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label>End Time</label>
                                    <input type="time" class="form-control end_time" name="end_time" value="10:00">
                                    
                                    <span class="text-danger" id="endtime_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="saveRoutine">Save & Close</button>
                        <button type="button" class="btn btn-primary" id="save_routine">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Standard modal content -->

    <!-- Right modal content -->
    <div id="updateRoutineModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
    </div><!-- /.modal -->
    <!-- Standard modal content -->

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        //create_report
        $('.create_report').on("click",function(){
            $('#routineFrom')[0].reset();
            $('#createRoutineModal').modal('show');

            $('.class').val($('#getSection').val());
            $('.section').val($('#getInfo').val());
        });

        $('#saveRoutine').on("click",function(e){
            e.preventDefault();
            manage_ajax_create_routine(1);
        });

        $('#save_routine').on("click",function(e){
            e.preventDefault();
            manage_ajax_create_routine(2);
        });

        $('#updateRoutine').on("click",function(e){
            e.preventDefault();

            var fromData = new FormData(document.getElementById("updateRoutineFrom"));
            $.ajax({
                url: "{{ route('backend.save-class-routine') }}",
                type: "POST",
                data: fromData,
                cache:false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if(response.error == true){
                        if(confirm('Schedule already exist!! Are you sure to overwrite this?')){
                            routine_overwrite_check_update(response.data);
                        }
                    }else{
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

            if(confirm('Are you sure you want to delete?')){
                var deleteId = $(this).data('id');
                // console.log(deleteId);
                $.ajax({
                    url: "{{ route('backend.delete-class-routine') }}",
                    type: "POST",
                    data: {
                        'delete_id' : deleteId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'html',
                    success: function(response) {
                        // console.log(deleteId);
                        $('.row_'+deleteId).remove();
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
                type : "get",
                data : {
                    routine_id : routineId
                },
                success: function(response) {
                    $('.showRoutineInfo').html(response);
                    $('#updateRoutineModal').modal('show');
                }
            });

        });

        $('#getSection').on("change",function(){
            
            $('.show_section').removeClass('d-none');

            $.ajax({
                url: "{{ route('backend.get-section-info') }}",
                type: "POST",
                data: {
                    'section_id' : $(this).val(),
                    '_token': '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response) {

                    var sections = '';
                    sections = '<option value="" >Select Section</option>';
                    for(var i = 0; i < response.length; i++){
                        sections += '<option value="'+response[i].id+'" >'+response[i].section_name+'</option>';
                    }
                    $('#getInfo').html(sections);

                }
            });
        });

        $(document).delegate('#getInfo', 'change', function(e) {
            $('.show_route').removeClass('d-none');
        });

        //get-routine
        $('.get_routine').click(function(e) {

            $('.preview_routine_calender').addClass('d-none');

            var class_id = $('#getSection').val();
            var section_id = $('#getInfo').val();
            $.ajax({
                url: "{{ route('backend.show-subject-routine') }}",
                type: "POST",
                data: {
                    'class_id' : class_id,
                    'section_id' : section_id,
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

        function routine_overwrite_check(data){
            $.ajax({
                url: "{{ route('backend.routine-overwrite-check') }}",
                type: "POST",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success == true){
                        $('#createRoutineModal').modal("hide");
                        $('.show_class_routine').html(response.data);
                    }
                }
            });
        }
        function routine_overwrite_check_update(data){
            $.ajax({
                url: "{{ route('backend.routine-overwrite-check-update') }}",
                type: "POST",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success == true){
                        $('#updateRoutineModal').modal("hide");
                        $('.show_class_routine').html(response.data);
                    }
                }
            });
        }

        function manage_ajax_create_routine(param){
            var fromData = new FormData(document.getElementById("routineFrom"));
            $.ajax({
                url: "{{ route('backend.save-class-routine') }}",
                type: "POST",
                data: fromData,
                cache:false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if(response.error == true){
                        if(confirm(response.msg)){
                            routine_overwrite_check(response.data);
                        }
                    }else{
                        if(param == 1){
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


    //routin-preview
    $('.preview_routine').click(function(e) {
        var class_id = $('#getSection').val();
        var section_id = $('#getInfo').val();

        $.ajax({
            url: "{{ route('backend.preview-subject-routine') }}",
            type: "get",
            data: {
                'class_id' : class_id,
                'section_id' : section_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(reponse) {

                var routinhtml ='<div class="card preview_routine_calender mt-3"><div class="card-header border-bottom bg-white"><h4 class="card-title">Class Routine</h4></div><div class="card-body"><div id="calendar"></div></div></div>';

                $('.show_class_routine').html(routinhtml);

                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left  : 'prev,next today',
                        center: 'title',
                        right : 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    initialView: 'dayGridMonth',
                    dayMaxEvents: true,
                    events: reponse
                });

                calendar.render();

            }
        });
    
    });

</script>
@endsection