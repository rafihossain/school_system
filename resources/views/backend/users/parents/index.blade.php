@extends('backend.layouts.app')
@section('title', 'Parent List')
@section('content')

<div class="card">
    <form method="post" action="{{route('backend.save-parent-csv')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" onchange="this.form.submit()" name="parent_csv" id="importCSV" class="d-none" accept=".csv" />
    </form>
    <div class="card-body d-flex justify-content-between">
        <label for="importCSV" class="btn btn-success btn-sm">Import Excel</label>
        <a href="{{asset('csv/template/parent-information-template.csv')}}" class="btn btn-primary btn-sm">Download excel format</a></p>
        <a class="btn btn-primary text-end" href="{{route('backend.add.parents')}}">+ Add Parents</a>
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
                        <select name="class_id" id="class_id" class="form-control submitable">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="section_id" id="section_id" class="form-control submitable">
                            <option value="">Select section</option>

                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="student_id" id="student_id" class="form-control submitable">
                            <option value="">Select Student</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary btn-sm mt-2 reset_datatable" style="margin-left:16%;">Reset</button>
                <table id="" class="table table-bordered table-bordered dt-responsive nowrap parent_datatable">
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
    $("#student_id").hide();

    $(document).delegate('.parent_info_edit', 'click', function() {
        localStorage.clear();
    });

    $(document).ready(function() {
        var table = $('.parent_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.parents.index') }}",
                data: function(e) {
                    e.class_id = $("#class_id").val();
                    e.section_id = $("#section_id").val();
                    e.student_id = $("#student_id").val();
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
        $('.parent_datatable').DataTable().ajax.reload();
        
    });

    $('#class_id').on('change', function(e) {
        var class_id = $(this).val();
        $.ajax({
            url: "{{route('backend.get_section')}}",
            type: 'GET',
            data: {
                'class_id': class_id
            },
            success: function(data) {
                $("#section_id").html(data);
            }
        })
    });


    $('#section_id').on('change', function(e) {

        if (($("#class_id").val() != '') && ($("#section_id").val() != '')) {
            $('#student_id').show();
            $.ajax({
                url: "{{route('backend.get_student')}}",
                type: 'GET',
                data: {
                    'class_id': $("#class_id").val(),
                    'section_id':$("#section_id").val()
                },
                success: function(data) {
                    $("#student_id").html(data);
                }
            })
        }
    });

    $(document).on('click', '.reset_datatable', function() {
        $('#student_id').val('');
        $('#class_id').val('');
        $('#section_id').val('');
        $('.parent_datatable').DataTable().ajax.reload(null,false);
    });
</script>
@endsection