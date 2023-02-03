<div class="table-responsive">
    <h4>Attendence</h4>
    <form id="save_teacher_attendance">
        <table class="table table-bordered table-bordered dt-responsive nowrap">
            <thead>
                <tr>
                    <th>IMAGE</th>
                    <th>NAME</th>
                    <th>Attendence</th>
                    <th>PREVIOUS 7 DAYS STATUS</th>
                </tr>
            </thead>
            <tbody>
                <input type="hidden" name="attendence_date" value="{{$attendence_date}}">
                @foreach($teachers as $teacher)
                <tr>
                    <td><img src="{{ asset('/images/default.png') }}" height="50" alt=""></td>
                    <td>{{$teacher->getTeacher->name}}</td>
                    <td>
                        <input type="hidden" name="teacher_id[]" value="{{$teacher->user_id}}">
                        <div class="d-flex">
                            <div class="form-check me-2">
                                <input type="radio" class="form-check-input" name="status_{{$teacher->user_id}}" value="present" 
                                @isset($teacher->teacher_single_attendence)
                                    {{$teacher->teacher_single_attendence->status == 'present' ? 'checked' : ''}}
                                @endisset> Present
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status_{{$teacher->user_id}}" value="absent"
                                @isset($teacher->teacher_single_attendence)
                                    {{ $teacher->teacher_single_attendence->status == 'absent' ? 'checked' : '' }}
                                @endisset> Absent
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2 h4">
                        @if(!$teacher->teacher_attendence->isEmpty())
                            @foreach($teacher->teacher_attendence as $teacher_attendence)
                                @if($teacher_attendence->status == 'present')
                                    <div class="div">
                                        <span class="">{{date('d',strtotime($teacher_attendence->attendence_date))}}</span><br>
                                        <span class="mdi mdi-check text-success"></span>
                                    </div>
                                @else
                                <div class="div">
                                    <span class="">{{date('d',strtotime($teacher_attendence->attendence_date))}}</span><br>
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
        <button type="button" class="btn btn-primary save_teacher_attendance">Save All</button>
    </form>
</div>