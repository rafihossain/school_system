@extends('backend.layouts.app')
@section('title', 'List Session')
@section('css')
<link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsession-modal">+ Add Session</a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered dt-responsive nowrap sessionlist_datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($sessions as $session)
                <tr>
                    <td class="text-wrap">{{$session->session_name}}</td>
                <td class="text-wrap">{{$session->start_date}}</td>
                <td class="text-wrap">{{$session->end_date}}</td>

                <td>
                    <a href="{{ route('backend.edit-session', ['id'=>$session->id]) }}" class="btn btn-sm btn-success">
                        <i class="mdi mdi-file-edit-outline"></i>
                    </a>
                    <a href="{{ route('backend.delete-session', ['id'=>$session->id]) }}" id="delete" class="btn btn-sm btn-danger">
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
<div id="addsession-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addsession-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addsession-modalLabel">Create Session</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addsession_form">
                <div class="modal-body">

                    <div class="mb-2">
                        <label class="form-label">Session Name</label>
                        <input type="text" class="form-control session_name" name="session_name">
                        <span class="text-danger session_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control start_date" name="start_date">
                        <span class="text-danger start_date_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control end_date" name="end_date">
                        <span class="text-danger end_date_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_session">Save</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updatesession-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatesession-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatesession-modalLabel">Update Session</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatesession_form">
                <input type="hidden" name="session_id" id="session_id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Session Name</label>
                        <input type="text" class="form-control session_name" name="session_name">
                        <span class="text-danger session_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control start_date" name="start_date">
                        <span class="text-danger start_date_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control end_date" name="end_date">
                        <span class="text-danger end_date_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_session">Save</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


@section('script')
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var table = $('.sessionlist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-session') }}",
            },
            columns: [{
                    data: 'session_name',
                    name: 'session_name'
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
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_session').click(function() {

            var serialize = $("#addsession_form").serializeArray();
            $.ajax({
                url: "{{route('backend.save-session')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#addsession-modal').modal('hide');
                    $('.sessionlist_datatable').DataTable().ajax.reload();
                },
                error: function(response) {
                    $('.session_name_error').text(response.responseJSON.errors.session_name);
                    $('.start_date_error').text(response.responseJSON.errors.start_date);
                    $('.end_date_error').text(response.responseJSON.errors.end_date);
                }
            })

        });

        $(document).delegate('.session_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-session')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#session_id').val(data.id);
                    $('.session_name').val(data.session_name);
                    $('.start_date').val(data.start_date);
                    $('.end_date').val(data.end_date);
                }
            })
        });

        $('.update_session').click(function() {

            var serialize = $("#updatesession_form").serializeArray();
            $.ajax({
                url: "{{route('backend.update-session')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: serialize,
                success: function(data) {
                    $('#updatesession-modal').modal('hide');
                    $('.sessionlist_datatable').DataTable().ajax.reload();
                },
                error: function(response) {
                    $('.session_name_error').text(response.responseJSON.errors.session_name);
                    $('.start_date_error').text(response.responseJSON.errors.start_date);
                    $('.end_date_error').text(response.responseJSON.errors.end_date);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.session_delete', function(e) {
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
                            url: "{{route('backend.delete-session')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.sessionlist_datatable').DataTable().ajax.reload();
                            }
                        })

                    }

                });
        });

        $('.dropify').dropify();
        $("#datetime-datepicker").flatpickr({
            enableTime: !0,
            dateFormat: "Y-m-d H:i"
        });
    });
</script>
@endsection