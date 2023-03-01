@extends('backend.layouts.app')
@section('title', 'List Expense')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addexpense-modal">
                <i class="mdi mdi-plus"></i>Add Expense
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        
		<table class="table table-bordered dt-responsive table-responsive nowrap expenselist_datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Ammount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<!-- Standard modal content -->
<div id="addexpense-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addexpense-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addexpense-modalLabel">Create Expense</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addexpense_form">
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Expense Type</label>
                        <select class="form-control" name="expensetype_id">
                            <option value="">Select Expense</option>
                            @foreach($expensetypes as $expensetype)
                                <option value="{{ $expensetype->id }}">{{ $expensetype->expense_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger expensetype_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Expense Ammount</label>
                        <input type="number" class="form-control" name="expense_ammount">
                        <span class="text-danger expense_ammount_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Expense Description</label>
                        <textarea class="form-control" name="expense_description"></textarea>
                        <span class="text-danger expense_description_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_expense">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updateexpense-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateexpense-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateexpense-modalLabel">Update Expense</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateexpense_form">
                <input type="hidden" name="id" id="expense_id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Expense Type</label>
                        <select class="form-control expensetype" name="expensetype_id">
                            <option value="">Select Expense</option>
                            @foreach($expensetypes as $expensetype)
                                <option value="{{ $expensetype->id }}">{{ $expensetype->expense_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger expensetype_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Expense Ammount</label>
                        <input type="number" class="form-control expense_ammount" name="expense_ammount">
                        <span class="text-danger expense_ammount_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Expense Description</label>
                        <textarea class="form-control expense_description" name="expense_description"></textarea>
                        <span class="text-danger expense_description_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_expense">Save</button>
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
    
        var table = $('.expenselist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-expense') }}",
            },
            columns: [
                {
                    data: 'expensetype.expense_name',
                    name: 'expensetype.expense_name'
                },
                {
                    data: 'expense_ammount',
                    name: 'expense_ammount'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_expense').click(function() {

            var formdata = new FormData(document.getElementById('addexpense_form'));
            $.ajax({
                url: "{{route('backend.save-expense')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#addexpense-modal').modal('hide');
                    $('.expenselist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.expensetype_error').text(response.responseJSON.errors.expensetype_id);
                    $('.expense_ammount_error').text(response.responseJSON.errors.expense_ammount);
                    $('.expense_description_error').text(response.responseJSON.errors.expense_description);
                }
            })

        });

        $(document).delegate('.expense_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-expense')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#expense_id').val(data.id);
                    $('.expensetype').val(data.expensetype_id);
                    $('.expense_ammount').val(data.expense_ammount);
                    $('.expense_description').val(data.expense_description);
                }
            })
        });

        $('.update_expense').click(function() {

            var formdata = new FormData(document.getElementById('updateexpense_form'));
            $.ajax({
                url: "{{route('backend.update-expense')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#updateexpense-modal').modal('hide');
                    $('.expenselist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.expensetype_error').text(response.responseJSON.errors.expensetype_id);
                    $('.expense_ammount_error').text(response.responseJSON.errors.expense_ammount);
                    $('.expense_description_error').text(response.responseJSON.errors.expense_description);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.expense_delete', function(e) {
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
                            url: "{{route('backend.delete-expense')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.expenselist_datatable').DataTable().ajax.reload();
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