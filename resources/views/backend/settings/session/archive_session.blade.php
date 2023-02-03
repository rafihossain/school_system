@extends('backend.layouts.app')
@section('title', 'List Session')
@section('content')
<div class="text-end mb-3">
    <a href="{{ route('backend.manage-designation') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>List designation</a>
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
                    <th>Short Name</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($designations as $designation)
                <tr>
                    <td class="text-wrap">{{$designation->designation_name}}</td>
                    <td class="text-wrap">{{$designation->designation_short_name}}</td>
                    <td class="text-wrap">{{$designation->description}}</td>

                    @if($designation->designation_status == 1)
                    <td><span class="badge bg-success rounded-pill">Active</span></td> 
                    @else
                    <td><span class="badge bg-danger rounded-pill">Inactive</span></td> 
                    @endif

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