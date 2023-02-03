@extends('backend.layouts.app')
@section('title', 'List Subject Class')
@section('content')

 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a  href="{{ route('backend.add-subject-class') }}" class="btn btn-primary"><i class="mdi mdi-plus"></i>Add Subject Class</a>
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
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Class</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($sections as $section)
                <tr>
                    <td>{{$section->section_name}}</td>
                    <td>{{$section->section_capacity}}</td>
                    <td>{{$section->class->class_name}}</td>
                    <td>
                        <a href="{{ route('backend.edit-subject-class', ['id'=>$section->id]) }}" class="btn btn-sm btn-success">
                            <i class="mdi mdi-file-edit-outline"></i>
                        </a>
                        {{--<a href="{{ route('backend.delete-subject-class', ['id'=>$section->id]) }}" id="delete" class="btn btn-sm btn-danger">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </a>--}}
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