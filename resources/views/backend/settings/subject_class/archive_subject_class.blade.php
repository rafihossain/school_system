@extends('backend.layouts.app')
@section('title', 'List Blog')
@section('content')
 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-class') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i> List class</a>
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
                    <th>Class Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                <tr>
                    <td>{{$class->class_name}}</td>
                    <td>{{$class->session->session_name}}</td>
                    <td>{{$class->class_numeric}}</td>

                    @if($class->class_status == 1)
                    <td><span class="badge bg-success rounded-pill">Active</span></td> 
                    @else
                    <td><span class="badge bg-danger rounded-pill">Inactive</span></td> 
                    @endif

                    <td>
                        <a href="{{ route('backend.edit-class', ['id'=>$class->id]) }}" class="btn btn-sm btn-success">
                            <i class="mdi mdi-file-edit-outline"></i>
                        </a>
                        <a href="{{ route('backend.delete-class', ['id'=>$class->id]) }}" id="delete" class="btn btn-sm btn-danger">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function() {

    });
</script>
@endsection