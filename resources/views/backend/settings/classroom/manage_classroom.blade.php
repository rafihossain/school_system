@extends('backend.layouts.app')
@section('title', 'List Class Room')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addclassroom-modal">
                <i class="mdi mdi-plus"></i>Add Classroom
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
		<table class="table table-bordered dt-responsive table-responsive nowrap classroomlist_datatable">
            <thead>
                <tr>
                    <th>Classroom Name</th>
                    <th>Classroom Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<!-- Standard modal content -->
<div id="addclassroom-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addclassroom-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addclassroom-modalLabel">Create Classroom</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addclassroom_form">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label>Classroom Name</label>
                        <input type="text" class="form-control" name="classroom_name">
                        <span class="text-danger classroom_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Description</label>
                        <textarea class="form-control" name="classroom_description"></textarea>
                        <span class="text-danger classroom_description_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_classroom">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updateclassroom-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateclassroom-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateclassroom-modalLabel">Update Classroom</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateclassroom_form">
                <input type="hidden" name="classroom_id" id="classroom_id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Classroom Name</label>
                        <input type="text" class="form-control classroom_name" name="classroom_name">
                        <span class="text-danger classroom_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Description</label>
                        <textarea class="form-control classroom_description" name="classroom_description"></textarea>
                        <span class="text-danger classroom_description_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_classroom">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('.classroomlist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-classroom') }}",
            },
            columns: [
                {
                    data: 'classroom_name',
                    name: 'classroom_name'
                },
                {
                    data: 'classroom_description',
                    name: 'classroom_description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_classroom').click(function() {

            var serialize = $("#addclassroom_form").serializeArray();
            $.ajax({
                url: "{{route('backend.save-classroom')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#addclassroom-modal').modal('hide');
                    $('.classroomlist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.classroom_name_error').text(response.responseJSON.errors.classroom_name);
                    $('.classroom_description_error').text(response.responseJSON.errors.classroom_description);
                }
            })

        });

        $(document).delegate('.classroom_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-classroom')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#classroom_id').val(data.id);
                    $('.classroom_name').val(data.classroom_name);
                    $('.classroom_description').val(data.classroom_description);
                }
            })
        });

        $('.update_classroom').click(function() {

            var serialize = $("#updateclassroom_form").serializeArray();
            $.ajax({
                url: "{{route('backend.update-classroom')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#updateclassroom-modal').modal('hide');
                    $('.classroomlist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.classroom_name_error').text(response.responseJSON.errors.classroom_name);
                    $('.classroom_description_error').text(response.responseJSON.errors.classroom_description);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.classroom_delete', function(e) {
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
                            url: "{{route('backend.delete-classroom')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.classroomlist_datatable').DataTable().ajax.reload();
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