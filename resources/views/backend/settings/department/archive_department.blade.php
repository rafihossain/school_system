@extends('backend.layouts.app')
@section('title', 'List Department Archive')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-department') }}" class="btn btn-primary">List Department</a>
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
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td>{{$department->department_name}}</td>
                    <td class="text-wrap">{{$department->description}}</td>
                    <td> 
                        <img src="{{asset('images/department/'.$department->department_image) }}" height="50" alt="">
                    </td>

                    <td>
                        <a href="{{ route('backend.department-restore', ['id'=>$department->id]) }}" id="archive" class="btn btn-sm btn-warning">
                            <i class="mdi mdi-redo-variant"></i>
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

         //archive sweetalert
        $(document).on('click', '#archive', function(e) {
            e.preventDefault();

            var Id = $(this).attr('href');
            iziToast.success({
                message: 'Successfully restored recorded!',
                position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            })
            window.location.href = Id;
        });

    });
</script>
@endsection