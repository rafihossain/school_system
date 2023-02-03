<div id="addClass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Class</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formClass">
                    <div class="mb-2">
                        <label>Class Name</label>
                        <input type="text" class="form-control class_name" name="class_name">
                        <span class="text-danger class_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Class Numeric</label>
                        <input type="input" class="form-control class_numeric" name="class_numeric">
                        <span class="text-danger class_numeric_error"></span>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="class_status" value="0">
                        <input type="checkbox" class="form-check-input" id="customSwitch1" name="class_status" value="1">
                        <label class="form-check-label" for="customSwitch1">Active</label>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary submitClass"> Add Class </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>