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
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'gender', name: 'gender'},
                { data: 'mobile', name: 'mobile'},
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