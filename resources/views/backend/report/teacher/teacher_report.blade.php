@extends('backend.layouts.app')
@section('title', 'Teacher Report')
@section('content')


<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body table-responsive">
               
                <table id="" class="table table-bordered table-bordered dt-responsive nowrap teacher_report_datatable">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>DEPARTMENT</th>
                            <th>GENDER</th>
                            <th>PHONE</th>
                            <th>ACTION</th>
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
        var table = $('.teacher_report_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.report.teacher') }}",
            },
            columns: [
                { data: 'get_teacher.name', name: 'get_teacher.name' },
                { data: 'get_teacher.email', name: 'get_teacher.email' },
                { data: 'get_department.department_name', name: 'get_department.department_name' },
                { data: 'get_teacher.gender', name: 'get_teacher.gender'},
                { data: 'get_teacher.mobile', name: 'get_teacher.mobile'},
                {
                    data:'action',
                    name:'action',
                    orderable:true, 
                    searchable:true
                },
            ],
        });
    });
</script>
@endsection