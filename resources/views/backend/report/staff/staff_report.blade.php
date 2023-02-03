@extends('backend.layouts.app')
@section('title', 'Staff Report')
@section('content')


<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body table-responsive">
               
                <table id="" class="table table-bordered table-bordered dt-responsive nowrap staff_report_datatable">
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
        var table = $('.staff_report_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.report.staff') }}",
            },
            columns: [
                { data: 'get_user.name', name: 'get_user.name' },
                { data: 'get_user.email', name: 'get_user.email' },
                { data: 'get_user.gender', name: 'get_user.gender' },
                { data: 'get_user.mobile', name: 'get_user.mobile'},
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