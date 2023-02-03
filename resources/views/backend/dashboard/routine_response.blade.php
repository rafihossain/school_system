<div id="createRoutineModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="routineFrom">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Create Routine</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Class</label>
                        <select name="class_id" id="class_id" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger routine_class_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addRoutineClass"> + Add Class</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Section</label>
                        <select name="section_id" class="form-control section_name">
                            <option value="">Select Section</option>
                        </select>
                        <span class="text-danger routine_section_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addRoutineSection"> + Add Section</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Subject</label>
                        <select name="subject_id" class="form-control subject">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger routine_subject_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addRoutineSubject"> + Add Subject</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Class Room</label>
                        <select name="classroom_id" class="form-control class_room">
                            <option value="">Select Classroom</option>
                            @foreach($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->classroom_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger routine_classroom_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addClassroomClass"> + Add Classroom</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Teacher</label>
                        <select name="teacher_id" class="form-control teacher">
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger routine_teacher_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addRoutineTeacher"> + Add Teacher</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Day</label>
                        <select name="day_id" class="form-control day">
                            <option value="">Select Day</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                            <option value="7">Sunday</option>
                        </select>
                        <span class="text-danger routine_day_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label>Start Time</label>
                                <input type="time" class="form-control start_time" name="start_time" value="09:00">
                                <span class="text-danger routine_starttime_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label>End Time</label>
                                <input type="time" class="form-control end_time" name="end_time" value="10:00">
                                <span class="text-danger routine_endtime_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary saveroutineinfo">Save</button>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>