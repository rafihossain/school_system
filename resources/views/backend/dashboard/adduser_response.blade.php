<div id="addUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Users</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="user_items d-flex gap-2">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="1" id="user1"
                        {{ $checked == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="user1">Parents</label>
                    </div>

                    <div class="form-check mb-2 form-check-success">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="2" id="user2"
                        {{ $checked == 2 ? 'checked' : '' }}>
                        <label class="form-check-label" for="user2">Students</label>
                    </div>

                    <div class="form-check mb-2 form-check-info">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="3" id="user3"
                        {{ $checked == 3 ? 'checked' : '' }}>
                        <label class="form-check-label" for="user3">Teacher</label>
                    </div>

                    <div class="form-check mb-2 form-check-danger">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="4" id="user4"
                        {{ $checked == 4 ? 'checked' : '' }}>
                        <label class="form-check-label" for="user4">Staff</label>
                    </div>

                    <div class="form-check mb-2 form-check-danger">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="5" id="user5"
                        {{ $checked == 5 ? 'checked' : '' }}>
                        <label class="form-check-label" for="user5">Operator</label>
                    </div>
                </div>
                <div id="parent_content">
                    <form id="add_parent">
                        <div class="mb-2">
                            <label class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            <span class="text-danger parent_name_error"></span>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Email">
                            <span class="text-danger parent_email_error"></span>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password">
                            <span class="text-danger parent_password_error"></span>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Phone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                            <span class="text-danger parent_phone_error"></span>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Gender<span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                </label>
                            </div>
                            <span class="text-danger parent_gender_error"></span>
                        </div>
                        <div class="mb-2 mt-4">
                            <button type="button" class="btn btn-primary parentinfosave">Save</button>
                        </div>
                    </form>
                </div>
                <div id="student_content">
                    <form id="add_student">
                        <div class="justify-content-center">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="Student">
                                    <span class="text-danger student_name_error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" placeholder="Enter Email" value="student@gmail.com">
                                    <span class="text-danger student_email_error"></span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password" value="12345678">
                                    <span class="text-danger student_password_error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Parent<span class="text-danger">*</span></label>
                                    <input type="text" name="" id="parents_id" class="form-control" autocomplete="off">
                                    <input type="hidden" name="parent_id" id="parents_id_hidden" class="form-control" autocomplete="off" value="">
                                    <div id="parent_list"></div>
                                    <span class="text-danger student_parent_error"></span>
                                    <div class="mt-2">
                                        <button type="button" class="btn badge bg-primary rounded-pill show_addParent"> + Add Parent</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Class<span class="text-danger">*</span></label>
                                    <select name="class_id" id="class_id" class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger student_class_error"></span>

                                    <div class="mt-2">
                                        <button type="button" class="btn badge bg-primary rounded-pill addClass_student"> + Add Class</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Section<span class="text-danger">*</span></label>
                                    <select name="section_id" class="form-control section_name">
                                        <option value="">Select Section</option>
                                    </select>
                                    <span class="text-danger student_section_error"></span>
                                    <div class="mt-2">
                                        <button type="button" class="btn badge bg-primary rounded-pill addSectionStudent"> + Add Section </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Department<span class="text-danger">*</span></label>
                                    <select class="form-control" name="department_id" id="">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                    </select>
                                    <span class="text-danger student_department_error"></span>
                                    <div class="mt-2">
                                        <button type="button" class="btn badge bg-primary rounded-pill addDepartmentStudent"> + Add Department </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Admission Date<span class="text-danger">*</span></label>
                                    <input type="date" name="admission_date" id="" class="form-control" value="{{ date('Y-m-d') }}">
                                    <span class="text-danger admission_date_error"></span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Roll No.<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Roll No" name="roll_no" value="24567">
                                    <span class="text-danger student_rollno_error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gender<span class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Female
                                        </label>
                                    </div>
                                    <span class="text-danger gender_error"></span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="button" class="btn btn-primary studentinfosave">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="teachers_content">
                    <form id="add_teacher">
                        <div class="mb-2">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            <span class="text-danger teacher_name_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Email">
                            <span class="text-danger teacher_email_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password">
                            <span class="text-danger teacher_password_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Phone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                            <span class="text-danger teacher_phone_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Gender<span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                </label>
                            </div>
                            <span class="text-danger teacher_gender_error"></span>
                        </div>
                        <div class="mt-4">
                            <button type="button" class="btn btn-primary teacherinfosave">Save</button>
                        </div>
                    </form>
                </div>
                <div id="staff_content">
                    <form id="add_staff">
                        <div class="mb-2">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            <span class="text-danger staff_name_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Email">
                            <span class="text-danger staff_email_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password">
                            <span class="text-danger staff_password_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Phone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                            <span class="text-danger staff_phone_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Gender<span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                </label>
                            </div>
                            <span class="text-danger staff_gender_error"></span>
                        </div>
                        <div class="mt-4">
                            <button type="button" class="btn btn-primary staffinfosave">Save</button>
                        </div>
                    </form>
                </div>
                <div id="operator_content">
                    <form id="add_operator">
                        <div class="mb-2">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            <span class="text-danger operator_name_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Email">
                            <span class="text-danger operator_email_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password">
                            <span class="text-danger operator_password_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Phone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                            <span class="text-danger operator_phone_error"></span>
                        </div>
                        <div class="mb-2">
                            <label>Gender<span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                </label>
                            </div>
                            <span class="text-danger operator_gender_error"></span>
                        </div>
                        <div class="mt-4">
                            <button type="button" class="btn btn-primary operatorinfosave">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>