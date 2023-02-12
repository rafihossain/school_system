@extends('backend.layouts.app')
@section('title', 'Add Fee')

@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
           <a href="{{ route('backend.manage-fee') }}" class="btn btn-primary">List Fee</a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="formRoutineClass" action="{{route('backend.save-fee')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 m-auto">
                <div class="mb-2">
                    <label class="form-label">Invoice Type</label>
                    <select name="invoice_type" class="form-control invoice_type">
                        <option value="1">Bulk</option>
                        <option value="2">Individual</option>
                    </select>
                    @error('invoice_type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Fee Type</label>
                    <select name="feetype_id" class="form-control">
                        <option value="">Select Type</option>
                        @foreach($feetypes as $feetype)
                        <option value="{{ $feetype->id }}">{{ $feetype->feetype_name }}</option>
                        @endforeach
                    </select>
                    @error('feetype_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Class</label>
                            <select name="class_id" id="class_id" class="form-control">
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Section</label>
                            <select name="section_id" id="section_id" class="form-control">
                                <option value="">Select Section</option>
                            </select>
                            @error('section_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-2 show_subject d-none">
                    <label class="form-label">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control">
                        <option value="">Select Subject</option>
                    </select>
                    @error('section_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Amount Due</label>
                            <input type="number" class="form-control" name="amount_due">

                            @error('amount_due')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Due Date</label>
                            <input type="date" class="form-control" name="due_date">

                            @error('due_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label class="form-label">Status</label>
                    </div>
                    <div class="mb-2">
                        <label class="form-check form-check-inline">
                            <input type="radio" name="fee_status" class="form-check-input" value="1">
                            <span class="form-check-label">Paid</span>
                        </label>
                        <label class="form-check form-check-inline">
                            <input type="radio" name="fee_status" class="form-check-input" value="2">
                            <span class="form-check-label">Unpaid</span>
                        </label>
                    </div>
                    @error('fee_status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Description</label>
                    <textarea name="fee_description" id="" class="form-control"></textarea>
                    @error('fee_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary" type="submit" id="submitClass"> Submit </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
    $(function() {

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

        // $('#getSection').on("change", function() {
        //     $.ajax({
        //         url: "{{ route('backend.get-section-info') }}",
        //         type: "POST",
        //         data: {
        //             'section_id': $(this).val(),
        //             '_token': '{{ csrf_token() }}',
        //         },
        //         dataType: 'json',
        //         success: function(response) {

        //             var sections = '';
        //             sections = '<option value="" >Select Section</option>';
        //             for (var i = 0; i < response.length; i++) {
        //                 sections += '<option value="' + response[i].id + '" >' + response[i].section_name + '</option>';
        //             }
        //             $('#getSubject').html(sections);

        //         }
        //     });
        // });

        // $(document).delegate('#getSubject', 'change', function(e) {
        //     $.ajax({
        //         url: "{{ route('backend.get-subject-info') }}",
        //         type: "POST",
        //         data: {
        //             'subject_id': $(this).val(),
        //             '_token': '{{ csrf_token() }}',
        //         },
        //         dataType: 'json',
        //         success: function(response) {

        //             var subject = '';
        //             subjects = '<option value="" >Select Subject</option>';
        //             for (var i = 0; i < response.length; i++) {
        //                 subjects += '<option value="' + response[i].id + '" >' + response[i].subject_name + '</option>';
        //             }
        //             $('#subjectInfo').html(subjects);

        //         }
        //     });
        // });

        $('.invoice_type').on("change", function() {

            if($(this).val() == 1){
                $('.show_subject').addClass('d-none');
            }else{
                $('.show_subject').removeClass('d-none');
            }

        });
        

    });
</script>

@endsection