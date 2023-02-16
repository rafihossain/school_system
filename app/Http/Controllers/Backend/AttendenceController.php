<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModal;
use App\Models\Student;
use App\Models\StudentAttendence;
use App\Models\TeacherAttendence;
use App\Models\TeacherAdditionalInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AttendenceController extends Controller
{
    protected $Student;
    public function __construct()
    {
        $this->Student = 'App\Models\Student'.Session::get('session_name');
    }

    public function studentAttendence()
    {
        $classes = ClassModal::all();
        return view('backend.attendence.student.student_attendence', compact('classes'));
    }

    public function get_student_attendence_list(Request $request)
    {
        // echo 11; die();

        $attendence_date = $request->attendence_date;
        $newDate = date('Y-m-d', strtotime($attendence_date . ' - 6 days'));
        $class_id = $request->class_id;
        $section_id = $request->section_id;

        $students = $this->Student::with(['student_single_attendence' => function ($q) use ($attendence_date, $newDate) {
            $q->where('attendence_date', $attendence_date);
        }])->with(['student_attendence' => function ($q) use ($attendence_date, $newDate) {
            $q->where('attendence_date', '<=', $attendence_date)->where('attendence_date', '>=', $newDate)->orderBy('attendence_date', 'asc');
        }])->where(['class_id' => $class_id, 'section_id' => $section_id])->get();
        
        // dd($students);


        return view('backend.attendence.student.student_attendence_list_data', compact('students', 'attendence_date'));
    }

    public function save_student_attendance(Request $request)
    {
        // dd(11);

        $array = $request->all();
        foreach ($array['student_id'] as $student_id) {
            $present = $array['status_' . $student_id];
            $check = StudentAttendence::where('student_id', $student_id)
                                        ->where('attendence_date', $request->attendence_date)
                                        ->first();

            if (is_null($check)) {
                StudentAttendence::create([
                    'student_id' => $student_id,
                    'attendence_date' => $request->attendence_date,
                    'status' => $present,
                ]);
            } else {
                DB::table('student_attendence')
                    ->where('student_id', $student_id)
                    ->where('attendence_date', $request->attendence_date)
                    ->update(['status' => $present]);
            }
        }
        return response()->json([
            'success' => true
        ]);
    }

    public function teacherAttendence()
    {
        return view('backend.attendence.teacher.teacher_attendence');
    }

    public function get_teacher_attendence_list(Request $request)
    {
        $attendence_date = $request->attendence_date;
        $newDate = date('Y-m-d', strtotime($attendence_date . ' - 6 days'));

        $teachers =  User::where('user_role', 6)->with(
            ['teacher_single_attendence' => function ($q) use ($attendence_date, $newDate) {
                $q->where('attendence_date', $attendence_date);
            }])
            ->with([
                'teacher_attendence' => function ($q) use ($attendence_date, $newDate) {
                $q->where('attendence_date', '<=', $attendence_date)
                ->where('attendence_date', '>=', $newDate)
                ->orderBy('attendence_date', 'asc');
            }])->get();

        return view('backend.attendence.teacher.teacher_attendence_list_data', compact('teachers', 'attendence_date'));
    }

    public function save_teacher_attendance(Request $request)
    {

        $array = $request->all();
        foreach ($array['teacher_id'] as $teacher_id) {
            $present = $array['status_' . $teacher_id];
            $check = TeacherAttendence::where('teacher_id', $teacher_id)->where('attendence_date', $request->attendence_date)->first();

            if (is_null($check)) {
                TeacherAttendence::create([
                    'teacher_id' => $teacher_id,
                    'attendence_date' => $request->attendence_date,
                    'status' => $present,
                ]);
            } else {
                DB::table('teacher_attendence')
                    ->where('teacher_id', $teacher_id)
                    ->where('attendence_date', $request->attendence_date)
                    ->update(['status' => $present]);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }
}
