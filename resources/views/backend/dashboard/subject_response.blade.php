<div id="AddSubject" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Subject</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSubject">
                    <div class="mb-2">
                        <label>Class Name</label>
                        <select name="class_id" id="getSection" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger routine_subject_classname_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill AddSubjectClass"> + Add Class</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Subject Name</label>
                        <input type="text" class="form-control" name="subject_name">
                        <span class="text-danger routine_subjectname_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Subject Code</label>
                        <input type="text" class="form-control" name="subject_code">
                        <span class="text-danger routine_subject_code_error"></span>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary AddSubjectSubmit" type="button"> Add Subject </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>