@extends('backend.layouts.app')
@section('title', 'Exam Schedule List')
@section('content')

 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" href="{{route('backend.schedule.create')}}">+ Create</a>
        </h4>
    </div>
</div>
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
            <div class="col-md-3">
                <select name="class_id" id="getExam" class="form-control">
                    <option value="">Select Exam</option>
                    @foreach($exam_lists as $exam_list)
                    <option value="{{ $exam_list->id }}">{{ $exam_list->name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3 show_section" style="display: none;">

                <button type="button" class="btn btn-primary get_exam_schedule">Get Exam</button>

            </div> 
        </div>
    </div>
    <div class="card-body">
        <div class="show_class_examSchedule"> </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#getExam").on('change', function(e) {
            $(".show_section").css('display', 'block');
        });

        $('.get_exam_schedule').click(function(e) {
            var exam_id = $("#getExam").val();
            $.ajax({
                url: "{{route('backend.get_exam')}}",
                type: 'GET',
                data: {
                    'exam_id': exam_id
                },
                success: function(data) {
                    $(".show_class_examSchedule").html(data);
                    // $("#subject_id").html(data['subjects']);
                }
            })
        });
    });
</script>
@endsection