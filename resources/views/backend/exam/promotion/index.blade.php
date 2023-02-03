@extends('backend.layouts.app')
@section('title', 'Exam Marks')
@section('content')

<form id="promotionFrom">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <select name="session_from" id="session_from" class="form-control">
                        <option value="">Select Session Form</option>
                        @foreach($sessions as $session)
                        <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                        @endforeach
                    </select>
                    @error('session_from')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-2 show_session_to" style="display:nones">
                    <select name="session_to" id="session_to" class="form-control">
                        <option value="">Select Session To</option>
                        @foreach($sessions as $session)
                        <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                        @endforeach
                    </select>
                    @error('session_to')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-2 show_class_from" style="display:nones">
                    <select name="class_from" id="class_from" class="form-control">
                        <option value="">Select Class</option>
                        @foreach($classes as $classe)
                        <option value="{{ $classe->id }}">{{ $classe->class_name }}</option>
                        @endforeach
                    </select>
                    @error('class_from')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-2 show_class_to" style="display:nones">
                    <select name="class_to" id="class_to" class="form-control">
                        <option value="">Select Class</option>
                        @foreach($classes as $classe)
                        <option value="{{ $classe->id }}">{{ $classe->class_name }}</option>
                        @endforeach
                    </select>
                    @error('class_to')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-2 show_button" style="display:nones">
                    <button type="button" class="btn btn-primary get_exam_result">Get Student List</button>
                </div>
            </div>
        </div>
        <div class="card-body"></div>
    </div>
</form>



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
                    //console.log(data);
                    $("#section_id").html(data);
                }
            })
        });

        $('.get_exam_result').click(function(e) {
            var serialize = $('#promotionFrom').serialize()+"&_token="+ "{{ csrf_token() }}";
            $.ajax({
                url: "{{route('backend.show-promotion-student-list')}}",
                type: 'post',
                data: serialize,
                success: function(data) {
                    $(".show_promotion").html(data);
                }
            })
        });

    });
</script>
@endsection