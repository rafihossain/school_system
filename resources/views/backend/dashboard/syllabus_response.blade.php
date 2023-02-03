<div id="addSyllabus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Create Syllabus</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSyllabus">
                    <div class="mb-2">
                        <label class="form-label">Syllabus Title</label>
                        <input type="text" class="form-control" name="syllabus_title">
                        <span class="text-danger syllabus_title_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Class Name</label>
                        <select name="class_id" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger syllabus_class_name_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addSyllabusClass"> + Add Class</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Section Name</label>
                        <select name="section_id" class="form-control">
                            <option value="">Select Section</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger syllabus_section_name_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addSyllabusSection"> + Add Section</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Subject Name</label>
                        <select name="subject_id" class="form-control">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger syllabus_subject_name_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addSyllabusSubject"> + Add Subject</button>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Upload Syllabus</label>
                        <input type="file" class="dropify" id="syllabusImage" name="syllabus_image[]" multiple>
                        <span class="text-danger syllabus_image_error"></span>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary" id="submitSyllabus"> Add Submit </button>
                    </div>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    $('.dropify').dropify();
</script>