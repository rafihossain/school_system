<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModal;
use App\Models\ClassRoutine;
use App\Models\ExamList;
use App\Models\Section;
use App\Models\SessionModel;
use App\Models\StaffAdditionalInfo;
use App\Models\ExamSchedule;
use App\Models\TeacherAdditionalInfo;
use App\Models\User;
use DataTables;

class ReportController extends Controller
{
    //Teacher Report------------------------
    public function reportTeacher(Request $request)
    {
        if ($request->ajax()) {
            // dd('hi');

            // $teacher = TeacherAdditionalInfo::with('getTeacher','getDepartment')->get()->toArray();
            $teacher = User::where('user_role', 4)->get()->toArray();
            // dd($teacher);

            return Datatables::of($teacher)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('backend.teacher.view',$row['id']).'" data-id="'.$row['id'].'" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-eye"></i>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.report.teacher.teacher_report');
    }

    public function viewTeacher($id)
    {
        $teacher=TeacherAdditionalInfo::with('getTeacher','getDepartment')->where('id',$id)->first();

        return view('backend.report.teacher.teacher_view',compact('teacher'));
    }

    //Student Report-----------------
    public function reportStudent()
    {
        $classes=ClassModal::all();
        return view('backend.report.student.student_report',compact('classes'));
    }

    public function get_student_report(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
        ]);

        $students=Student::with('getStudent','getParent')
                        ->where('class_id',$request->class_id)
                        ->where('section_id',$request->section_id)
                        ->get();

    //    dd($students);
       return view('backend.report.student.report_data',compact('students'));
    }

    public function viewStudent($id)
    {
        $student=Student::with('getParent')->where('id',$id)->first();
        //dd($student);
        return view('backend.report.student.student_view',compact('student'));
    }

    //Staff Report------------------
    public function reportStaff(Request $request)
    {
        if ($request->ajax()) {
            $staff=User::where('user_role', 7)->get();
            // $staff=StaffAdditionalInfo::with('getUser')->get();
            return Datatables::of($staff)->addIndexColumn()
                ->addColumn('action', function($row){
                  
                    $btn = '<a href="'.route('backend.staff.view',$row['id']).'" data-id="'.$row['id'].'" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-eye"></i>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.report.staff.staff_report');
    }

    public function viewStaff($id)
    {
        $staff=StaffAdditionalInfo::with('getUser')->where('id',$id)->first();
        //dd($student);
        return view('backend.report.staff.staff_view',compact('staff'));
    }

    public function reportExamRoutine()
    {
        $exam_lists=ExamList::all();
        $sessions=SessionModel::all();
        $classes=ClassModal::all();
        //$sections=Section::all();
        return view('backend.report.exam_routine.exam_routine',compact('exam_lists','classes', 'sessions'));
    }

    public function get_report_exam_routine(Request $request)
    {
        $exam_id=$request->exam_id;
        $class_id=$request->class_id;
        $section_id=$request->section_id;
        $session_id=$request->session_id;
        $exam_routines=ExamSchedule::where(['exam_id'=>$exam_id,'class_id'=>$class_id,'section_id'=>$section_id])->get();

        return view('backend.report.exam_routine.exam_routine_data',compact('exam_routines'));
    }

    //class routine
    public function classroutine_report_list(){
        $classroutines = ClassRoutine::with('subject','teacher','room')->get();
        $classes = ClassModal::get();
        $sessions = SessionModel::get();
        // dd($subjects);
        return view('backend.report.class_routine.manage_routine_class', [
            'classes' => $classes,
            'sessions' => $sessions,
            'classroutines' => $classroutines,
        ]);
    }
    public function show_class_info(Request $request){
        $sessions = ClassModal::where('session_id', $request->session_id)->get();
        return response()->json($sessions);
    }
    public function routine_report_list(Request $request){

        $classroutines = ClassRoutine::with('subject','teacher','room')
                                    ->where([
                                        'class_id'=> $request->class_id,
                                        'section_id' => $request->section_id,
                                        'session_id' => $request->session_id,
                                    ])->get();

        // dd($classroutines);
        
        $trainerName = [];
        foreach($classroutines as $key => $routine)
        {
            $trainerName[] = [
                'title'=> 'Subject: '.$routine->subject->subject_name.', Room: '.$routine->room->classroom_name.', Teacher: '.$routine->teacher->name,
                'daysOfWeek'=>[$routine->day_id],
                'startTime'=>$routine->start_time,
                'endTime'=>$routine->end_time,
                'color'=>'purple'
            ];
        }

        echo json_encode($trainerName);
    }
    
    
    //Student Attendence Report-------------
    public function student_attendence()
    {
        $sessions = SessionModel::all();
        $classes = ClassModal::all();
        return view('backend.report.student_attendence.student_attendence_report', [
            'classes' => $classes,
            'sessions' => $sessions,
        ]);
    }

    public function get_student_attendence_report(Request $request)
    {
        $class_id = $request->class_id;
        $section_id = $request->section_id;

        if($request->select_type == 'date'){
            $attendence_date=$request->date_data;
            $students=Student::with(['student_single_attendence' => function($q) use ($attendence_date){
                $q->where('attendence_date',$attendence_date);
              }])->where(['class_id'=>$class_id,'section_id'=>$section_id])->get();
            return view('backend.report.student_attendence.student_atttendence_day_data',compact('students'));
        }
        else{
            $days=cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($request->date_data_month)),date('Y',strtotime($request->date_data_month)));
            $attendence_date=$request->date_data_month;
            $students=Student::with(['student_attendence' => function($q) use ($attendence_date){
                $q->whereYear('attendence_date','=',date('Y',strtotime($attendence_date)))
                ->whereMonth('attendence_date','=',date('m',strtotime($attendence_date)));
              }])->where(['class_id'=>$class_id,'section_id'=>$section_id])->get();
             
            return view('backend.report.student_attendence.student_atttendence_monthly_data',compact('students','days'));
        }
    }

    //Teacher Attendence Report---------------

    public function teacher_attendence()
    {
        return view('backend.report.teacher_attendence.teacher_attendence_report');
    }

    public function get_teacher_attendence_report(Request $request)
    {
        // dd(11);

        if($request->select_type == 'date'){
            $attendence_date=$request->date_data;
            
            $teachers = User::where('user_role', 6)
            ->with(['teacher_single_attendence' => function($q) use ($attendence_date){
                 $q->where('attendence_date',$attendence_date);
            }])->get();
            // dd('hi');
            
            // $teachers=TeacherAdditionalInfo::with(['teacher_single_attendence' => function($q) use ($attendence_date){
            //     $q->where('attendence_date',$attendence_date);
            //   }])->get();
            return view('backend.report.teacher_attendence.teacher_atttendence_day_data',compact('teachers'));
        }else{
            $days=cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($request->date_data_month)),date('Y',strtotime($request->date_data_month)));
            $attendence_date=$request->date_data_month;
       
            $teachers=TeacherAdditionalInfo::with(['teacher_attendence' => function($q) use ($attendence_date){
                $q->whereYear('attendence_date','=',date('Y',strtotime($attendence_date)))
                ->whereMonth('attendence_date','=',date('m',strtotime($attendence_date)));
              }])->get();

            return view('backend.report.teacher_attendence.teacher_atttendence_monthly_data',compact('teachers','days'));
        }
    }
}
