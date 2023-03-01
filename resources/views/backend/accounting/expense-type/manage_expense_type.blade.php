@extends('backend.layouts.app')
@section('title', 'List Expense Type')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addexpensetype-modal">
                <i class="mdi mdi-plus"></i>Add Expense type
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        
		<table class="table table-bordered dt-responsive table-responsive nowrap expensetypelist_datatable">
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
<div id="addexpensetype-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addexpensetype-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addexpensetype-modalLabel">Create Expensetype</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addexpensetype_form">
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Expense Name</label>
                        <input type="text" class="form-control" name="expense_name">
                        <span class="text-danger expense_name_error"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Upload Expense Image</label>
                        <input type="file" class="dropify" id="expenseImage" name="expense_image">
                        <span class="text-danger expense_image_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_expensetype">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Standard modal content -->
<div id="expensetypeimage-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="expensetypeimage-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="expensetypeimage-modalLabel">Expensetype Image</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body expensetype_image">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updateexpensetype-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateexpensetype-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateexpensetype-modalLabel">Update Expensetype</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateexpensetype_form">
                <input type="hidden" name="id" id="expensetype_id">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label class="form-label">Expense Name</label>
                        <input type="text" class="form-control expense_name" name="expense_name">
                        <span class="text-danger expense_name_error"></span>
                    </div>
                    <div class="expensetype_image"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_expensetype">Save</button>
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
    
        var table = $('.expensetypelist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-expense-type') }}",
            },
            columns: [
                {
                    data: 'expense_name',
                    name: 'expense_name'
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

        $('.create_expensetype').click(function() {

            var formdata = new FormData(document.getElementById('addexpensetype_form'));
            $.ajax({
                url: "{{route('backend.save-expense-type')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#addexpensetype-modal').modal('hide');
                    $('.expensetypelist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.expense_name_error').text(response.responseJSON.errors.expense_name);
                    $('.expense_image_error').text(response.responseJSON.errors.expense_image);
                }
            })

        });

        $(document).delegate('.expensetype_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-expense-type')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#expensetype_id').val(data.id);
                    $('.expense_name').val(data.expense_name);
                    
                    var url = $('meta[name="base_url"]').attr('content');
                    var imagePath = url+'/images/expanse_image/'+data.expense_image;
                    var html ='<label class="form-label">Upload Expense Image</label><input type="file" class="dropify" id="expenseImage" name="expense_image" data-default-file="'+imagePath+'"><span class="text-danger expense_image_error"></span>';
                    
                    $('.expensetype_image').html(html);
                    $('.dropify').dropify();
                }
            })
        });

        $(document).delegate('.viewexpensetype_image', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.view-expensetype-image')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    var url = $('meta[name="base_url"]').attr('content');
                    var imagePath = url+'/images/expanse_image/'+data.expense_image;
                    $('.expensetype_image').html('<img src="'+imagePath+'" class="img-fluid" alt="">');
                }
            })
        });

        $('.update_expensetype').click(function() {

            var formdata = new FormData(document.getElementById('updateexpensetype_form'));
            $.ajax({
                url: "{{route('backend.update-expense-type')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#updateexpensetype-modal').modal('hide');
                    $('.expensetypelist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.expense_name_error').text(response.responseJSON.errors.expense_name);
                    $('.expense_image_error').text(response.responseJSON.errors.expense_image);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.expensetype_delete', function(e) {
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
                            url: "{{route('backend.delete-expense-type')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.expensetypelist_datatable').DataTable().ajax.reload();
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