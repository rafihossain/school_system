<li>
    <a href="{{route('backend.dashboard')}}">
        <i class="fas fa-home"></i>
        <span>Dashboard</span>
    </a>
</li>
<li>
    <a href="#attendance" data-bs-toggle="collapse">
        <i class="mdi mdi-book-open-outline mdi-18px"></i>
        <span>Attendance</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="attendance">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('backend.attendence.student') }}">Student Attendance</a>
            </li>
            <li>
                <a href="{{ route('backend.attendence.teacher') }}">Teacher Attendance</a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="#users" data-bs-toggle="collapse">
        <i class="mdi mdi-account-multiple-outline mdi-18px"></i>
        <span> Users </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="users">
        <ul class="nav-second-level">
            <li>
                <a href="{{route('backend.student.index')}}">Students</a>
            </li>
            <li>
                <a href="{{route('backend.parents.index')}}">Parents</a>
            </li>
            <li>
                <a href="{{route('backend.teacher.index')}}">Teacher</a>
            </li>
            <li>
                <a href="{{route('backend.staff.index')}}">Staff</a>
            </li>
            <li>
                <a href="{{route('backend.manage-operator')}}">Operator</a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="#academic" data-bs-toggle="collapse">
        <i class="mdi mdi-book-open-blank-variant mdi-18px"></i>
        <span>Academic</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="academic">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('backend.manage-session') }}">Sessions</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-class') }}">Class</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-section') }}">Sections</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-classroom') }}">ClassRoom</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-subject') }}">Subject</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-class-routine') }}">Class Routine</a>
            </li>
            <li>
                <a href="{{ route('backend.add-subject-class') }}">Associate Subject with Class</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-class-teacher') }}">Assign Class Teacher</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-homework') }}">Homework</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-designation') }}">Designations</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-department') }}">Department</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-syllabus') }}">Syllabus</a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#exam" data-bs-toggle="collapse">
        <i class="mdi mdi-circle-edit-outline mdi-18px"></i>
        <span>Exam</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="exam">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('backend.exam.list') }}">Exam List</a>
            </li>
            <li>
                <a href="{{ route('backend.schedule.index') }}">Schedule</a>
            </li>
            <li>
                <a href="{{ route('backend.mark.index') }}">Mark</a>
            </li>
            <li>
                <a href="{{ route('backend.result_rule.index') }}">Ressult Rule</a>
            </li>
            <li>
                <a href="{{ route('backend.exam.result') }}">Exam Ressult</a>
            </li>
            <li>
                <a href="{{ route('backend.exam.promotion') }}">Promotion</a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="#accounting" data-bs-toggle="collapse">
        <i class="mdi mdi-calculator-variant-outline mdi-18px"></i>
        <span>Accounting</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="accounting">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('backend.manage-feetype') }}">Free Type</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-fee') }}">Fees</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-expense-type') }}">Expense Type</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-expense') }}">Expense List</a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="#report" data-bs-toggle="collapse">
        <i class="mdi mdi-clipboard-edit-outline mdi-18px"></i>
        <span>Report</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="report">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('backend.report.student') }}">Student</a>
            </li>
            <li>
                <a href="{{ route('backend.report.teacher') }}">Teacher</a>
            </li>
            <li>
                <a href="{{ route('backend.report.staff') }}">Staff</a>
            </li>
            <li>
                <a href="{{ route('backend.classroutine-report-list') }}">Class Routine</a>
            </li>
            <li>
                <a href="{{ route('backend.report.exam_routine') }}">Exam Routine</a>
            </li>
            <li>
                <a href="{{ route('backend.report.student_attendence') }}">Student Attendance</a>
            </li>
            <li>
                <a href="{{ route('backend.report.teacher_attendence') }}">Teacher Attendance</a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="#announcement" data-bs-toggle="collapse">
        <i class="mdi mdi-bell-outline mdi-18px"></i>
        <span>Announcement</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="announcement">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('backend.manage-message') }}">Message</a>
            </li>
            <li>
                <a href="{{ route('backend.manage-calender') }}">Calender</a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="{{ route('backend.system-setting-list') }}">
        <i class="mdi mdi-cog-outline mdi-18px"></i>
        <span>Setting</span>
    </a>
</li>