@extends('backend.layouts.app')
@section('title', 'Exam Marks')
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
                    @foreach($sections as $section)
                    <option value="{{$section->id}}">{{$section->section_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 show_subject" style="display:none">
                <select name="subject_id" id="subject_id" class="form-control">
                    <option value="">Select Subject</option>
                </select>
            </div>

            <div class="col-md-2 show_button" style="display:none">
                <button type="button" class="btn btn-primary get_student_mark">Load Data</button>
            </div>

        </div>
    </div>
    <div class="card-body">
        <div class="show_student_mark"> </div>
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
            $(".show_subject").css('display', 'block');
        });
        $("#subject_id").on('change', function(e) {
            $(".show_button").css('display', 'block');
        });

        $('.get_student_mark').click(function(e) {
            var exam_id = $("#exam_id").val();
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();
            var subject_id = $("#subject_id").val();

            $.ajax({
                url: "{{route('backend.get_student_mark')}}",
                type: 'GET',
                data: {
                    'exam_id': exam_id,
                    'class_id': class_id,
                    'section_id': section_id,
                    'subject_id': subject_id
                },
                success: function(data) {
                    $(".show_student_mark").html(data);
                }
            })
        });
    });

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

    $(document).delegate('.save_student_mark', 'click', function() {
        var fromData = $("#save_student_mark").serialize();
        $.ajax({
            url: "{{route('backend.save_student_mark')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: fromData,
            success: function(data) {
                //$(".show_student_mark").html(data);
                if (data.success) {
                    iziToast.success({
                        message: 'Exam Mark update Successfully!',
                        position: 'topRight',
                    })
                }
            }
        })
    });
</script>
@endsection