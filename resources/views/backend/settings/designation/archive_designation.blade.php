@extends('backend.layouts.app')
@section('title', 'List Archive')
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($designations as $designation)
                <tr>
                    <td>{{$designation->designation_name}}</td>
                    <td>{{$designation->designation_short_name}}</td>

                    <td>
                        <a href="{{ route('backend.designation-restore', ['id'=>$designation->id]) }}" id="archive" class="btn btn-sm btn-warning">
                            <i class="mdi mdi-redo-variant"></i>
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