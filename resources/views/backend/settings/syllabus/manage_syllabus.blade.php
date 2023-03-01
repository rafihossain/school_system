@extends('backend.layouts.app')
@section('title', 'List Syllabus')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsyllabus-modal">
                <i class="mdi mdi-plus"></i>Add Syllabus
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
		<table class="table table-bordered dt-responsive table-responsive nowrap syllabuslist_datatable">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Section Name</th>
                    <th>Subject Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<!-- Standard modal content -->
<div id="addsyllabus-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addsyllabus-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addsyllabus-modalLabel">Create Syllabus</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addsyllabus_form">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label class="form-label">Syllabus Title</label>
                        <input type="text" class="form-control" name="syllabus_title">
                        <span class="text-danger syllabus_title_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Class Name</label>
                        <select name="class_id" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger class_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Section Name</label>
                        <select name="section_id" class="form-control">
                            <option value="">Select Section</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger section_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Subject Name</label>
                        <select name="subject_id" class="form-control">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger subject_name_error"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Upload Syllabus</label>
                        <input type="file" class="dropify" id="syllabusImage" name="syllabus_image[]" multiple>
                        <span class="text-danger syllabus_image_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_syllabus">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updatesyllabus-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatesyllabus-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatesyllabus-modalLabel">Update Syllabus</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatesyllabus_form">
                <input type="hidden" name="syllabus_id" id="syllabus_id">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label class="form-label">Syllabus Title</label>
                        <input type="text" class="form-control syllabus_title" name="syllabus_title">
                        <span class="text-danger syllabus_title_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Class Name</label>
                        <select name="class_id" class="form-control class_name">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger class_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Section Name</label>
                        <select name="section_id" class="form-control section_name">
                            <option value="">Select Section</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger section_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Subject Name</label>
                        <select name="subject_id" class="form-control subject_name">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger subject_name_error"></span>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Upload Syllabus</label>
                        <input type="file" class="dropify" name="syllabus_image[]" multiple>
                        <span class="text-danger subject_name_error"></span>

                        <div class="mt-2 images">
                            
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_syllabus">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        $('.dropify').dropify();

        var table = $('.syllabuslist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-syllabus') }}",
            },
            columns: [
                {
                    data: 'class.class_name',
                    name: 'class.class_name'
                },
                {
                    data: 'section.section_name',
                    name: 'section.section_name'
                },
                {
                    data: 'subject.subject_name',
                    name: 'subject.subject_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_syllabus').click(function() {
            var formdata = new FormData(document.getElementById('addsyllabus_form'));
            $.ajax({
                url: "{{route('backend.save-syllabus')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#addsyllabus-modal').modal('hide');
                    $('.syllabuslist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.syllabus_title_error').text(response.responseJSON.errors.syllabus_title);
                    $('.class_name_error').text(response.responseJSON.errors.class_id);
                    $('.section_name_error').text(response.responseJSON.errors.section_id);
                    $('.subject_name_error').text(response.responseJSON.errors.subject_id);
                    $('.syllabus_image_error').text(response.responseJSON.errors.syllabus_image);
                }
            })

        });

        $(document).delegate('.syllabus_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-syllabus')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#syllabus_id').val(data.syllabus.id);
                    $('.syllabus_title').val(data.syllabus.syllabus_title);
                    $('.class_name').val(data.syllabus.class_id);
                    $('.section_name').val(data.syllabus.section_id);
                    $('.subject_name').val(data.syllabus.subject_id);
                    $('.images').html(data.images);

                }
            })

        });

        $(document).delegate('.delete', 'click', function(e) {
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
                    $('.syllabuslist_datatable').DataTable().ajax.reload();
                }
            });
        });

        $('.update_syllabus').click(function() {
            var formdata = new FormData(document.getElementById('updatesyllabus_form'));
            $.ajax({
                url: "{{route('backend.update-syllabus')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#updatesyllabus-modal').modal('hide');
                    $('.syllabuslist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.syllabus_title_error').text(response.responseJSON.errors.syllabus_title);
                    $('.class_name_error').text(response.responseJSON.errors.class_id);
                    $('.section_name_error').text(response.responseJSON.errors.section_id);
                    $('.subject_name_error').text(response.responseJSON.errors.subject_id);
                    $('.syllabus_image_error').text(response.responseJSON.errors.syllabus_image);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.syllabus_delete', function(e) {
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
                            url: "{{route('backend.delete-syllabus')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.syllabuslist_datatable').DataTable().ajax.reload();
                                iziToast.success({
                                    message: 'Successfully deleted recorded!',
                                    position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                                })
                            }
                        })

                    }

                });
        });

    });
</script>
@endsection