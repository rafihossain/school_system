@extends('backend.layouts.app')
@section('title', 'Exam List')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal">+ Create</a>
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="alert alert-success d-none success_msg_show" style="text-align: center;"></div>

        <div class="alert alert-danger danger_msg_show text-center" style="display: none;"></div>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-bordered dt-responsive nowrap examlist_datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Note</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->

<!-- Standard modal content -->
<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Create Exam</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create_exam_save">
                <div class="modal-body">
                    <span class="text-danger ml-2 dateError" align="center"></span>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="recipient-name">
                        <span class="text-danger nameError"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" id="recipient-name">
                            <span class="text-danger startError"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control" id="recipient-name">
                            <span class="text-danger endError"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Note</label>
                        <textarea name="note" id="" cols="2" rows="5" class="form-control">

                        </textarea>
                        <span class="text-danger noteError"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_exam">Save</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="standard-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit Exam</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update_exam">
                <input type="hidden" name="exam_id" id="exam_id">
                <div class="modal-body">
                    <span class="text-danger ml-2 dateError_new" align="center"></span>
                    <div class="mb-2">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control name_data" id="recipient-name">
                        <span class="text-danger nameError_new"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control start_date_data" id="recipient-name">
                            <span class="text-danger startError_new"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control end_date_data" id="recipient-name">
                            <span class="text-danger endError_new"></span>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="recipient-name" class="col-form-label">Note</label>
                        <textarea name="note" id="" cols="2" rows="5" class="form-control note_data">

                        </textarea>
                        <span class="text-danger noteError_new"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_exam">Save</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function() {

        var table = $('.examlist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.exam.list') }}",
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'note',
                    name: 'note'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_exam').click(function() {

            var data = $("#create_exam_save").serialize();
            $.ajax({
                url: "{{route('backend.create.exam')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: data,
                cache: false,
                dataType: 'json',
                success: function(data) {
                    //console.log(data.date_validate);
                    if(data.date_validate){
                        $('.dateError').text(data.date_validate);
                        $('.nameError').text('');
                        $('.startError').text('');
                        $('.endError').text('');
                        $('.noteError').text('');
                    }else{
                        $('.dateError').text('');
                        $('#standard-modal').modal('hide');
                        $("div").removeClass("d-none");
                        $('.success_msg_show').html(data.message);
                        $('.examlist_datatable').DataTable().ajax.reload();
                    }
                },
                error: function(response) {
                    //console.log(response);
                    if(response.responseJSON.errors.name)
                    {
                        $('.nameError').text(response.responseJSON.errors.name);
                    }
                    else
                    {
                        $('.nameError').text('');
                    }

                    if(response.responseJSON.errors.start_date)
                    {
                        $('.startError').text(response.responseJSON.errors.start_date);
                    }
                    else
                    {
                        $('.startError').text('');
                    }

                    if(response.responseJSON.errors.end_date)
                    {
                        $('.endError').text(response.responseJSON.errors.end_date);
                    }
                    else
                    {
                        $('.endError').text('');
                    }

                    if(response.responseJSON.errors.note)
                    {
                        $('.noteError').text(response.responseJSON.errors.note);
                    }
                    else
                    {
                        $('.noteError').text('');
                    }
                    $('.dateError').text('');
                }
            })
        });

        $(document).delegate('.exam_edit', 'click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit.exam')}}",
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#exam_id').val(data.id);
                    $('.name_data').val(data.name);
                    $('.start_date_data').val(data.start_date);
                    $('.end_date_data').val(data.end_date);
                    $('.note_data').val(data.note);
                }
            })
        });

        $('.update_exam').click(function() {
            var data = $("#update_exam").serialize();
            $.ajax({
                url: "{{route('backend.update.exam')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: data,
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if(data.date_validate){
                        $('.dateError_new').text(data.date_validate);
                        $('.nameError_new').text('');
                        $('.startError_new').text('');
                        $('.endError_new').text('');
                        $('.noteError_new').text('');
                    }
                    else
                    {
                        $('#standard-edit').modal('hide');
                        $("div").removeClass("d-none");
                        $('.success_msg_show').html(data.message)
                        $('.examlist_datatable').DataTable().ajax.reload();
                    }
                },
                error: function(response) {
                    //console.log(response);
                    if(response.responseJSON.errors.name)
                    {
                        $('.nameError_new').text(response.responseJSON.errors.name);
                    }
                    else
                    {
                        $('.nameError_new').text('');
                    }

                    if(response.responseJSON.errors.start_date)
                    {
                        $('.startError_new').text(response.responseJSON.errors.start_date);
                    }
                    else
                    {
                        $('.startError_new').text('');
                    }

                    if(response.responseJSON.errors.end_date)
                    {
                        $('.endError_new').text(response.responseJSON.errors.end_date);
                    }
                    else
                    {
                        $('.endError_new').text('');
                    }

                    if(response.responseJSON.errors.note)
                    {
                        $('.noteError_new').text(response.responseJSON.errors.note);
                    }
                    else
                    {
                        $('.noteError_new').text('');
                    }
                    $('.dateError_new').text('');
                }
            })
        });
        
         

        $(document).delegate('.exam_delete', 'click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.delete.exam')}}",
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $(".danger_msg_show").css("display","block");
                    $('.danger_msg_show').html(data.message)
                    $('.examlist_datatable').DataTable().ajax.reload();
                }
            })
        });
    });
</script>
@endsection