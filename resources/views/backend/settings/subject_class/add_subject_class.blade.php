@extends('backend.layouts.app')
@section('title', 'Add Subject Class')

@section('css')
    <style>
        .input_control{
            width:100%;
            color: #6c757d;
            border: 1px solid #ced4da;
            border-radius: 0.2rem;
            padding: 0.45rem 0.9rem;
        }
    </style>
@endsection

@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            
        </h4>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <select name="class_id" id="getSection" class="form-control">
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- <div class="col-md-2">
               <select name="section_id" id="getSubject" class="form-control section"></select>
            </div> -->

           <div class="col-md-4 show_route d-none">
                <button type="button" class="btn btn-primary find_subject">Find</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="subjectListFrom">

            <div class="response_subject_table"></div>

        </form>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">

        $(function(){
            $('#getSection').on("change",function(){
                $('.show_route').removeClass('d-none');
            });
            
            $('.find_subject').click(function(e) {
            
                $.ajax({
                    url: "{{ route('backend.get-subject-info') }}",
                    type: "POST",
                    data: {
                        'class_id' : $('#getSection').val(),
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('.response_subject_table').html(data);
                    }
                });
            });

            $(document).delegate('#subjectListBtn', 'click', function(){

                var serialize = $('#subjectListFrom').serialize();

                $.ajax({
                    url: "{{ route('backend.subject-list') }}",
                    type: "POST",
                    data: serialize,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(response) {

                        // var sections = '';
                        // sections = '<option value="" >Select Section</option>';
                        // for(var i = 0; i < response.length; i++){
                        //     sections += '<option value="'+response[i].id+'" >'+response[i].section_name+'</option>';
                        // }
                        // $('#getSubject').html(sections);

                    }
                });
            });
            
        });

    </script>
    
@endsection
