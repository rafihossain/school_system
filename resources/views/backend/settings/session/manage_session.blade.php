@extends('backend.layouts.app')
@section('title', 'List Session')
@section('css')
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content') 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.add-session') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add Session</a>
        </h4>
    </div>
</div>

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body table-responsive"> 
		<table id="datatable" class="table table-bordered dt-responsive  nowrap">
            <thead>
            <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


@section('script') 
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
        $('#addtask').on("click", function() {
            $('#addTaskModal').modal("show");
        });

        //delete sweetalert
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            var Id = $(this).attr('href');

            swal({
                    title: "Are you sure?",
                    text: "You want to delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        
                        iziToast.success({
                            message: 'Successfully restored recorded!',
                            position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                        })

                        window.location.href = Id;

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