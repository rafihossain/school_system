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
            <a href="javascript:void(0)" class="btn btn-primary create_report"><i class="mdi mdi-plus"></i>Create</a>
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
                   <select name="session_id" id="getClass" class="form-control">
                        <option value="">Select Session</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                        @endforeach
                    </select>
                    @error('session_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-2 show_class d-none">
                    <select name="class_id" id="getSection" class="form-control"></select>
                </div>

                <div class="col-md-2 show_section d-none">
                    <select name="section_id" id="getInfo" class="form-control"></select>
                </div>
                <div class="col-md-4 show_route d-none">
                    <button type="button" class="btn btn-primary preview_routine">Get Class Routine</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="show_class_routine"></div>
        </div> 
    </div>

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        $('#getClass').on("change",function(){
            
            $('.show_class').removeClass('d-none');

            $.ajax({
                url: "{{ route('backend.show-class-info') }}",
                type: "POST",
                data: {
                    'session_id' : $(this).val(),
                    '_token': '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response) {

                    var classes = '';
                    classes = '<option value="" >Select Class</option>';
                    for(var i = 0; i < response.length; i++){
                        classes += '<option value="'+response[i].id+'" >'+response[i].class_name+'</option>';
                    }
                    $('#getSection').html(classes);

                }
            });
        });

        $(document).delegate('#getSection', 'change', function(e) {
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
    });

    //routin-preview
    $('.preview_routine').click(function(e) {
        var session_id = $('#getClass').val();
        var class_id = $('#getSection').val();
        var section_id = $('#getInfo').val();

        $.ajax({
            url: "{{ route('backend.routine-report-list') }}",
            type: "get",
            data: {
                'session_id' : session_id,
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