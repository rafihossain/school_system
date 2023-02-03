@extends('backend.layouts.app')
@section('title', 'Calendar')

@section('css')
    <style>
        .fc-event, .fc-event:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
@endsection

@section('content') 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
          <a href="javascript:void(0)" class="btn btn-primary create_event"><i class="mdi mdi-plus"></i>Create</a>
        </h4>
    </div>
</div>
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

<div class="show_calender_event"></div>

<div id="createEvent" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="eventFrom">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Create Event</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Event Title</label>
                        <input type="text" class="form-control" name="event_title" placeholder="Enter Event Title">
                        <span class="text-danger" id="event_title_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Starting Date</label>
                            <input type="date" class="form-control" name="start_date">
                            <span class="text-danger" id="startdate_error"></span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Ending Date</label>
                            <input type="date" class="form-control" name="end_date">
                            <span class="text-danger" id="enddate_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="button" class="btn btn-primary" id="save_event">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="updateEvent" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="eventUpdateFrom">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Update Event</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body appendedText">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete_event">Delete</button>
                    <button type="button" class="btn btn-primary" id="update_event">Update</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endsection

@section('script')
<script type="text/javascript">


    $(document).ready(function() {

        //calender-list
        $.ajax({
            url: "{{ route('backend.show-events-list') }}",
            type: "get",
            success: function(response) {
                calender_response_html(response);
            },
        });

        $('.create_event').click(function(){
            $('#createEvent').modal('show');
        });

        //event-save
        $('#save_event').click(function(){
            var serialize = $('#eventFrom').serialize();
            $.ajax({
                url: "{{ route('backend.save-calender-event') }}",
                type: "POST",
                data: serialize,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    calender_response_html(response);
                    $('#createEvent').modal('hide');

                    iziToast.success({
                        message: 'Successfully inserted recorded!',
                        position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                    })
                },
                error: function(response) {
                    $('#event_title_error').text(response.responseJSON.errors.event_title);
                    $('#startdate_error').text(response.responseJSON.errors.start_date);
                    $('#enddate_error').text(response.responseJSON.errors.end_date);
                }
            });
        });

        //event-update
        $('#update_event').click(function(){
            var serialize = $('#eventUpdateFrom').serialize();
            console.log(serialize);
            $.ajax({
                url: "{{ route('backend.update-calender-event') }}",
                type: "POST",
                data: serialize,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    calender_response_html(response);
                    $('#updateEvent').modal('hide');

                    iziToast.info({
                        message: 'Successfully updated recorded!',
                        position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                    })
                },
                error: function(response) {
                    $('.event_title_error').text(response.responseJSON.errors.event_title);
                    $('.startdate_error').text(response.responseJSON.errors.start_date);
                    $('.enddate_error').text(response.responseJSON.errors.end_date);
                }
            });
        });

        //event-delete
        $('#delete_event').click(function(){
            var eventId = $('input[name="id"]').val();
            $.ajax({
                url: "{{ route('backend.delete-calender-event') }}",
                type: "get",
                data: {
                    event_id : eventId
                },
                success: function(response) {

                    calender_response_html(response);
                    $('#updateEvent').modal('hide');

                    iziToast.warning({
                        message: 'Successfully deleted recorded!',
                        position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                    })
                }
            });
        });

        function calender_response_html(response){
            var routinhtml ='<div class="card preview_routine_calender mt-3"><div class="card-header border-bottom bg-white"><h4 class="card-title">Class Routine</h4></div><div class="card-body"><div id="calendar"></div></div></div>';

            $('.show_calender_event').html(routinhtml);

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                dayMaxEvents: true,
                timeZone: 'local',
                events: response,
                eventClick: function(data, jsEvent, view) {
                    console.log(data.event);

                    var html = '<input type="hidden" name="id" value="'+data.event.id+'"><div class="mb-2"><label>Event Title</label><input type="text" class="form-control" name="event_title" placeholder="Enter Event Title" value="'+data.event.title+'"><span class="text-danger event_title_error"></span></div><div class="row"><div class="col-md-6 mb-2"><label>Starting Date</label><input type="date" class="form-control" name="start_date" value="'+formatDate(data.event.start)+'"><span class="text-danger startdate_error"></span></div><div class="col-md-6 mb-2"><label>Ending Date</label><input type="date" class="form-control" name="end_date" value="'+formatDate(data.event.end)+'"><span class="text-danger enddate_error"></span></div></div>';

                    $('.appendedText').html(html);
                    $('#updateEvent').modal('show');
                }
            });
            calendar.render();
        }

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            // console.log(d.getMonth());
            // console.log(d.getDate());
            // console.log(d.getFullYear());

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;

            return [year, month, day].join('-');
        }

    });

</script>
@endsection