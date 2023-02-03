@extends('backend.layouts.app')
@section('title', 'List Department')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.department-archive-list') }}" class="btn btn-warning "></i>Archive List</a>
            <a href="{{ route('backend.add-department') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add Department</a>
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
                <th>Name</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td>{{$department->department_name}}</td>
                    <td> 
                        <img src="{{asset('images/department/'.$department->department_image) }}" height="50" alt="">
                    </td>

                    @if($department->department_status == 1)
                    <td><span class="badge bg-success rounded-pill">Active</span></td> 
                    @else
                    <td><span class="badge bg-danger rounded-pill">Inactive</span></td> 
                    @endif

                    <td>
                        <a href="{{ route('backend.edit-department', ['id'=>$department->id]) }}" class="btn btn-sm btn-success">
                            <i class="mdi mdi-file-edit-outline"></i>
                        </a>
                        <a href="{{ route('backend.delete-department', ['id'=>$department->id]) }}" id="delete" class="btn btn-sm btn-danger">
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
                            message: 'Successfully archived recorded!',
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