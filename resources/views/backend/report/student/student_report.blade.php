@extends('backend.layouts.app')
@section('title', 'Student Report')


@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
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
                <div class="col-md-2 show_section d-none">
                    <select name="section_id" id="getInfo" class="form-control"></select>
                </div>
                <div class="col-md-4 show_student d-none">
                    <button type="button" class="btn btn-primary get_student_report">Get Student List</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="show_student_report"></div>
        </div>
   </div> 

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {


        $('#getSection').on("change",function(){
            
            $('.show_section').removeClass('d-none');

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
                    $('#getInfo').html(sections);

                }
            });
        });

        $(document).delegate('#getInfo', 'change', function(e) {
            $('.show_student').removeClass('d-none');
        });

   
    });

    //routin-preview
    $('.get_student_report').click(function(e) {

        var class_id = $('#getSection').val();
        var section_id = $('#getInfo').val();
        $.ajax({
            url: "{{ route('backend.get_student_report') }}",
            type: "get",
            data: {
                'class_id' : class_id,
                'section_id' : section_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                $('.show_student_report').html(data);

            }
        });
    
    });

</script>
@endsection