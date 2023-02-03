@extends('backend.layouts.app')
@section('title', 'Add Session')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" href="{{ route('backend.manage-session') }}"> Session List</a>
        </h4>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form id="formSession" action="{{route('backend.save-session')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label class="form-label">Session Name</label>
                <input type="text" class="form-control session_name" name="session_name" value="{{old('session_name')}}">
                <div class="session_name_error"></div>
                @error('session_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control start_date" name="start_date" value="{{old('start_date')}}">
                <div class="start_date_error"></div>
                @error('start_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control end_date" name="end_date" value="{{old('end_date')}}">
                <div class="end_date_error"></div>
                @error('end_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="date_error"></div>

            <div class="mt-4">
                <button class="btn btn-primary" type="submit" id="submitSession"> Add Session </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">

        $(function(){
            $('#submitSession').click(function(e){
                e.preventDefault();

                var start_date = $('.start_date').val();
                var end_date = $('.end_date').val();

                if($('.session_name').val() == ''){
                    $('.session_name_error').html('<small class="text-danger">Sponsored Person Name Is Required</small>');
                }
                // else{
                //     // console.log('hi');
                //     if($('.session_name').val().length > 3 ){
                //         $('.session_name_error').html('<small class="text-danger">Session length should be less than three charecter!</small>');
                //     }else{
                //         $('.session_name_error').html('');
                //     }
                // }

                if($('.start_date').val() == ''){
                    $('.start_date_error').html('<small class="text-danger">Start Date Is Required</small>');
                }
                if($('.end_date').val() == ''){
                    $('.end_date_error').html('<small class="text-danger">End Date Is Required</small>');
                }

                if($('.start_date').val() != '' && $('.end_date').val() != ''){
                    var checkdate = isFutureDate(start_date, end_date);
                    if(checkdate == false){
                    // console.log('hello');
                        $('.date_error').html('<small class="text-danger">End Date must be greater than Start Date</small>');
                    }else{
                        $("#formSession").submit();
                    }
                }


            });

        });

        function isFutureDate(start, end){
            var start_date = new Date(start).getTime();
            var end_date = new Date(end).getTime();
            // console.log(start_date + " " + end_date);

            return (start_date < end_date) ? true : false;
        }
    </script>
    
@endsection
