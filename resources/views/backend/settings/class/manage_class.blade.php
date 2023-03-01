@extends('backend.layouts.app')
@section('title', 'List Class')
@section('content') 

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.class-archive-list') }}" class="btn btn-warning "></i>Archive List</a>
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addclass-modal">
                <i class="mdi mdi-plus"></i>Add Class
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        
		<table class="table table-bordered dt-responsive table-responsive nowrap classlist_datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Session Name</th>
                    <th>Class Numeric</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<!-- Standard modal content -->
<div id="addclass-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addclass-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addclass-modalLabel">Create Class</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addclass_form">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label>Class Name</label>
                        <input type="text" class="form-control class_name" name="class_name">
                        <span class="text-danger class_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Class Numeric</label>
                        <input type="number" class="form-control class_numeric" name="class_numeric">
                        <span class="text-danger class_numeric_error"></span>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="class_status" value="0">
                        <input type="checkbox" class="form-check-input" id="customSwitch1" name="class_status" value="1">
                        <label class="form-check-label" for="customSwitch1">Active</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_class">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updateclass-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateclass-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateclass-modalLabel">Update Class</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateclass_form">
                <input type="hidden" name="class_id" id="class_id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Class Name</label>
                        <input type="text" class="form-control class_name" name="class_name">
                        <span class="text-danger class_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Class Numeric</label>
                        <input type="number" class="form-control class_numeric" name="class_numeric">
                        <span class="text-danger class_numeric_error"></span>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="class_status" value="0">
                        <input type="checkbox" class="form-check-input" id="customSwitch1" name="class_status" value="1">
                        <label class="form-check-label" for="customSwitch1">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_class">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        var table = $('.classlist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-class') }}",
            },
            columns: [
                {
                    data: 'class_name',
                    name: 'class_name'
                },
                {
                    data: 'session.session_name',
                    name: 'session.session_name'
                },
                {
                    data: 'class_numeric',
                    name: 'class_numeric'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_class').click(function() {

            var serialize = $("#addclass_form").serializeArray();
            $.ajax({
                url: "{{route('backend.save-class')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#addclass-modal').modal('hide');
                    $('.classlist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.class_name_error').text(response.responseJSON.errors.class_name);
                    $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
                }
            })

        });

        $(document).delegate('.class_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-class')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);

                    $('#class_id').val(data.id);
                    $('.class_name').val(data.class_name);
                    $('.class_numeric').val(data.class_numeric);
                }
            })
        });

        $('.update_class').click(function() {

            var serialize = $("#updateclass_form").serializeArray();
            $.ajax({
                url: "{{route('backend.update-class')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#updateclass-modal').modal('hide');
                    $('.classlist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.class_name_error').text(response.responseJSON.errors.class_name);
                    $('.class_numeric_error').text(response.responseJSON.errors.class_numeric);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.class_delete', function(e) {
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
                            url: "{{route('backend.delete-class')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.classlist_datatable').DataTable().ajax.reload();
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