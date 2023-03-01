@extends('backend.layouts.app')
@section('title', 'List Section')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsection-modal">
                <i class="mdi mdi-plus"></i>Add Section
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        
		<table class="table table-bordered dt-responsive table-responsive nowrap sectionlist_datatable">
            <thead>
            <tr>
                <th>Section Name</th>
                <th>Section Capacity</th>
                <th>Class Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                {{-- @foreach($sections as $section)
                <tr>
                    <td>{{$section->section_name}}</td>
                    <td>{{$section->section_capacity}}</td>
                    <td>{{$section->class->class_name}}</td>
                    <td>
                        <a href="{{ route('backend.edit-section', ['id'=>$section->id]) }}" class="btn btn-sm btn-success">
                            <i class="mdi mdi-file-edit-outline"></i>
                        </a>
                        <a href="{{ route('backend.delete-section', ['id'=>$section->id]) }}" id="delete" class="btn btn-sm btn-danger">
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
<div id="addsection-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addsection-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addsection-modalLabel">Create Class</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addsection_form">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label>Class Name</label>
                        <select name="class_id" class="form-control class_name">
                            <option value="">Select Name</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger class_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Section Name</label>
                        <input type="text" class="form-control section_name" name="section_name">
                        <span class="text-danger section_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Section Capacity</label>
                        <input type="number" class="form-control section_capacity" name="section_capacity">
                        <span class="text-danger section_capacity_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_section">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updatesection-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatesection-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatesection-modalLabel">Update Section</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatesection_form">
                <input type="hidden" name="id" id="section_id">
                <div class="modal-body">

                    <div class="mb-2">
                        <label>Class Name</label>
                        <select name="class_id" class="form-control class_name">
                            <option value="">Select Name</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger class_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Section Name</label>
                        <input type="text" class="form-control section_name" name="section_name">
                        <span class="text-danger section_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Section Capacity</label>
                        <input type="number" class="form-control section_capacity" name="section_capacity">
                        <span class="text-danger section_capacity_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_section">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        var table = $('.sectionlist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-section') }}",
            },
            columns: [
                {
                    data: 'section_name',
                    name: 'section_name'
                },
                {
                    data: 'section_capacity',
                    name: 'section_capacity'
                },
                {
                    data: 'class.class_name',
                    name: 'class.class_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_section').click(function() {

            var serialize = $("#addsection_form").serializeArray();
            $.ajax({
                url: "{{route('backend.save-section')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#addsection-modal').modal('hide');
                    $('.sectionlist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.class_name_error').text(response.responseJSON.errors.class_id);
                    $('.section_name_error').text(response.responseJSON.errors.section_name);
                    $('.section_capacity_error').text(response.responseJSON.errors.section_capacity);
                }
            })

        });

        $(document).delegate('.section_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-section')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#section_id').val(data.id);
                    $('.class_name').val(data.class_id);
                    $('.section_name').val(data.section_name);
                    $('.section_capacity').val(data.section_capacity);
                }
            })
        });

        $('.update_section').click(function() {

            var serialize = $("#updatesection_form").serializeArray();
            $.ajax({
                url: "{{route('backend.update-section')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#updatesection-modal').modal('hide');
                    $('.sectionlist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.class_name_error').text(response.responseJSON.errors.class_id);
                    $('.section_name_error').text(response.responseJSON.errors.section_name);
                    $('.section_capacity_error').text(response.responseJSON.errors.section_capacity);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.section_delete', function(e) {
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
                            url: "{{route('backend.delete-section')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.sectionlist_datatable').DataTable().ajax.reload();
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