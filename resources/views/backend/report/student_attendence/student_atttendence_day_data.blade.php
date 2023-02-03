<div class="card">
    <div class="card-body table-responsive">
        <h4>Attendance Report</h4>
        <h6>Day wise attendance</h6>
            <table class="table table-bordered table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>ROLL</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                      @foreach($students as $student)
                        <tr>
                            <td>{{$student->getStudent->name}}</td>
                            <td>{{$student->roll_no}}</td>
                            <td>
                              @if(!is_null($student->student_single_attendence))
                                @if($student->student_single_attendence->status == 'present')
                                    <div  class="text-center bg-success text-white">
                                                P
                                    </div>
                                @else
                                    <div class="bg-danger text-center text-white">A</div>
                                @endif
                              @endif   
                            </td>
                        </tr>
                      
                      @endforeach
                </tbody>
            </table>
    </div>
</div>