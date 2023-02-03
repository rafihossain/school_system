<div class=" table-responsive">
    <h4>Attendence</h4>
    <form id="save_student_attendance">
        <table class="table table-bordered table-bordered dt-responsive nowrap">
            <thead>
                <tr>
                    <th>IMAGE</th>
                    <th>NAME</th>
                    <th>ROLL NUMBER</th>
                    <th>STATUS</th>
                    <th>PREVIOUS 7 DAYS STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <input type="hidden" name="attendence_date" value="{{$attendence_date}}">
                <tr>
                    <td><img src="{{ asset('/images/default.png') }}" height="50" alt=""></td>
                    <td>{{$student->getStudent->name}}</td>
                    <td>{{$student->roll_no}}</td>
                    <td>
                        <input type="hidden" name="student_id[]" value="{{$student->user_id}}">
                        <div class="d-flex">
                            <div class="form-check me-2">
                                <input type="radio" class="form-check-input" name="status_{{$student->user_id}}" value="present" 
                                @isset($student->student_single_attendence)
                                    {{$student->student_single_attendence->status == 'present' ? 'checked' : ''}}
                                @endisset> Present
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status_{{$student->user_id}}" value="absent"
                                @isset($student->student_single_attendence)
                                    {{ $student->student_single_attendence->status == 'absent' ? 'checked' : '' }}
                                @endisset> Absent
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2 h4">
                        @if(!$student->student_attendence->isEmpty())
                                @foreach($student->student_attendence as $student_attendence)
                                @if($student_attendence->status == 'present')
                                    <div class="div">
                                        <span class="">{{date('d',strtotime($student_attendence->attendence_date))}}</span><br>
                                        <span class="mdi mdi-check text-success"></span>
                                    </div>
                                @else
                                    <div class="div">
                                    <span class="">{{date('d',strtotime($student_attendence->attendence_date))}}</span><br>
                                    <span class="mdi mdi-close text-danger"></span>
                                    </div>  
                                @endif
                                @endforeach
                        @endif
                        </div>  
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-primary save_student_attendance">Save All</button>
    </form>
</div>