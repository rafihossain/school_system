@extends('backend.layouts.app')
@section('title', 'Edit Fee')

@section('content')

<div class="text-end mb-3">
    <a href="{{ route('backend.manage-fee') }}" class="btn btn-primary">List Fee</a>
</div>

<div class="card">
    <div class="card-body">
        <form id="formRoutineClass" action="{{route('backend.update-fee')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $fee->id }}">

            <div class="col-md-6 m-auto">
                <div class="mb-2">
                    <label>Fee Type</label>
                    <select name="feetype_id" class="form-control">
                        <option value="">Select Type</option>
                        @foreach($feetypes as $feetype)
                        <option value="{{ $feetype->id }}"
                            {{ $feetype->id == $fee->feetype_id ? 'selected' : '' }}
                        >{{ $feetype->feetype_name }}</option>
                        @endforeach
                    </select>
                    @error('feetype_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Class</label>
                            <select name="class_id" id="getSection" class="form-control">
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ $class->id == $fee->class_id ? 'selected' : '' }}
                                >{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Section</label>
                            <select name="section_id" id="getSubject" class="form-control">
                                <option value="">Select Section</option>
                            </select>
                            @error('section_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Amount Due</label>
                            <input type="number" class="form-control" name="amount_due" value="{{ $fee->amount_due }}">

                            @error('amount_due')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Due Date</label>
                            <input type="date" class="form-control" name="due_date" value="{{ $fee->due_date }}">

                            @error('due_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="fee_description" id="" class="form-control">{{ $fee->fee_description }}</textarea>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" id="submitClass"> Update </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">
        $('.dropify').dropify();

        $('#getSection').on("change", function() {
            $.ajax({
                url: "{{ route('backend.get-section-info') }}",
                type: "POST",
                data: {
                    'section_id': $(this).val(),
                    '_token': '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response) {

                    var sections = '';
                    sections = '<option value="" >Select Section</option>';
                    for (var i = 0; i < response.length; i++) {
                        sections += '<option value="' + response[i].id + '" >' + response[i].section_name + '</option>';
                    }
                    $('#getSubject').html(sections);

                }
            });
        });

        $('.delete').click(function(e) {
            e.preventDefault();
            var deleteKey = $(this).data('delete');
            var deleteId = $(this).data('syllabus');
            jQuery.ajax({
                type: 'post',
                url: "{{route('backend.delete-syllabus-image')}}",
                data: {
                    delete_id: deleteId,
                    _token : "{{csrf_token()}}"
                },
                success: function(data) {
                    $('#syllabus_' + deleteKey).remove();
                    location.reload();
                }
            });
        });

    </script>
    
@endsection