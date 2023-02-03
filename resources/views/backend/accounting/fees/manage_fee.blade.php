@extends('backend.layouts.app')
@section('title', 'List Fee')

@section('css')
    <style>
        .custom-box{
            width: 265px;
            height: 125px;
            margin: 0 252px;
        }
        .btn-custome {
            color: #fff;
            background-color: #E04600;
            box-shadow: 0px 5px 3px 0px rgb(162 56 2);
            border-radius: 5px;
            padding: 4px 20px;
        }
        .preview_routine_calender a {
            color: #007bff;
        }
        .preview_routine_calender a div {
            color: #007bff !important;
        }
    </style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.add-fee') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create</a>
        </h4>
    </div>
</div>
 

    <div class="card ">
        <div class="card-header">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <select name="feetype_id" id="getClass" class="form-control">
                        <option value="">Select Fee Type</option>
                        @foreach($feetypes as $feetype)
                            <option value="{{ $feetype->id }}">{{ $feetype->feetype_name }}</option>
                        @endforeach
                    </select>
                    @error('feetype_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-2 show_class d-none">
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


                <div class="col-md-2 show_paid d-none">
                    <select name="fee_status" id="feeStatus" class="form-control">
                        <option value="1">Paid</option>
                        <option value="2">Unpaid</option>
                    </select>
                </div>
                <div class="col-md-3 show_route d-none">
                    <button type="button" class="btn btn-primary get_fees">Get Fees</button>
                </div> 
            </div>
        </div>
        <div class="card-body">
            <div class="show_fees_list"> </div>
        </div>
    </div>

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        $('#getClass').on("change",function(){
            $('.show_class').removeClass('d-none');
        });

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
            $('.show_paid').removeClass('d-none');
            $('.show_route').removeClass('d-none');
        });
        
        $(document).delegate('.mark_paid', 'click', function(e) {

            if(confirm('Are you sure you want to mark this fee as paid?')){
                var fee_id = $(this).data('id');
                $.ajax({
                    url: "{{ route('backend.set-fee-mark-paid') }}",
                    type: "POST",
                    data: {
                        'fee_id' : fee_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'html',
                    success: function(response) {
                        var mark_paid = $('.row_'+fee_id).remove();
                        console.log(mark_paid);
                    }
                });
            }
        });

        $(document).delegate('#delete', 'click', function(e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete?')){
                var deleteId = $(this).data('id');
                // console.log(deleteId);
                $.ajax({
                    url: "{{ route('backend.delete-fee') }}",
                    type: "POST",
                    data: {
                        'delete_id' : deleteId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'html',
                    success: function(response) {
                        console.log(deleteId);
                        $('.row_'+deleteId).remove();
                    }
                });
            }
        });

        //get-routine
        $('.get_fees').click(function(e) {
            // alert('hi');
            // $('.preview_routine_calender').addClass('d-none');

            var feetype_id = $('#getClass').val();
            var class_id = $('#getSection').val();
            var section_id = $('#getInfo').val();
            var fee_status = $('#feeStatus').val();
            $.ajax({
                url: "{{ route('backend.get-fees-list') }}",
                type: "POST",
                data: {
                    'class_id' : class_id,
                    'feetype_id' : feetype_id,
                    'section_id' : section_id,
                    'fee_status' : fee_status,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'html',
                success: function(response) {
                    $('.show_fees_list').html(response);
                }
            });
        });

    
    });


</script>
@endsection