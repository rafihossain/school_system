@extends('backend.layouts.app')
@section('title', 'List Subject')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsubject-modal">
                <i class="mdi mdi-plus"></i>Add Subject
            </a>
        </h4>
    </div>
</div>


<div class="card">
    <div class="card-body">
        
		<table class="table table-bordered dt-responsive table-responsive nowrap subjectlist_datatable">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
 
            </tbody>
        </table>

    </div>
</div>

<!-- Standard modal content -->
<div id="addsubject-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addsubject-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addsubject-modalLabel">Create Subject</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addsubject_form">
                <div class="modal-body">

                    <div class="mb-2">
                        <label>Class Name</label>
                        <select name="class_id" class="form-control class_name">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger class_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Subject Name</label>
                        <input type="text" class="form-control" name="subject_name">
                        <span class="text-danger subject_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Subject Code</label>
                        <input type="text" class="form-control" name="subject_code">
                        <span class="text-danger subject_code_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_subject">Save</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updatesubject-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatesubject-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatesubject-modalLabel">Update Subject</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatesubject_form">
                <input type="hidden" name="subject_id" id="subject_id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Class Name</label>
                        <select name="class_id" class="form-control class_name">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger class_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Subject Name</label>
                        <input type="text" class="form-control subject_name" name="subject_name">
                        <span class="text-danger subject_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Subject Code</label>
                        <input type="text" class="form-control subject_code" name="subject_code">
                        <span class="text-danger subject_code_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_subject">Save</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        $('.subjectlist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-subject') }}",
            },
            columns: [{
                    data: 'class.class_name',
                    name: 'class.class_name'
                },
                {
                    data: 'subject_name',
                    name: 'subject_name'
                },
                {
                    data: 'subject_code',
                    name: 'subject_code'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_subject').click(function() {

            var serialize = $("#addsubject_form").serializeArray();
            $.ajax({
                url: "{{route('backend.save-subject')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#addsubject-modal').modal('hide');
                    $('.subjectlist_datatable').DataTable().ajax.reload();
                },
                error: function(response) {
                    $('.class_name_error').text(response.responseJSON.errors.class_id);
                    $('.subject_name_error').text(response.responseJSON.errors.subject_name);
                    $('.subject_code_error').text(response.responseJSON.errors.subject_code);
                }
            })

        });

        $(document).delegate('.subject_edit', 'click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-subject')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#subject_id').val(data.id);
                    $('.class_name').val(data.class_id);
                    $('.subject_name').val(data.subject_name);
                    $('.subject_code').val(data.subject_code);
                }
            })
        });

        $('.update_subject').click(function() {

            var serialize = $("#updatesubject_form").serializeArray();
            $.ajax({
                url: "{{route('backend.update-subject')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#updatesubject-modal').modal('hide');
                    $('.subjectlist_datatable').DataTable().ajax.reload();
                },
                error: function(response) {
                    $('.class_name_error').text(response.responseJSON.errors.class_id);
                    $('.subject_name_error').text(response.responseJSON.errors.subject_name);
                    $('.subject_code_error').text(response.responseJSON.errors.subject_code);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.subject_delete', function(e) {
            e.preventDefault();

            swal({
                    title: "Are you sure?",
                    text: "You want to delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var id = $(this).data('id');
                        $.ajax({
                            url: "{{route('backend.delete-subject')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.subjectlist_datatable').DataTable().ajax.reload();
                            }
                        })

                    }

                });
        });

        $('.dropify').dropify();
        $("#datetime-datepicker").flatpickr({
            enableTime: !0,
            dateFormat: "Y-m-d H:i"
        });
    });
</script>
@endsection