@extends('backend.layouts.app')
@section('title', 'Exam Result Rule')
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
        @if(Session::has('success'))
        <div class="alert alert-success" style="text-align: center;">
            {{ Session::get('success') }}
        </div>
        @endif
        @if(Session::has('delete'))
        <div class="alert alert-danger" style="text-align: center;">
            {{ Session::get('delete') }}
        </div>
        @endif
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-bordered dt-responsive nowrap exam_result_rule_datatable">
                    <thead>
                        <tr>
                            <th>CLASS</th>
                            <th>NAME</th>
                            <th>GPA</th>
                            <th>MIN MARK</th>
                            <th>MAX MARK</th>
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
                <h4 class="modal-title" id="standard-modalLabel">Create Exam Term</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create_exam_result_rule">
                <div class="modal-body">
                    <span class="text-danger ml-2 dateError" align="center"></span>
                    <div class="mb-3">
                        <label for="" class="col-form-label">Select Class</label>
                        <select name="class_id" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($classes as $classe)
                            <option value="{{$classe->id}}">{{$classe->class_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger classError_new"></span>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="recipient-name" placeholder="Enter name">
                        <span class="text-danger nameError"></span>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">GPA</label>
                        <input type="number" name="gpa" class="form-control" id="recipient-name" placeholder="Enter gpa">
                        <span class="text-danger gpaError"></span>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Min Mark</label>
                        <input type="number" name="min_mark" class="form-control" id="recipient-name" placeholder="Enter min mark">
                        <span class="text-danger min_markError"></span>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Max Mark</label>
                        <input type="number" name="max_mark" class="form-control" id="recipient-name" placeholder="Enter max mark">
                        <span class="text-danger max_markError"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save_exam_result_rule">Save</button>
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
                <h4 class="modal-title" id="standard-modalLabel">Edit Exam Result Rule</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update_exam_result_rule">
                <input type="hidden" name="exam_result_rule_id" id="exam_result_rule_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="col-form-label">Select Class</label>
                        <select name="class_id" class="form-control class_id">
                            <option value="">Select Class</option>
                            @foreach($classes as $classe)
                            <option value="{{$classe->id}}">{{$classe->class_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger classError_new"></span>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control name_data" id="recipient-name" placeholder="Enter name">
                        <span class="text-danger nameError_new"></span>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">GPA</label>
                        <input type="number" name="gpa" class="form-control gpa_data" id="recipient-name" placeholder="Enter gpa">
                        <span class="text-danger gpaError_new"></span>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Min Mark</label>
                        <input type="number" name="min_mark" class="form-control min_mark_data" id="recipient-name" placeholder="Enter min mark">
                        <span class="text-danger min_markError_new"></span>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Max Mark</label>
                        <input type="number" name="max_mark" class="form-control min_mark_data" id="recipient-name" placeholder="Enter max mark">
                        <span class="text-danger max_markError_new"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_exam_result_rule">Save</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function() {

        var table = $('.exam_result_rule_datatable').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('backend.result_rule.index') }}",
            },
            columns: [
                {data: 'class.class_name',name: 'class.class_name'},
                {data: 'name',name: 'name'},
                {data: 'gpa',name: 'gpa'},
                {data: 'min_mark',name: 'min_mark'},
                {data: 'max_mark',name: 'max_mark'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.save_exam_result_rule').click(function() {

            var data = $("#create_exam_result_rule").serialize();
            $.ajax({
                url: "{{route('backend.save.exam_result_rule')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: data,
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        iziToast.success({
                            message: 'Exam Rule Successfully Inserted!',
                            position: 'topRight',
                        })
                        $('.nameError').text('');
                        $('.gpaError').text('');
                        $('.min_markError').text('');
                        $('.min_markError').text('');
                        $("#create_exam_result_rule")[0].reset();
                        $('#standard-modal').modal('hide');
                        $('.exam_result_rule_datatable').DataTable().ajax.reload();
                    }
                },
                error: function(response) {
                    if (response.responseJSON.errors.name) {
                        $('.nameError').text(response.responseJSON.errors.name);
                    } else {
                        $('.nameError').text('');
                    }

                    if (response.responseJSON.errors.gpa) {
                        $('.gpaError').text(response.responseJSON.errors.gpa);
                    } else {
                        $('.gpaError').text('');
                    }

                    if (response.responseJSON.errors.min_mark) {
                        $('.min_markError').text(response.responseJSON.errors.min_mark);
                    } else {
                        $('.min_markError').text('');
                    }

                    if (response.responseJSON.errors.max_mark) {
                        $('.max_markError').text(response.responseJSON.errors.max_mark);
                    } else {
                        $('.max_markError').text('');
                    }
                }
            })
        });

        $(document).delegate('.exam_result_rule_edit', 'click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit.exam_result_rule')}}",
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#exam_result_rule_id').val(data.id);
                    $('.class_id').val(data.class_id);
                    $('.name_data').val(data.name);
                    $('.gpa_data').val(data.gpa);
                    $('.min_mark_data').val(data.min_mark);
                    $('.max_mark_data').val(data.max_mark);
                }
            })
        });

        $('.update_exam_result_rule').click(function() {
            var data = $("#update_exam_result_rule").serialize();
            $.ajax({
                url: "{{route('backend.update.exam_result_rule')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: data,
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        iziToast.success({
                            message: 'Exam Rule Successfully Updated!',
                            position: 'topRight',
                        })

                        $('.nameError_new').text('');
                        $('.gpaError_new').text('');
                        $('.min_markError_new').text('');
                        $('.max_markError_new').text('');
                        $('#standard-edit').modal('hide');
                        $('.exam_result_rule_datatable').DataTable().ajax.reload();
                    }
                },
                error: function(response) {
                    //console.log(response);
                    if (response.responseJSON.errors.name) {
                        $('.nameError_new').text(response.responseJSON.errors.name);
                    } else {
                        $('.nameError_new').text('');
                    }

                    if (response.responseJSON.errors.gpa) {
                        $('.gpaError_new').text(response.responseJSON.errors.gpa);
                    } else {
                        $('.gpaError_new').text('');
                    }

                    if (response.responseJSON.errors.min_mark) {
                        $('.min_markError_new').text(response.responseJSON.errors.min_mark);
                    } else {
                        $('.min_markError_new').text('');
                    }

                    if (response.responseJSON.errors.max_mark) {
                        $('.max_markError_new').text(response.responseJSON.errors.max_mark);
                    } else {
                        $('.max_markError_new').text('');
                    }
                }
            })
        });



        $(document).delegate('.exam_result_rule_delete', 'click', function() {

            var id = $(this).data('id');
            swal({
                    title: "Are you sure?",
                    text: "You want to delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('backend.delete.exam_result_rule')}}",
                            type: 'get',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
                                if (data.success) {
                                    iziToast.warning({
                                        message: 'Exam Rule Successfully Deleted!',
                                        position: 'topRight',
                                    })
                                    $('.exam_result_rule_datatable').DataTable().ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Your data is safe :)", "error");
                    }
                });

        });
    });
</script>
@endsection