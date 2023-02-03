@extends('backend.layouts.app')
@section('title', 'Student List')
@section('content')
<div class="card">
    <form method="post" action="{{route('backend.save-student-csv')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" onchange="this.form.submit()" name="student_csv" id="importCSV" class="d-none" accept=".csv" />
    </form>
    <div class="card-body d-flex justify-content-between">
        <label for="importCSV" class="btn btn-success btn-sm">Import Excel</label>
        <a href="{{asset('csv/template/student-information-template.csv')}}" class="btn btn-primary btn-sm">Download excel format</a></p>
        <a class="btn btn-primary text-end" href="{{route('backend.add.student')}}">+ Add Student</a>
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
                <div class="row" style="margin-left:15%;">
                    <div class="col-md-2">
                        <select class="form-control submitable" name="department_id" id="department_id">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="class_id" id="class_id" class="form-control submitable">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="section_id" id="section_id" class="form-control submitable">
                            <option value="">Select Section</option>
                            @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->section_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary btn-sm mt-2 reset_datatable" style="margin-left:16%;">Reset</button>
                <table class="table table-bordered table-bordered dt-responsive nowrap student_datatable">
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

        var table = $('.student_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.student.index') }}",
                data: function(e) {
                    e.department_id = $("#department_id").val();
                    e.class_id = $("#class_id").val();
                    e.section_id = $("#section_id").val();
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

    $(document).delegate('.student_info_edit', 'click', function() {
        localStorage.clear();
    });

    $(document).on('change', '.submitable', function() {
        $('.student_datatable').DataTable().ajax.reload();
    });

    $(document).on('click', '.reset_datatable', function() {
        $('#department_id').val('');
        $('#class_id').val('');
        $('#section_id').val('');
        $('.student_datatable').DataTable().ajax.reload(null, false);
    });
</script>
@endsection