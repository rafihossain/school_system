@extends('backend.layouts.app')
@section('title', 'Exam Routine')
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
    <div class="card-header">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <select name="session_id" id="session_id" class="form-control">
                    <option value="">Select Session</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
                @error('session_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2">
                <select name="exam_id" id="exam_id" class="form-control">
                    <option value="">Select Exam</option>
                    @foreach($exam_lists as $exam_list)
                    <option value="{{ $exam_list->id }}">{{ $exam_list->name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 show_class" style="display:none">
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

                <button type="button" class="btn btn-primary get_report_exam_routine">Get Exam Routine</button>

            </div>

        </div>
    </div>
    <div class="card-body">
        <div class="show_get_report_exam_routine"></div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#exam_id").on('change', function(e) {
            $(".show_class").css('display', 'block');
        });
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

        $('.get_report_exam_routine').click(function(e) {
            var exam_id = $("#exam_id").val();
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();
            var session_id=$("#session_id").val();
            $.ajax({
                url: "{{route('backend.get_report_exam_routine')}}",
                type: 'GET',
                data: {
                    'exam_id': exam_id,
                    'class_id': class_id,
                    'section_id': section_id,
                    'session_id':session_id
                },
                success: function(data) {

                    $(".show_get_report_exam_routine").html(data);
                }
            })
        });
    });
</script>
@endsection