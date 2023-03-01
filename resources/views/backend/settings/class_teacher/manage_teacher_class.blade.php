@extends('backend.layouts.app')
@section('title', 'List Class Teacher')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addclassteacher-modal">
                <i class="mdi mdi-plus"></i>Add Class Teacher
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
		<table class="table table-bordered dt-responsive table-responsive nowrap classteacherlist_datatable">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Section Name</th>
                    <th>Teacher Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($classteachers as $classteacher)
                <tr>
                    <td>{{$classteacher->class->class_name}}</td>
                    <td>{{$classteacher->section->section_name}}</td>
                    <td>{{$classteacher->teacher->name}}</td>
                    <td>
                        <a href="{{ route('backend.edit-class-teacher', ['id'=>$classteacher->id]) }}" class="btn btn-sm btn-success">
                            <i class="mdi mdi-file-edit-outline"></i>
                        </a>
                        <a href="{{ route('backend.delete-class-teacher', ['id'=>$classteacher->id]) }}" id="delete" class="btn btn-sm btn-danger">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </a>
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>

<!-- Standard modal content -->
<div id="addclassteacher-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addclassteacher-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addclassteacher-modalLabel">Create Classteacher</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addclassteacher_form">
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Class Name</label>
                        <select name="class_id" class="form-control class_name">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger classname_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Section Name</label>
                        <select name="section_id" class="form-control section_name">
                            <option value="">Select Section</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger sectionname_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Teacher Name</label>
                        <select name="teacher_id" class="form-control teacher_name">
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger teachername_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_classteacher">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updateclassteacher-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateclassteacher-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateclassteacher-modalLabel">Update Classteacher</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateclassteacher_form">
                <input type="hidden" name="classteacher_id" id="classteacher_id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Class Name</label>
                        <select name="class_id" class="form-control class_name">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger classname_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Section Name</label>
                        <select name="section_id" class="form-control section_name">
                            <option value="">Select Section</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger sectionname_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Teacher Name</label>
                        <select name="teacher_id" class="form-control teacher_name">
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger teachername_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_classteacher">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('.classteacherlist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-class-teacher') }}",
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
                    data: 'teacher.name',
                    name: 'teacher.name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_classteacher').click(function() {

            var serialize = $("#addclassteacher_form").serializeArray();
            $.ajax({
                url: "{{route('backend.save-class-teacher')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#addclassteacher-modal').modal('hide');
                    $('.classteacherlist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.classname_error').text(response.responseJSON.errors.class_id);
                    $('.sectionname_error').text(response.responseJSON.errors.section_id);
                    $('.teachername_error').text(response.responseJSON.errors.teacher_id);
                }
            })

        });

        $(document).delegate('.classteacher_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('backend.edit-class-teacher') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#classteacher_id').val(data.id);
                    $('.class_name').val(data.class_id);
                    $('.section_name').val(data.section_id);
                    $('.teacher_name').val(data.teacher_id);
                }
            })
        });

        $('.update_classteacher').click(function() {

            var serialize = $("#updateclassteacher_form").serializeArray();
            $.ajax({
                url: "{{route('backend.update-class-teacher')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#updateclassteacher-modal').modal('hide');
                    $('.classteacherlist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.classname_error').text(response.responseJSON.errors.class_id);
                    $('.sectionname_error').text(response.responseJSON.errors.section_id);
                    $('.teachername_error').text(response.responseJSON.errors.teacher_id);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.classteacher_delete', function(e) {
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
                            url: "{{route('backend.delete-class-teacher')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.classteacherlist_datatable').DataTable().ajax.reload();
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