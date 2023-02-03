<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamList;
use App\Models\ClassModal;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\ExamSchedule;
use App\Models\StudentMark;
use App\Models\ExamResultRule;
use App\Models\SessionModel;
use Illuminate\Support\Facades\Session;
use DataTables;
use DB;

class ExamController extends Controller
{
    public function examValidation($request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'note' => 'required'
        ]);
    }

    public function examList(Request $request)
    {
        if ($request->ajax()) {
            $exam = ExamList::all();
            return Datatables::of($exam)->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a type="button" data-id="' . $row['id'] . '" class="btn btn-sm btn-primary waves-effect waves-light exam_edit" data-bs-toggle="modal" data-bs-target="#standard-edit"><i class="mdi mdi-square-edit-outline"></i></a>
                    <a type="button" data-id="' . $row['id'] . '" id="delete" class="btn btn-sm btn-danger waves-effect waves-light exam_delete"><i class="mdi mdi-trash-can-outline"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.exam.examList');
    }

    public function createExam(Request $request)
    {
        $this->examValidation($request);
        if (strtotime($request->start_date) > strtotime($request->end_date)) {
            return response()->json([
                'date_validate' => 'End date can not grater than start date'
            ]);
        }

        $exam = ExamList::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Exam Successfully Inserted!',
        ]);
    }

    public function editExam(Request $request)
    {
        $exam_edit = ExamList::find($request->id);
        return response()->json($exam_edit);
    }

    public function updateExam(Request $request)
    {
        $this->examValidation($request);
        if (strtotime($request->start_date) > strtotime($request->end_date)) {
            return response()->json([
                'date_validate' => 'End date can not grater than start date'
            ]);
        }

        $ExamList = ExamList::find($request->exam_id);
        $ExamList->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Exam Successfully Updated!',
        ]);
    }

    public function deleteExam(Request $request)
    {
        $ExamList = ExamList::find($request->id);
        $ExamList->delete();
        return response()->json([
            'success' => true,
            'message' => 'Exam Successfully Delete!',
        ]);
    }

    //Exam Schedule
    public function scheduleIndex(Request $request)
    {
        $exam_lists = ExamList::all();
        return view('backend.schedule.scheduleList', compact('exam_lists'));
    }

    public function scheduleCreate()
    {
        $exam_lists = ExamList::all();
        $classes = ClassModal::all();
        $class_room = Classroom::all();
        return view('backend.schedule.scheduleCreate', compact('exam_lists', 'classes', 'class_room'));
    }

    public function get_section_subject(Request $request)
    {
        $class_id = $request->class_id;
        $sectons = Section::where('class_id', $class_id)->get();
        $subjects = Subject::where('class_id', $class_id)->get();
        $output = '';
        $output_new = '';
        if (count($sectons) > 0) {
            $output = '<option value="">Select Section</option>';
            foreach ($sectons as $row) {
                $output .= '<option class="list-group-item" value="' . $row->id . '">' . $row->section_name . '</option>';
            }
        } else {
            $output .= '<option class="list-group-item">' . 'No Data Found' . '</option>';
        }

        if (count($subjects) > 0) {
            $output_new = '<option value="">Select Subject</option>';
            foreach ($subjects as $row) {
                $output_new .= '<option class="list-group-item" value="' . $row->id . '">' . $row->subject_name . '</option>';
            }
        } else {
            $output_new .= '<option class="list-group-item">' . 'No Data Found' . '</option>';
        }
        $data['sectons'] = $output;
        $data['subjects'] = $output_new;
        // dd($data);
        return $data;
    }

    public function examScheduleValidation($request)
    {
        $request->validate([
            'exam_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'class_room_id' => 'required',
            'subject_id' => 'required',
            'exam_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
    }

    public function scheduleSave(Request $request)
    {
        $this->examScheduleValidation($request);
        ExamSchedule::create($request->all());

        return redirect()->route('backend.schedule.index')->with('success', 'Successfully Exam Schedule Created!');
    }

    public function getExam(Request $request)
    {
        $exam_id = $request->exam_id;

        $exam_schedule = ExamSchedule::with('exam_list', 'class', 'section', 'class_room', 'subject')->where('exam_id', $exam_id)->get();

        if (is_object(@$exam_schedule) && @$exam_schedule->count() > 0) {
            $unique = collect($exam_schedule)->map(fn ($i) => $i->class_id)->unique()->sort();
            //dd($unique);
            //$weekday = ['Monday','Tuesday','Wednesday','Thursday','Friday', 'Saturday', 'Sunday'];
            foreach ($unique as $row) {
                $class_name[] = ClassModal::where('id', $row)->pluck('class_name')->first();;
            }

            $i = 0;
            $html = '';
            $j = 1;
            foreach ($unique as $n => $each) :

                $html .= '<div class="card mt-3"><div class="card-header border-bottom bg-white pb-0 ps-2"><h4 class="card-title">' . $class_name[$i++] . '</h4></div><div class="card-body p-0"><table class="table"><thead class="bg-light"><tr><th>SI</th><th>Exam</th><th>Room</th><th>Subject</th><th>Section</th><th>Time</th><th>Action</th></tr></thead><tbody>';

                foreach ($exam_schedule as $key => $exam_schedules) :
                    if ($exam_schedules->class_id == $each) {
                        $html .= '<tr><td>' . $j++ . '</td><td>' . $exam_schedules->exam_list->name . '</td><td>' . $exam_schedules->class_room->classroom_name . '</td><td>' . $exam_schedules->subject->subject_name . '</td><td>' . $exam_schedules->section->section_name . '</td><td>' . date('F d, Y', strtotime($exam_schedules->exam_date)) . '<br>' . $exam_schedules->start_time . '-' . $exam_schedules->end_time . '</td><td><a href="' . route('backend.schedule.edit', $exam_schedules->id) . '" class="btn btn-sm btn-success"><i class="mdi mdi-file-edit-outline"></i></a><a href="' . route('backend.schedule.delete', $exam_schedules->id) . '" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a></td></tr>';
                    } else {
                        $j = 1;
                    }
                endforeach;

                $html .= '</tbody></table></div></div>';

            endforeach;

            return $html;
        } else {
            echo '<span class="text-danger"> No data found </span>';
        }
    }

    public function scheduleEdit($id)
    {
        $edit_exam_list = ExamSchedule::find($id);
        $exam_lists = ExamList::all();
        $classes = ClassModal::all();
        $class_room = Classroom::all();
        $sections = Section::where('class_id', $edit_exam_list->class_id)->get();
        $subjects = Subject::where('class_id', $edit_exam_list->class_id)->get();

        return view('backend.schedule.scheduleEdit', compact('exam_lists', 'classes', 'class_room', 'edit_exam_list', 'sections', 'subjects'));
    }

    public function scheduleUpdate(Request $request)
    {
        $this->examScheduleValidation($request);
        $ExamSchedule = ExamSchedule::find($request->exam_schedule_id);
        $ExamSchedule->update($request->all());

        return redirect()->route('backend.schedule.index')->with('success', 'Successfully Exam Schedule Updated!');
    }

    public function scheduleDelete($id)
    {
        $ExamSchedule = ExamSchedule::find($id);
        $ExamSchedule->delete();

        return redirect()->route('backend.schedule.index')->with('success', 'Successfully Exam Schedule Deleted!');
    }

    //Mark-----------------
    public function markIndex()
    {
        $exam_lists = ExamList::all();
        $classes = ClassModal::all();
        $sections = Section::all();
        $subjects = Subject::all();
        return view('backend.exam.mark.markList', compact('exam_lists', 'classes', 'sections', 'subjects'));
    }

    public function get_student_mark(Request $request)
    {
        $exam_id = $request->exam_id;
        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $subject_id = $request->subject_id;

        $stdent_marks = Student::with('getStudent', 'class', 'section')->with(['student_mark' => function ($q) use ($subject_id, $exam_id) {
            $q->where('subject_id', $subject_id)->where('exam_id', $exam_id);
        }])->where('class_id', $class_id)->where('section_id', $section_id)->get();

        $get_student_subject = Subject::where('class_id', $class_id)->where('id', $subject_id)->get();
        //dd($get_student_subject);
        $html = '';
        if (!$get_student_subject->isEmpty()) {
            if (count($stdent_marks) > 0) {
                $html .= '<div class="card mt-3"><div class="card-header border-bottom bg-white pb-0 ps-2"></div><div class="card-body p-0"><form id="save_student_mark"><table class="table"><thead class="bg-light"><tr><th>Name</th><th>Roll</th><th>Class</th><th>Section</th><th>Mark</th></tr></thead><tbody>';
                $marks = '';
                foreach ($stdent_marks as $n => $stdent_mark) :
                    if ($stdent_mark->student_mark != null) {
                        $marks = $stdent_mark->student_mark->mark;
                    }

                    $html .= '<tr><td>' . $stdent_mark->getStudent->name . '</td><td>' . $stdent_mark->roll_no . '</td><td>' . $stdent_mark->class->class_name . '</td><td>' . $stdent_mark->section->section_name . '</td><td>' . '<input type="number" name="mark[]" class="form-control" value="' . $marks . '"><input type="hidden" name="exam_id[]" class="form-control" value="' . $exam_id . '"><input type="hidden" name="subject_id[]" class="form-control" value="' . $subject_id . '"><input type="hidden" name="student_id[]" class="form-control" value="' . $stdent_mark->user_id . '">' . '</td></tr>';
                endforeach;

                $html .= '</tbody></table></form><button type="button" class="btn btn-primary m-2 save_student_mark">Save Mark</button></div></div>';
                return $html;
            } else {
                echo '<span class="text-danger"> No data found </span>';
            }
        } else {
            echo '<span class="text-danger"> No data found </span>';
        }
    }

    public function save_student_mark(Request $request)
    {
        $marks = $request->mark;
        $exam_id = $request->exam_id;
        $subject_id = $request->subject_id;
        $student_ids = $request->student_id;

        //dd($request->all());
        foreach ($student_ids as $key => $studentId) {
            $check = StudentMark::where('student_id', $studentId)->where('exam_id', $exam_id[$key])->where('subject_id', $subject_id[$key])->get();

            if ($check->isEmpty()) {

                StudentMark::create([
                    'student_id' => $studentId,
                    'exam_id' => $exam_id[$key],
                    'subject_id' => $subject_id[$key],
                    'mark' => $marks[$key]
                ]);
            } else {
                DB::table('student_marks')->where('student_id', $studentId)->where('exam_id', $exam_id[$key])->where('subject_id', $subject_id[$key])->update(['mark' => $marks[$key]]);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }

    //Result Rule-------------------
    public function resultRuleIndex(Request $request)
    {
        if ($request->ajax()) {
            $exam_result_rule = ExamResultRule::all();
            return Datatables::of($exam_result_rule)->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a type="button" data-id="' . $row['id'] . '" class="btn btn-sm btn-primary waves-effect waves-light exam_result_rule_edit" data-bs-toggle="modal" data-bs-target="#standard-edit"><i class="mdi mdi-square-edit-outline"></i></a>
                    <a type="button" data-id="' . $row['id'] . '" id="delete" class="btn btn-sm btn-danger waves-effect waves-light exam_result_rule_delete"><i class="mdi mdi-trash-can-outline"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.exam.resultRule.index');
    }

    public function examResultRuleValidation($request)
    {
        $request->validate([
            'name' => 'required',
            'gpa' => 'required',
            'min_mark' => 'required',
            'max_mark' => 'required'
        ]);
    }

    public function save_exam_result_rule(Request $request)
    {
        $this->examResultRuleValidation($request);
        ExamResultRule::create($request->all());

        return response()->json([
            'success' => true
        ]);
    }

    public function edit_exam_result_rule(Request $request)
    {
        $exam_result_rule_edit = ExamResultRule::find($request->id);
        return response()->json($exam_result_rule_edit);
    }

    public function update_exam_result_rule(Request $request)
    {
        //dd($request->all());
        $this->examResultRuleValidation($request);
        $ExamResultRule = ExamResultRule::find($request->exam_result_rule_id);
        $ExamResultRule->update($request->all());

        return response()->json([
            'success' => true
        ]);
    }

    public function delete_exam_result_rule(Request $request)
    {
        $ExamResultRule = ExamResultRule::find($request->id);
        $ExamResultRule->delete();

        return response()->json([
            'success' => true
        ]);
    }

    //Exam Result-------------
    public function examResult()
    {
        $exam_lists = ExamList::all();
        $classes = ClassModal::all();
        $sections = Section::all();

        return view('backend.exam.exam_result.index', compact('exam_lists', 'classes', 'sections'));
    }

    public function get_student_exam_result(Request $request)
    {
        $exam_id = $request->exam_id;
        $class_id = $request->class_id;
        $section_id = $request->section_id;

        $students = Student::with('getSubject', 'getStudent')
                            ->with(['studentMark_new' => function ($q) use ($exam_id) {
                                $q->where('exam_id', $exam_id)->orderBy('subject_id', 'asc');
                            }])
                            ->where('class_id', $class_id)
                            ->where('section_id', $section_id)
                            ->get()
                            ->toArray();

        $get_student_subject = Subject::where('class_id', $request->class_id)
                                        ->orderBy('id', 'asc')
                                        ->get()
                                        ->toArray();
        $result_rules = ExamResultRule::all();

        return view('backend.exam.exam_result.student_exam_result', compact('get_student_subject', 'students', 'result_rules'));
    }


    public function examPromotion()
    {
        $sessions = SessionModel::get();
        $classes = ClassModal::get();
        return view('backend.exam.promotion.index', [
            'classes' => $classes,
            'sessions' => $sessions,
        ]);
    }
}
