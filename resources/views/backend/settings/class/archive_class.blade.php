@extends('backend.layouts.app')
@section('title', 'List Blog')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-class') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>List class</a>
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
                    <th>Session Name</th>
                    <th>Class Numeric</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                <tr>
                    <td>{{$class->class_name}}</td>
                    <td>{{$class->session->session_name}}</td>
                    <td>{{$class->class_numeric}}</td>

                    <td>
                        <a href="{{ route('backend.class-restore', ['id'=>$class->id]) }}" id="archive" class="btn btn-sm btn-warning">
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