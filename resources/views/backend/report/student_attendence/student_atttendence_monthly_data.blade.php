<div class="card">
    <div class="card-body table-responsive">
        <h4>Attendance Report</h4>
        <h6>Month wise attendance</h6>
        <table class="table table-bordered table-bordered dt-responsive nowrap">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>ROLL</th>
                    @for ($i=1; $i <= $days; $i++)
                       <th>{{$i}}</th>     
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{$student->getStudent->name}}</td>
                    <td>{{$student->roll_no}}</td>
                    @for ($i=1; $i <= $days; $i++)
                        <td>
                           @if(!is_null($student->student_attendence))
                             @foreach($student->student_attendence as $datas)
                                @if(date('d',strtotime($datas->attendence_date)) == $i)
                                    @if($datas->status == 'present')
                                        <div  class="text-center bg-success text-white">
                                             P
                                        </div>
                                    @else
                                        <div class="bg-danger text-center text-white">A</div>
                                    @endif
                                @endif
                             @endforeach     
                          @endif 
                        </td>     
                    @endfor   
                    
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>