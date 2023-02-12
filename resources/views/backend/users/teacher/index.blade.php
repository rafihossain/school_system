@extends('backend.layouts.app')
@section('title', 'Teacher List')
@section('content')

<div class="card">
    <form method="post" action="{{route('backend.save-teacher-csv')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" onchange="this.form.submit()" name="teacher_csv" id="importCSV" class="d-none" accept=".csv" />
    </form>
    <div class="card-body d-flex justify-content-between">
        <label for="importCSV" class="btn btn-success btn-sm">Import Excel</label>
        <a href="{{asset('csv/template/teacher-information-template.csv')}}" class="btn btn-primary btn-sm">Download excel format</a></p>
        <a class="btn btn-primary text-end" href="{{route('backend.add.teacher')}}">+ Add Teacher</a>
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

                <div class="row">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-warning reset_datatable">Reset</button>
                        <div class="ms-2">
                            <select class="form-control submitable" name="department_id" id="department_id">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="ms-2">
                            <select class="form-control submitable" name="designation_id" id="designation_id">
                                <option value="">Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="ms-2">
                            <select class="form-control submitable" name="status" id="status_val">
                                <option value="">Select status</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table-bordered dt-responsive nowrap teacher_datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
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
        var table = $('.teacher_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.teacher.index') }}",
                data: function(e) {
                    e.department_id = $("#department_id").val();
                    e.designation_id = $("#designation_id").val();
                    e.status = $("#status_val").val();
                },
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });

    $(document).on('change', '.submitable', function() {
        $('.teacher_datatable').DataTable().ajax.reload();
    });
    $(document).on('click', '.reset_datatable', function() {
        $('#department_id').val('');
        $('#designation_id').val('');
        $('#status_val').val('');
        $('.teacher_datatable').DataTable().ajax.reload(null,false);
    });
</script>
@endsection