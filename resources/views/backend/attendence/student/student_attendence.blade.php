@extends('backend.layouts.app')
@section('title', 'Student Attendence')

@section('css')
<link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@if(Session::has('success'))
<div class="alert alert-success" style="text-align: center;">
    {{ Session::get('success') }}
</div>
@endif
<div class="alert alert-success d-none success_msg_show" style="text-align: center;">

</div>

<div class="alert alert-danger danger_msg_show text-center" style="display: none;">

</div>

<div class="card">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <input type="date" id="attendence_date" name="attendence_date" class="form-control" value="{{date('Y-m-d')}}">
                @error('attendence_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-2">
                <select name="class_id" id="class_id" class="form-control">
                    <option value="">Select Class</option>
                    @foreach($classes as $classe)
                    <option value="{{$classe->id}}">{{$classe->class_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 show_section" style="display:none">
                <select name="section_id" id="section_id" class="form-control">
                    <option value="">Select Section</option>

                </select>
            </div>
            <div class="col-md-3 show_button" style="display:none">
                <button type="button" class="btn btn-primary get_student_list">Get Student List</button>
            </div>
        </div>
        <div class="show_student_list"></div>
    </div>
</div>


@endsection

@section('script')
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script>
    $("#attendence_date").flatpickr({
        dateFormat: "Y-m-d",
        maxDate: "today",
        defaultDate: "today"
    });
    $(document).ready(function() {
        $("#class_id").on('change', function(e) {
            $(".show_section").css('display', 'block');
        });
        $("#section_id").on('change', function(e) {
            $(".show_button").css('display', 'block');
        });

        $('#class_id').on('change', function(e) {
            var class_id = $(this).val();
            $.ajax({
                url: "{{route('backend.get_section')}}",
                type: 'GET',
                data: {
                    'class_id': class_id
                },
                success: function(data) {
                    $("#section_id").html(data);
                }


            })
        });

        $('.get_student_list').click(function(e) {
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();
            var attendence_date = $("#attendence_date").val();
            $.ajax({
                url: "{{route('backend.get_student_attendence_list')}}",
                type: 'GET',
                data: {
                    'class_id': class_id,
                    'section_id': section_id,
                    'attendence_date': attendence_date
                },
                success: function(data) {

                    $(".show_student_list").html(data);
                }
            })
        });

        $(document).delegate('.save_student_attendance', 'click', function() {
            var fromData = $("#save_student_attendance").serialize();
            $.ajax({
                url: "{{route('backend.save_student_attendance')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: fromData,
                success: function(data) {
                    //console.log(data);
                    if (data.success) {
                        iziToast.success({
                            message: 'Student attendance update Successfully!',
                            position: 'topRight',
                        })
                    }
                }
            })
        });
    });
</script>
@endsection