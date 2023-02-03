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
            <a href="{{ route('backend.manage-subject-class') }}" class="btn btn-primary"><i class="mdi mdi-plus"></i>List Subject Class</a>
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
            <div class="col-md-2">
               <select name="section_id" id="getSubject" class="form-control"></select>
            </div>

           <div class="col-md-4 show_route d-none">
                <button type="button" class="btn btn-primary get_routine">Get Routine</button>
                <button type="button" class="btn btn-primary preview_routine">Preview Routine</button>
            </div>
            
        </div>
    </div>
    <div class="card-body">
        <form id="subjectListFrom">

            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                <thead>
                <tr>
                    <th>SL No</th>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Total Mark</th>
                    <th>Theory Mark</th>
                    <th>Practical Mark</th>
                    <th>City Exam Mark</th>
                    <th>Diary</th>
                </tr>
                </thead>
                <tbody id="subject_table">
                    
                </tbody>
            </table>
            <div class="mb-2">
                <button type="button" class="btn btn-primary" id="subjectListBtn">Submit</button>
            </div>
        </form>

    </div>
</div>
 
 

@endsection

@section('script')

    <script type="text/javascript">

        $(function(){
            $('#getSection').on("change",function(){
                $.ajax({
                    url: "{{ route('backend.get-section-info') }}",
                    type: "POST",
                    data: {
                        'section_id' : $(this).val(),
                        '_token': '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(response) {

                        var sections = '';
                        sections = '<option value="" >Select Section</option>';
                        for(var i = 0; i < response.length; i++){
                            sections += '<option value="'+response[i].id+'" >'+response[i].section_name+'</option>';
                        }
                        $('#getSubject').html(sections);

                    }
                });
            });
            
            $(document).delegate('#getSubject', 'change', function(e) {
                $.ajax({
                    url: "{{ route('backend.get-subject-info') }}",
                    type: "POST",
                    data: {
                        'subject_id' : $(this).val(),
                        '_token': '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(data) {

                        var html = '';
                        for (i = 0; i < data.length; i++) {
                            

                        html +=
                            '<input type="hidden" name="section_id[]" value="'+data[i].section_id+'">'+
                            '<tr>' +
                                '<td><input type="checkbox"></td>' +
                                '<td><input type="text" name="subject_name[]" value="'+data[i].subject_name+'" class="input_control"></td>' +
                                '<td><input type="text" name="subject_code[]" value="'+data[i].subject_code+'" class="input_control"></td>' +
                                '<td><input type="text" name="total_mark[]" value="'+data[i].subject_code+'" class="input_control"></td>' +
                                '<td><input type="text" name="theory_mark[]" value="'+data[i].subject_code+'" class="input_control"></td>' +
                                '<td><input type="text" name="practical_mark[]" value="'+data[i].subject_code+'" class="input_control"></td>' +
                                '<td><input type="text" name="city_exam_mark[]" value="'+data[i].subject_code+'" class="input_control"></td>' +
                                '<td><input type="text" name="diary[]" value="'+data[i].subject_code+'" class="input_control"></td>' +
                            '</tr>';
                        }

                        $('#subject_table').html(html);

                    }
                });
            });

            $('#subjectListBtn').on("click",function(){
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
