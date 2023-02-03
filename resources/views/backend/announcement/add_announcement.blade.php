@extends('backend.layouts.app')
@section('title', 'Message Notification')

@section('content')

 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
           <a href="{{ route('backend.manage-feetype') }}" class="btn btn-primary">List Feetype</a>
        </h4>
    </div>
</div>
<div class="card"> 
    <div class="card-body">
        <form id="formNotification" action="{{route('backend.save-notification')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-2">
                <label class="form-label">Recipient</label>
                <select name="class_id" class="form-control">
                    <option value="">Select User</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>

                @error('class_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title">
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control"></textarea>

                @error('message')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label  for="now"> &nbsp;NOW&nbsp;&nbsp;</label>
                    <input type="checkbox" id="now" class="seheduletype" name="now">
                </div>

                <div class="col-md-6">
                    <div class="checkbox mb-3">
                        <label for="futureDate">&nbsp;Future Date : </label>
                        <input type="checkbox" class="fCheck">
                        <input type="date" id="futureDate" class="seheduletype form-control ftext"
                        name="future_date">
                    </div>
                </div>

            </div>

            <div class="mt-4">
                <button class="btn btn-primary" type="submit"> Submit </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">
        $('.dropify').dropify();

        //Jquery Date Picker
        // $('#futureDate').datepicker({
        //     minDate: 0,
        //     dateFormat: "yy-mm-dd"
        // });

        //Hide Show Future Date Checkbox
        
        /*====test 1===*/

        $('.ftext').hide();
        
        $('.fCheck').on('click', function(){
            
            if($(this).is(":checked")){
                $(".ftext").show();
            }else{
                $(".ftext").hide();
            }

        });


        // $('#submitFeetype').click(function(e){
        //     e.preventDefault();

        //     var $fileUpload = $("#syllabusImage");
        //     if (parseInt($fileUpload.get(0).files.length)>10){
        //         alert("You can only upload a maximum of 10 ammendment files");
        //         return false;
        //     }else{
        //         $('#formSyllabus').submit();
        //     }
        // });

    </script>
    
@endsection
