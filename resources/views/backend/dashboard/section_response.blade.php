<div id="addSection" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Section</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSection">
                    <div class="mb-2">
                        <label>Class Name</label>
                        <select name="class_id" class="form-control">
                            <option value="">Select Name</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger class_name_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill addSectionClass"> + Add Class</button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Section Name</label>
                        <input type="text" class="form-control" name="section_name">
                        <span class="text-danger section_name_error"></span>
                    </div>
                    <div class="mb-2">
                        <label>Section Capacity</label>
                        <input type="number" class="form-control" name="section_capacity">
                        <span class="text-danger section_capacity_error"></span>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary submitSection" type="button"> Add Section </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>