@extends('backend.layouts.app')
@section('title', 'List Department')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            {{-- <a href="{{ route('backend.department-archive-list') }}" class="btn btn-warning "></i>Archive List</a> --}}
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adddepartment-modal">
                <i class="mdi mdi-plus"></i>Add Department
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
		<table class="table table-bordered dt-responsive table-responsive nowrap departmentlist_datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

<!-- Standard modal content -->
<div id="adddepartment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="adddepartment-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="adddepartment-modalLabel">Create Department</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="adddepartment_form">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label class="form-label">Department Name</label>
                        <input type="text" class="form-control" name="department_name">
                        <span class="text-danger department_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                        <span class="text-danger description_error"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Department Image</label>
                        <input type="file" class="dropify" name="department_image">
                        <span class="text-danger departmentimage_error"></span>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="department_status" value="0">
                        <input type="checkbox" class="form-check-input" id="customSwitch1" name="department_status" value="1">
                        <label class="form-check-label" for="customSwitch1">Active</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_department">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Standard modal content -->
<div id="departmentimage-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="departmentimage-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="departmentimage-modalLabel">Department Image</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body department_image">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updatedepartment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatedepartment-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatedepartment-modalLabel">Update Department</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatedepartment_form">
                <input type="hidden" name="department_id" id="department_id">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label class="form-label">Department Name</label>
                        <input type="text" class="form-control department_name" name="department_name">
                        <span class="text-danger department_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Description</label>
                        <textarea class="form-control description" name="description"></textarea>
                        <span class="text-danger description_error"></span>
                    </div>
                    
                    <div class="department_image"></div>

                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="department_status" value="0">
                        <input type="checkbox" class="form-check-input department_status" id="customSwitch1" name="department_status" value="1">
                        <label class="form-check-label" for="customSwitch1">Active</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_department">Save</button>
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
    
        var table = $('.departmentlist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-department') }}",
            },
            columns: [
                {
                    data: 'department_name',
                    name: 'department_name'
                },
                {
                    data: 'photo',
                    name: 'photo'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_department').click(function() {

            var formdata = new FormData(document.getElementById('adddepartment_form'));
            $.ajax({
                url: "{{route('backend.save-department')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#adddepartment-modal').modal('hide');
                    $('.departmentlist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.department_name_error').text(response.responseJSON.errors.department_name);
                    $('.description_error').text(response.responseJSON.errors.description);
                    $('.departmentimage_error').text(response.responseJSON.errors.department_image);
                }
            })

        });

        $(document).delegate('.department_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-department')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#department_id').val(data.id);
                    $('.department_name').val(data.department_name);
                    $('.description').val(data.description);

                    if(data.department_status == 1){
                        $('.department_status').attr('checked', true);
                    }
                    
                    var url = $('meta[name="base_url"]').attr('content');
                    var imagePath = url+'/images/department/'+data.department_image;
                    var html ='<div class="form-group mb-2"><label class="form-label">Department Image</label><input type="file" class="dropify" name="department_image" data-default-file="'+imagePath+'"><span class="text-danger departmentimage_error"></span></div>'
                    
                    $('.department_image').html(html);
                    $('.dropify').dropify();
                }
            })
        });

        $(document).delegate('.viewdepartment_image', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.view-department-image')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    var url = $('meta[name="base_url"]').attr('content');
                    var imagePath = url+'/images/department/'+data.department_image;
                    $('.department_image').html('<img src="'+imagePath+'" class="img-fluid" alt="">');
                }
            })
        });

        $('.update_department').click(function() {

            var formdata = new FormData(document.getElementById('updatedepartment_form'));
            $.ajax({
                url: "{{route('backend.update-department')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#updatedepartment-modal').modal('hide');
                    $('.departmentlist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.department_name_error').text(response.responseJSON.errors.department_name);
                    $('.description_error').text(response.responseJSON.errors.description);
                    $('.departmentimage_error').text(response.responseJSON.errors.department_image);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.department_delete', function(e) {
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
                            url: "{{route('backend.delete-department')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.departmentlist_datatable').DataTable().ajax.reload();
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