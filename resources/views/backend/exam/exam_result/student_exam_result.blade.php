<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-bordered dt-responsive nowrap">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>ROLL NO</th>
                    @foreach($get_student_subject as $row)
                    <th>{{$row['subject_name']}}</th>
                    @endforeach
                    <th>GPA</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                @php
                    $gpa=0;
                    $pass_fail_flag=0;
                @endphp
                <tr>
                    <td>{{$student['get_student']['name']}}</td>
                    <td>{{$student['roll_no']}}</td>
                    @foreach($get_student_subject as $key=>$row)
                        @if(isset($student['student_mark_new'][$key])) 
                            <td>
                                @foreach($result_rules as $result_rule)   
                                   @if(($student['student_mark_new'][$key]['mark'] >= $result_rule->min_mark) && ($student['student_mark_new'][$key]['mark'] <= $result_rule->max_mark))
                                    {{$result_rule->name}}
                                    @php
                                     if($result_rule->name == 'F'){
                                            $pass_fail_flag=1;
                                      }   
                                     $gpa=$gpa+$result_rule->gpa;
                                    @endphp
                                   @endif              
                                @endforeach 
                            </td>    
                        @else
                             <td>0</td>
                        @endif

                    @endforeach

                    <td>
                       @if($pass_fail_flag == 0)
                            @php
                            $average=$gpa/count($get_student_subject)
                            @endphp       
                            <span>{{number_format((float)$average, 2, '.', '')}} </span>    
                        @else
                            <span>0</span> 
                        @endif

                    </td>
                    <td>
                        @if($pass_fail_flag == 0)
                            <span class="badge bg-success">PASS</span>     
                        @else
                            <span class="badge bg-danger">FAILED</span> 
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>