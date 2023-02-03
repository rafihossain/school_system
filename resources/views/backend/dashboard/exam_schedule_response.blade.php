<div id="AddExamSchedule" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Exam Schedule</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="examSchedule">
                    <div class="mb-2">
                        <label for="recipient-name" class="col-form-label">Exam</label>
                        <select name="exam_id" id="" class="form-control">
                            <option value="">Select Exam</option>
                            @foreach($exam_lists as $exam_list)
                                <option value="{{$exam_list->id}}">{{$exam_list->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger exam_name_error"></span>

                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addExam"> + Add Exam</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="recipient-name" class="col-form-label">Class</label>
                        <select name="class_id" id="class_id" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($classes as $classe)
                                <option value="{{$classe->id}}">{{$classe->class_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger exam_classname_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addExamClass"> + Add Class</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="recipient-name" class="col-form-label">Section</label>
                        <select name="section_id" id="section_id" class="form-control section_name">
                            <option value="">Select Section</option>
                        </select>
                        <span class="text-danger exam_sectionname_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addExamSection"> + Add Section</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="recipient-name" class="col-form-label">Class Room</label>
                        <select name="class_room_id" class="form-control">
                            <option value="">Select Class Room</option>
                            @foreach($classrooms as $class_rooms)
                                <option value="{{$class_rooms->id}}">{{$class_rooms->classroom_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger exam_classroom_name_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addExamclassroom"> + Add Class Room</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="recipient-name" class="col-form-label">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger exam_subject_name_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addExamSubject"> + Add Subject</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="recipient-name" class="col-form-label">Exam Date</label>
                                <input type="date" class="form-control" name="exam_date">
                                <span class="text-danger exam_date_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name" class="col-form-label">Start Time</label>
                                <input type="time" class="form-control" name="start_time">
                                <span class="text-danger start_time_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name" class="col-form-label">End Time</label>
                                <input type="time" class="form-control" name="end_time">
                                <span class="text-danger end_time_error"></span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mt-4 examscheduleinfo">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>