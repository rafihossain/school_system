@extends('backend.layouts.app')
@section('title', 'List Class Room')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.add-classroom') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add Classroom</a>
        </h4>
    </div>
</div>

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        
		<table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
            <thead>
            <tr>
                <th>Classroom Name</th>
                <th>Classroom Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($classrooms as $classroom)
                <tr>
                    <td>{{$classroom->classroom_name}}</td>
                    <td>{{$classroom->classroom_description}}</td>
                    <td>
                        <a href="{{ route('backend.edit-classroom', ['id'=>$classroom->id]) }}" class="btn btn-sm btn-success">
                            <i class="mdi mdi-file-edit-outline"></i>
                        </a>
                        <a href="{{ route('backend.delete-classroom', ['id'=>$classroom->id]) }}" id="delete" class="btn btn-sm btn-danger">
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