<h6>Day wise attendance</h6>
<table class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>NAME</th>
            <th>PHONE</th>
            <th>DEPARTMENT</th>
            <th>STATUS</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
        <tr>
            <td>{{$teacher->name}}</td>
            <td>{{$teacher->mobile}}</td>
            <td>{{'Department'}}</td>
            <td>
                @if(!is_null($teacher->teacher_single_attendence))
                    @if($teacher->teacher_single_attendence->status == 'present')
                    <div class="text-center bg-success text-white">P</div>
                    @else
                    <div class="bg-danger text-center text-white">A</div>
                    @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>