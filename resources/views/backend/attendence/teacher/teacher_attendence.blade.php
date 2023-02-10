@extends('backend.layouts.app')
@section('title', 'Teacher Attendence')


@section('css')
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')


<div class="card">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <input type="date" id="attendence_date" name="attendence_date" class="form-control" value="{{ date('Y-m-d') }}">
                @error('attendence_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3 show_button"> 
                <button type="button" class="btn btn-primary get_teacher_list">Get Teacher List</button> 
            </div> 
        </div>
        <div class="show_teacher_list"></div>
    </div>
</div>


@endsection

@section('script')
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        $("#attendence_date").flatpickr({
            dateFormat: "Y-m-d",
            maxDate: "today",
            defaultDate : "today"
        });

        $(document).ready(function() {
    
            get_teacher_list();

            function get_teacher_list(){
                var attendence_date = $("#attendence_date").val();
                $.ajax({
                    url: "{{route('backend.get_teacher_attendence_list')}}",
                    type: 'GET',
                    data: {
                        'attendence_date': attendence_date
                    },
                    success: function(data) {

                        $(".show_teacher_list").html(data);
                    }
                })
            }

            $(document).delegate('.save_teacher_attendance', 'click', function() {
                var fromData = $("#save_teacher_attendance").serialize();

                $.ajax({
                    url: "{{route('backend.save_teacher_attendance')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: fromData,
                    success: function(data) {
                        //console.log(data);
                        if(data.success) 
                        {
                            iziToast.success({
                                message: 'Teacher attendance update Successfully!',
                                position: 'topRight', 
                            })
                        }
                    }
                })
            });

            $('.get_teacher_list').click(function(e){
                get_teacher_list();
            });


        });
    </script>

@endsection