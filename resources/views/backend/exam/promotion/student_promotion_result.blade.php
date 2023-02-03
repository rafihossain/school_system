<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-bordered dt-responsive nowrap">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>ROLL NO</th>
                    <!-- <th>GPA</th>
                    <th>STATUS</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->get_student->name }}</td>
                    <td>{{ $student->roll_no }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>