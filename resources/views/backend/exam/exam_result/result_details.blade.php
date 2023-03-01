<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-bordered dt-responsive nowrap">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Theory</th>
                    <th>Practical</th>
                    <th>City Exam</th>
                    <th>Diary</th>
                    <th>Total</th>
                    <th>Grade</th>
                    <th>Gpa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($studentmarks as $studentmark)
                @php
                    $gpa=0;
                    $pass_fail_flag=0;
                @endphp
                <tr>
                    <td>{{ $studentmark->subject->subject_name }}</td>
                    <td>{{ $studentmark->theory_mark }}</td>
                    <td>{{ $studentmark->practical_mark }}</td>
                    <td>{{ $studentmark->city_exam_mark }}</td>
                    <td>{{ $studentmark->diary }}</td>
                    <td>{{ $studentmark->mark }}</td>
                    <td>
                        @foreach($result_rules as $result_rule)
                            {{-- 100 >= 80 && 100 <= 100 --}}
                            @if(($studentmark->mark >= $result_rule->min_mark) && ($studentmark->mark <= $result_rule->max_mark))
                                {{ $result_rule->name }}
                                @php
                                    if($result_rule->name == 'F'){
                                        $pass_fail_flag=1;
                                    }
                                $gpa = $gpa+$result_rule->gpa;
                                @endphp
                            @endif
                        @endforeach
                    </td>
                    <td>
                       @if($pass_fail_flag == 0)
                            <span>{{number_format((float)$gpa, 2, '.', '')}} </span>    
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>