@extends('backend.layouts.app')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" href="{{route('backend.add.staff')}}">+ Add Staff</a>
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
                <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($staffs as $staff)  
                       <tr>
                            <td>{{$staff->name}}</td>
                            <td>{{$staff->email}}</td>
                            <td>{{$staff->mobile}}</td>
                            <td>
                                <a href="{{route('backend.edit.staff',$staff->id)}}" class="btn btn-sm btn-primary waves-effect waves-light staff_info_edit"><i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="{{route('backend.staff.delete',$staff->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></a>
                            </td>
                       </tr>
                      @endforeach  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->

<script>
    $('.staff_info_edit').click(function(e){
        localStorage.clear();
    });
</script>
@endsection