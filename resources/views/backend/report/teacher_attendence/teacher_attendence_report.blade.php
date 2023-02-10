@extends('backend.layouts.app')
@section('title', 'Teacher Attendance')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row justify-content-center">
            <div class="col-md-2 show_type">
                <select name="section_id" id="select_type" class="form-control">
                    <option value="">Select Type</option>
                    <option value="date">Date</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
            <div class="col-md-2 show_day date_click" style="display:none">
                <input type="date" class="form-control date_data" value="{{date('Y-m-d')}}">
            </div>
            <div class="col-md-2 show_monthly date_click" style="display:none">
                <input type="month" class="form-control date_data_month" value="{{date('Y-m')}}">
            </div>

            <div class="col-md-3 show_button">
                <button type="button" class="btn btn-primary get_student_mark">Get Attendence Report</button>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <h4 class="">Attendance</h4>
        <div class="show_teacher_attendence_report"></div>
    </div>
</div>
 
<script>
    $(document).ready(function() {

        $("#select_type").on('change', function(e) {
            if ($(this).val() == 'date') {
                $(".show_monthly").css('display', 'none');
                $(".show_day").css('display', 'block');
            } else {
                $(".show_day").css('display', 'none');
                $(".show_monthly").css('display', 'block');
            }
        });

        // $(".date_click").on('change', function(e) {
        //     $(".show_button").css('display', 'block');
        // });

        $('.get_student_mark').click(function(e) {

            var select_type = $("#select_type").val();
            var date_data = $(".date_data").val();
            var date_data_month = $(".date_data_month").val();

            $.ajax({
                url: "{{route('backend.get_teacher_attendence_report')}}",
                type: 'GET',
                data: {
                    'select_type': select_type,
                    'date_data': date_data,
                    'date_data_month': date_data_month
                },
                success: function(data) {
                    $(".show_teacher_attendence_report").html(data);
                }
            })
        });
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
</script>
@endsection