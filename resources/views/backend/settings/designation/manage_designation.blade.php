@extends('backend.layouts.app')
@section('title', 'List Designation')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            {{-- <a href="{{ route('backend.designation-archive-list') }}" class="btn btn-warning "></i>Archive List</a> --}}
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adddesignation-modal">
                <i class="mdi mdi-plus"></i>Add designation
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        
		<table class="table table-bordered dt-responsive table-responsive nowrap designationlist_datatable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Short Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
 
            </tbody>
        </table>
    </div>
</div>

<!-- Standard modal content -->
<div id="adddesignation-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="adddesignation-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="adddesignation-modalLabel">Create designation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="adddesignation_form">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label>Designation Name</label>
                        <input type="text" class="form-control designation_name" name="designation_name">
                        <span class="text-danger designation_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Designation Short Name</label>
                        <input type="text" class="form-control designation_short_name" name="designation_short_name">
                        <span class="text-danger designation_short_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Description</label>
                        <textarea id="editor" class="form-control description" name="description"></textarea>
                        <span class="text-danger description_error"></span>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="designation_status" value="0">
                        <input type="checkbox" class="form-check-input" id="customSwitch1" name="designation_status" value="1">
                        <label class="form-check-label" for="customSwitch1">Active</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_designation">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updatedesignation-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatedesignation-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateclass-modalLabel">Update designation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatedesignation_form">
                <input type="hidden" name="id" id="designation_id">
                <div class="modal-body">

                    <div class="mb-2">
                        <label>Designation Name</label>
                        <input type="text" class="form-control designation_name" name="designation_name">
                        <span class="text-danger designation_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Designation Short Name</label>
                        <input type="text" class="form-control designation_short_name" name="designation_short_name">
                        <span class="text-danger designation_short_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Description</label>
                        <textarea id="editor" class="form-control description" name="description"></textarea>
                        <span class="text-danger description_error"></span>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="designation_status" value="0">
                        <input type="checkbox" class="form-check-input" id="customSwitch1" name="designation_status" value="1">
                        <label class="form-check-label" for="customSwitch1">Active</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_designation">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        var table = $('.designationlist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-designation') }}",
            },
            columns: [
                {
                    data: 'designation_name',
                    name: 'designation_name'
                },
                {
                    data: 'designation_short_name',
                    name: 'designation_short_name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_designation').click(function() {

            var serialize = $("#adddesignation_form").serializeArray();
            $.ajax({
                url: "{{route('backend.save-designation')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#adddesignation-modal').modal('hide');
                    $('.designationlist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.designation_name_error').text(response.responseJSON.errors.designation_name);
                    $('.designation_short_name_error').text(response.responseJSON.errors.designation_short_name);
                    $('.description_error').text(response.responseJSON.errors.description);
                }
            })

        });

        $(document).delegate('.designation_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-designation')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#designation_id').val(data.id);
                    $('.designation_name').val(data.designation_name);
                    $('.designation_short_name').val(data.designation_short_name);
                    $('.description').val(data.description);
                }
            })
        });

        $('.update_designation').click(function() {

            var serialize = $("#updatedesignation_form").serializeArray();
            $.ajax({
                url: "{{route('backend.update-designation')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#updatedesignation-modal').modal('hide');
                    $('.designationlist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.designation_name_error').text(response.responseJSON.errors.designation_name);
                    $('.designation_short_name_error').text(response.responseJSON.errors.designation_short_name);
                    $('.description_error').text(response.responseJSON.errors.description);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.designation_delete', function(e) {
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
                            url: "{{route('backend.delete-designation')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.designationlist_datatable').DataTable().ajax.reload();
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