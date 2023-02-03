<div id="addFee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Fee</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="feeFrom">
                    <div class="mb-2">
                        <label class="form-label">Invoice Type</label>
                        <select name="invoice_type" class="form-control invoice_type">
                            <option value="1">Bulk</option>
                            <option value="2">Individual</option>
                        </select>
                        <span class="text-danger fee_invoicetype_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Fee Type</label>
                        <select name="feetype_id" class="form-control">
                            <option value="">Select Type</option>
                            @foreach($feetypes as $feetype)
                                <option value="{{ $feetype->id }}">{{ $feetype->feetype_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger fee_feetype_error"></span>
                        <div class="mt-2">
                            <button type="button" class="btn badge bg-primary rounded-pill Addfeetype"> + Add Fee Type</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Class</label>
                                <select name="class_id" id="class_id" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger fee_class_error"></span>
                                <div class="mt-2">
                                    <button type="button" class="btn badge bg-primary rounded-pill AddfeeClass"> + Add Class</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Section</label>
                                <select name="section_id" id="section_id" class="form-control section_name">
                                    <option value="">Select Section</option>
                                </select>
                                <span class="text-danger fee_section_error"></span>
                                <div class="mt-2">
                                    <button type="button" class="btn badge bg-primary rounded-pill AddfeeSection"> + Add Section</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 show_subject d-none">
                        <label class="form-label">Subject</label>
                        <select name="subject_id" id="subjectInfo" class="form-control">
                            <option value="">Select Subject</option>
                        </select>
                        <span class="text-danger fee_subject_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Amount Due</label>
                                <input type="number" class="form-control" name="amount_due">
                                <span class="text-danger fee_amountdue_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Due Date</label>
                                <input type="date" class="form-control" name="due_date">
                                <span class="text-danger fee_duedate_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label class="form-label">Status</label>
                        </div>
                        <div class="mb-2">
                            <label class="form-check form-check-inline">
                                <input type="radio" name="fee_status" class="form-check-input" value="1">
                                <span class="form-check-label">Paid</span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input type="radio" name="fee_status" class="form-check-input" value="2">
                                <span class="form-check-label">Unpaid</span>
                            </label>
                        </div>
                        <span class="text-danger fee_status_error"></span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Description</label>
                        <textarea name="fee_description" id="" class="form-control"></textarea>
                        <span class="text-danger fee_description_error"></span>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary savefeebasicinfo"> Submit </button>
                    </div>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>