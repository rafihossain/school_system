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
                    <th>Action</th>
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

                    @foreach($get_student_subject as $key=> $row)
                    @php
                        $grade_fail_flag=0;
                    @endphp
                        @if(isset($student['student_mark_new'][$key])) 
                            <td>
                                @foreach($result_rules as $result_rule)

                                    @foreach($subjectclasses as $subjectclass)
                                        @if($student['student_mark_new'][$key]['subject_id'] == $subjectclass->subject_id)
                                            @if($subjectclass->mintheory_mark !='')
                                                @if($student['student_mark_new'][$key]['theory_mark'] < $subjectclass->mintheory_mark)
                                                    @php
                                                        $grade_fail_flag = 1;
                                                    @endphp
                                                @endif
                                            @endif
                                            @if($subjectclass->minpractical_mark !='')
                                                @if($student['student_mark_new'][$key]['practical_mark'] < $subjectclass->minpractical_mark)
                                                    @php
                                                        $grade_fail_flag = 1;
                                                    @endphp
                                                @endif
                                            @endif
                                            @if($subjectclass->mincity_exam_mark !='')
                                                @if($student['student_mark_new'][$key]['city_exam_mark'] < $subjectclass->mincity_exam_mark)
                                                    @php
                                                        $grade_fail_flag = 1;
                                                    @endphp
                                                @endif
                                            @endif
                                            @if($subjectclass->mindiary !='')
                                                @if($student['student_mark_new'][$key]['diary'] < $subjectclass->mindiary)
                                                    @php
                                                        $grade_fail_flag = 1;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach

                                    @if(($student['student_mark_new'][$key]['mark'] >= $result_rule->min_mark) && ($student['student_mark_new'][$key]['mark'] <= $result_rule->max_mark))

                                        @if($grade_fail_flag == 0)
                                            {{$result_rule->name}}
                                        @else
                                            @php
                                                $pass_fail_flag=1
                                            @endphp
                                            <span class="badge bg-danger">FAILED</span>
                                        @endif
                                        
                                        @php
                                            if($result_rule->name == 'F'){
                                                $pass_fail_flag=1;
                                            }   
                                            $gpa = $gpa+$result_rule->gpa;
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
                                $average = $gpa/count($get_student_subject)
                            @endphp       
                            <span>{{number_format((float)$average, 2, '.', '')}} </span>    
                        @else
                            <span>0</span> 
                        @endif
                    </td>
                    <td>
                        @if($pass_fail_flag == 0)
                            @if($gpa==0)
                                <span class="badge bg-warning">Absent</span>
                            @else
                                <span class="badge bg-success">PASS</span>
                            @endif
                        @else
                            <span class="badge bg-danger">FAILED</span> 
                        @endif
                    </td>
                    <td>
                       <a href="javascript:void(0)" class="btn btn-primary btn-sm view-details" data-studentid="{{ $student['user_id'] }}">Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>