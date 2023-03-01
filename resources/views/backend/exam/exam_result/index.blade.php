@extends('backend.layouts.app')
@section('title', 'Exam Result')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row justify-content-center">
            <div class="col-md-3">
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
            <div class="col-md-3 show_class" style="display:none">
                <select name="class_id" id="class_id" class="form-control">
                    <option value="">Select Class</option>
                    @foreach($classes as $classe)
                    <option value="{{$classe->id}}">{{$classe->class_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 show_section" style="display:none">
                <select name="section_id" id="section_id" class="form-control">
                    <option value="">Select Section</option>
                </select>
            </div>

            <div class="col show_button" style="display:none">
                <button type="button" class="btn btn-primary get_exam_result">Get Exam Result</button>
            </div> 
        </div>
    </div>
    <div class="card-body">
        <div class="show_student_mark"> </div>
    </div>
</div>

<!-- Add ClassRoom -->
<div id="resultDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">View Result</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body response_result_data"></div>
        </div>
    </div>
</div>
<!--End ClassRoom -->



<script>
    $(document).ready(function() {

        $(document).delegate('.view-details', 'click', function() {
            var student_id = $(this).data('studentid');
            // console.log(student_id);

            $.ajax({
                url: "{{route('backend.view-result-details')}}",
                data: {
                    'class_id': $('#class_id').val(),
                    'student_id': student_id,
                },
                success: function(data) {
                    $('.response_result_data').html(data);
                    $('#resultDetailsModal').modal('show');
                }
            })

            // var html = '<table class="table"><thead><th>Subject Name</th></thead><tbody><td></td></tbody></table>';
        })

        $("#exam_id").on('change', function(e) {
            $(".show_class").css('display','block');
        });
        $("#class_id").on('change', function(e) {
            $(".show_section").css('display','block');
        });
        $("#section_id").on('change', function(e) {
            $(".show_button").css('display','block');
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
                    //console.log(data);
                    $("#section_id").html(data);
                }
            })
        }); 

        $('.get_exam_result').click(function(e){

            var exam_id = $("#exam_id").val();
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();

            $.ajax({
                url: "{{route('backend.get_student_exam_result')}}",
                type: 'GET',
                data: {
                    'exam_id': exam_id,
                    'class_id': class_id,
                    'section_id': section_id,
                },
                success: function(data) {
                    //console.log(data);
                    $(".show_student_mark").html(data);
                }
            })  
        });

    });
    

</script>
@endsection