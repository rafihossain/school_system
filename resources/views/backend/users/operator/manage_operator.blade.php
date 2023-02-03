@extends('backend.layouts.app')
@section('title', 'Operator List')
@section('content')

<div class="card">
    <form method="post" action="{{route('backend.save-teacher-csv')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" onchange="this.form.submit()" name="teacher_csv" id="importCSV" class="d-none" accept=".csv" />
    </form>
    <div class="card-body d-flex justify-content-between">
        <label for="importCSV" class="btn btn-success btn-sm">Import Excel</label>
        <a href="{{asset('csv/template/teacher-information-template.csv')}}" class="btn btn-primary btn-sm">Download excel format</a></p>
        <a class="btn btn-primary text-end" href="{{route('backend.add-operator')}}">+ Add Operator</a>
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
                <table class="table table-bordered table-bordered dt-responsive nowrap operator_datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->

<script>
    $(document).ready(function() {

        $(document).delegate('.teacher_info_edit', 'click', function() {
            localStorage.clear();
        });

        var table = $('.operator_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-operator') }}",
            },
            columns: [
                {data: 'name',name: 'name'},
                {data: 'email',name: 'email'},
                {data: 'mobile',name: 'mobile'},
                {data: 'action',name: 'action',orderable: false,searchable: false},
            ]
        });

    });

    $(document).delegate('#delete', 'click', function(e) {
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

</script>
@endsection