@extends('backend.layouts.app')
@section('title', 'Student Attendance')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-center">
            <div class="col-md-2 mb-1">
                <select name="session_id" id="session_id" class="form-control">
                    <option value="">Select Session</option>
                    @foreach($sessions as $session)
                        <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                    @endforeach
                </select>
                @error('session_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="show_class  mb-1" style="display:none">
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
            <div class="show_section  mb-1" style="display:none">
                <select name="section_id" id="section_id" class="form-control">
                    <option value="">Select Section</option>
                </select>
            </div>
            <div class="show_type  mb-1" style="display:none">
                <select name="section_id" id="select_type" class="form-control">
                    <option value="">Select Type</option>
                    <option value="date">Date</option>
                    <option value="monthly">Monthly</option>   
                </select>
            </div>
            <div class="show_day date_click  mb-1" style="display:none">
                <input type="date" class="form-control date_data" value="{{date('Y-m-d')}}">
            </div>
            <div class="show_monthly date_click  mb-1" style="display:none">
                <input type="month" class="form-control date_data_month" value="{{date('Y-m')}}">
            </div>
            <div class="show_button  mb-1"> 
                <button type="button" class="btn btn-primary get_student_mark">Get Attendence Report</button>
            </div>
        </div>
    </div>
    <div class="card-body">'
        <div class="show_student_attendence_report"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#session_id").on('change', function(e) {
            $(".show_class").css('display','block');
        });
        $("#class_id").on('change', function(e) {
            $(".show_section").css('display','block');
        });
        $("#section_id").on('change', function(e) {
            $(".show_type").css('display','block');
        });
        
        $("#select_type").on('change', function(e) {
            if($(this).val() == 'date'){
                $(".show_monthly").css('display','none');
                $(".show_day").css('display','block');
            }else{
                $(".show_day").css('display','none');
                $(".show_monthly").css('display','block');
            }
        });

        // $(".date_click").on('change', function(e) {
        //     $(".show_button").css('display','block');
        // });

        $('.get_student_mark').click(function(e) {
            var session_id= $("#session_id").val();
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();
            var select_type = $("#select_type").val();
            var date_data = $(".date_data").val();
            var date_data_month = $(".date_data_month").val();

            $.ajax({
                url: "{{route('backend.get_student_attendence_report')}}",
                type: 'GET',
                data: {
                    'session_id': session_id,
                    'class_id': class_id,
                    'section_id': section_id,
                    'select_type': select_type,
                    'date_data': date_data,
                    'date_data_month':date_data_month
                },
                success: function(data) {
                    $(".show_student_attendence_report").html(data);
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