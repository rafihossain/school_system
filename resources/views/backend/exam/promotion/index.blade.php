@extends('backend.layouts.app')
@section('title', 'Student Promotion')
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
                <div class="col-md-2 show_session_to" style="display:none">
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
                <div class="col-md-2 show_class_from" style="display:none">
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
                <div class="col-md-2 show_class_to" style="display:none">
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
                <div class="col-md-2 show_button" style="display:none">
                    <button type="button" class="btn btn-primary get_student_list">Get Student List</button>
                </div>
            </div>
        </div>
        <div class="card-body"></div>
    </div>
</form>

<div class="show_student"></div>



<script>
    $(document).ready(function() {
        $("#session_from").on('change', function(e) {
            $(".show_session_to").css('display', 'block');
        });
        $(".show_session_to").on('change', function(e) {
            $(".show_class_from").css('display', 'block');
        });
        $(".show_class_from").on('change', function(e) {
            $(".show_class_to").css('display', 'block');
        });
        $(".show_class_to").on('change', function(e) {
            $(".show_button").css('display', 'block');
        });


        // $('#class_id').on('change', function(e) {
        //     var class_id = $(this).val();
        //     $.ajax({
        //         url: "{{route('backend.get_section')}}",
        //         type: 'GET',
        //         data: {
        //             'class_id': class_id
        //         },
        //         success: function(data) {
        //             //console.log(data);
        //             $("#section_id").html(data);
        //         }
        //     })
        // });

        $('.get_student_list').click(function(e) {
            var serialize = $('#promotionFrom').serialize()+"&_token="+ "{{ csrf_token() }}";
            $.ajax({
                url: "{{route('backend.student-list')}}",
                type: 'post',
                data: serialize,
                success: function(data) {
                    $(".show_student").html(data);
                }
            })
        });

    });
</script>
@endsection