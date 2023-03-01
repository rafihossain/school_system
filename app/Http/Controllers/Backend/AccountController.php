<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModal;
use App\Models\ClassRoutine;
use App\Models\ExpenseType;
use App\Models\FeeType;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    protected $Fee;
    protected $students;
    protected $Expense;
    public function __construct()
    {
        $this->students = 'students_'.Session::get('session_name');
        $this->Fee = 'App\Models\Fee'.Session::get('session_name');
        $this->Expense = 'App\Models\Expense'.Session::get('session_name');
    }

    //feetype
    public function manage_feetype(Request $request){
        //dd($syllabus);

        if ($request->ajax()) {
            $feetypes = FeeType::all();

            return Datatables::of($feetypes)->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<a href="javascript:void(0)" class="viewfeetype_image" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#feetypeimage-modal"><img src="'.URL::to("/").'/images/accounting/feetype_image/thumbnail/'.$row->feetype_image.'" width="100px" height="100px"></a></a>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a type="button" data-id="' . $row->id . '" class="btn btn-sm btn-primary waves-effect waves-light feetype_edit" data-bs-toggle="modal" data-bs-target="#updatefeetype-modal"><i class="mdi mdi-square-edit-outline"></i></a>
                    <a type="button" data-id="' . $row->id . '" class="btn btn-sm btn-danger waves-effect waves-light feetype_delete"><i class="mdi mdi-trash-can-outline"></i></a>';
                    return $btn;
                })
                ->rawColumns(['photo','action'])
                ->make(true);
        }

        return view('backend.accounting.manage_feetype');
    }
    public function add_feetype(){
        return view('backend.accounting.add_feetype');
    }
    protected function feetypeImageUpload($request){
        $feetypeImage = $request->file('feetype_image');
        $image = Image::make($feetypeImage);
        $fileType = $feetypeImage->getClientOriginalExtension();
        $imageName = 'feetype_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/accounting/feetype_image/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        $thumbnail = $directory . "thumbnail/" . $imageName;
        $image->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnail);

        return $imageName;
    }
    public function save_feetype(Request $request){

        $request->validate([
            'feetype_name' => 'required',
            // 'syllabus_image' => 'required|mimes:doc,docx,pdf',
        ]);
        $feeType = new FeeType();
        $feeType->feetype_name = $request->feetype_name;
        $feeType->feetype_image = $this->feetypeImageUpload($request);
        $feeType->save();

        return response()->json(['success'=> 'Feetype has been added successfully !!']);
    }
    public function edit_feetype(Request $request){
        $feetype = FeeType::find($request->id);
        return response()->json($feetype);
    }
    public function view_feetype_image(Request $request){
        $feetype = FeeType::find($request->id);
        return response()->json($feetype);
    }
    public function feetypeBasicInfo($request, $feeType, $imageUrl = null){
        $feeType->feetype_name = $request->feetype_name;

        if($imageUrl !=''){
            $feeType->feetype_image = $imageUrl;
        }
        
        $feeType->save();
    }
    public function update_feetype(Request $request){

        $request->validate([
            'feetype_name' => 'required',
            // 'syllabus_image' => 'required|mimes:doc,docx,pdf',
        ]);

        $feetypeImage = $request->file('feetype_image');
        $feeType = FeeType::find($request->id);

        if($feetypeImage){
            if (File::exists($feeType->feetype_image)) {
                unlink($feeType->feetype_image);
            }
            $imageUrl = $this->feetypeImageUpload($request, $request->id);
            $this->feetypeBasicInfo($request, $feeType, $imageUrl);
        }else{
            $this->feetypeBasicInfo($request, $feeType);
        }

        return response()->json(['success'=> 'Feetype has been updated successfully !!']);
    }
    public function delete_feetype(Request $request){
        FeeType::find($request->id)->delete();
        return response()->json(['success'=> 'Feetype has been deleted successfully !!']);
    }
    //free
    public function manage_fee(){
        $classes = ClassModal::get();
        $feetypes = FeeType::get();
        return view('backend.accounting.fees.manage_fee',[
            'classes' => $classes,
            'feetypes' => $feetypes,
        ]);
    }
    public function add_fee(){
        $feetypes = FeeType::get();
        $classes = ClassModal::get();
        $sections = Section::get();
        // dd($subjects);
        return view('backend.accounting.fees.add_fee', [
            'classes' => $classes,
            'sections' => $sections,
            'feetypes' => $feetypes,
        ]);
    }

    protected function feeBasicInfoSave($request, $student){

        $fee = new $this->Fee();
        $fee->student_id = $student->user_id;
        $fee->txn_number = Str::random(13);
        $fee->invoice_type = $request->invoice_type;
        $fee->feetype_id = $request->feetype_id;
        $fee->class_id = $request->class_id;
        $fee->section_id = $request->section_id;
        
        if($request->invoiceType == 2){
            $fee->subject_id = $request->subject_id;
        }

        $fee->amount_due = $request->amount_due;
        $fee->due_date = $request->due_date;
        $fee->fee_status = $request->fee_status;
        $fee->fee_description = $request->fee_description;
        $fee->save();

    }

    public function save_fee(Request $request){

        $request->validate([
            'feetype_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'amount_due' => 'required',
            'due_date' => 'required',
            'fee_description' => 'required',
        ]);

        $invoiceType = $request->invoice_type;
        
        if($invoiceType == 1){
            $students = DB::table($this->students)->where([
                'class_id'=> $request->class_id,
                'section_id' => $request->section_id
            ])->get();
            // dd($students);
            foreach($students as $student){
                $this->feeBasicInfoSave($request, $student);
            }
        }else{
            $student = DB::table($this->students)->where([
                'class_id'=> $request->class_id,
                'section_id' => $request->section_id
            ])->first();
            // dd($student);
            $this->feeBasicInfoSave($request, $student);
        }

        return redirect()->route('backend.manage-fee')->with('success', 'Fee has been added successfully !!');
    }
    public function edit_fee($id){
        $fee = $this->Fee::find($id);

        $feetypes = FeeType::get();
        $classes = ClassModal::get();
        $sections = Section::get();

        return view('backend.accounting.fees.edit_fee', [
            'fee' => $fee,
            'classes' => $classes,
            'sections' => $sections,
            'feetypes' => $feetypes,
        ]);
    }
    public function feeBasicInfo($request, $fee){

        // dd($_POST);

        $fee->feetype_id = $request->feetype_id;
        $fee->class_id = $request->class_id;
        $fee->section_id = $request->section_id;
        $fee->amount_due = $request->amount_due;
        $fee->due_date = $request->due_date;
        $fee->fee_description = $request->fee_description;
        $fee->save();
    }
    public function update_fee(Request $request){

        $request->validate([
            'feetype_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'amount_due' => 'required',
            'due_date' => 'required',
            'fee_description' => 'required',
        ]);

        $fee = $this->Fee::find($request->id);
        $this->feeBasicInfo($request, $fee);

        return redirect()->route('backend.manage-fee')->with('success', 'Fee has been updated successfully !!');
    }
    public function delete_fee(Request $request){
        // dd($request->delete_id);
        $this->Fee::find($request->delete_id)->delete();
        echo 1;
    }

    protected function fee_list_basic_info($request, $fees){
        $feetype = FeeType::find($request->feetype_id);
        $class = ClassModal::find($request->class_id);
        $section = Section::find($request->section_id);

        $html = '';
        $html .= '<div class="col-md-4 m-auto bg-dark p-2 text-center rounded"><h4 class="text-white">Fee Information</h4><h5 class="text-white">Fee Type: '.$feetype->feetype_name.'</h5><p class="text-white">Class: '.$class->class_name.'</p><p class="text-white">Section: '.$section->section_name.'</p>';

        if($request->fee_status == 1){
            $html .='<p class="text-white">Status: Paid</p>';
        }else{
            $html .='<p class="text-white">Status: Unpaid</p>';
        }
        $html .='</div>';
        

        $html .='<div class="card mt-3"><div class="card-header border-bottom bg-white pb-0 ps-2"><h4 class="card-title">Fee</h4></div><div class="card-body p-0"><table class="table"><thead class="bg-light"><tr><th>User Information</th><th>Transaction No</th><th>Amount</th><th>Due Date</th><th>Pay Date</th><th>Action</th></tr></thead><tbody>';

        foreach($fees as $fee) :
            $action = '';
            if($fee->fee_status == 1){
                $action = '<td><a href="'.route('backend.delete-fee').'" id="delete" class="btn btn-sm btn-danger" data-id="'.$fee->id.'">Delete</a></td>';
            }else{
                $action = '<td><a href="'.route('backend.delete-fee', ['id'=>$fee->id]).'" class="btn btn-sm btn-success me-2 mark_paid" data-id="'.$fee->id.'">Mark as Paid</a><a href="'.route('backend.edit-fee', ['id'=>$fee->id]).'" class="btn btn-sm btn-primary me-2 fee_edit" data-id="'.$fee->id.'">Edit</a><a href="javascript:void(0)" id="delete" class="btn btn-sm btn-danger me-2 fee_delete" data-id="'.$fee->id.'">Delete</a></td>';
            }

            $student = DB::table($this->students)->where('user_id', $fee->student_id)->first();
            $parent = User::find($student->parent_id);

            $html .='<tr class="row_'.$fee->id.'"><td>Student: '.$fee->student->name.' <br> Parent: '.$parent->name.'</td><td>'.$fee->txn_number.'</td><td>'.$fee->amount_due.'</td><td>'.date('F d, Y', strtotime($fee->amount_due)).'</td><td>-</td>'.$action.'</tr>';
        endforeach;

        return $html .= '</tbody></table></div></div>';

    }

    public function get_fees_list(Request $request){

        $fees = $this->Fee::with('student')->where([
            'class_id'=> $request->class_id,
            'section_id' => $request->section_id,
            'feetype_id' => $request->feetype_id,
            'fee_status' => $request->fee_status,
        ])->get();

        // dd($fees);

        if(is_object(@$fees) && @$fees->count() > 0) {
            $html = $this->fee_list_basic_info($request, $fees);
            echo $html;
        } else {
            echo '<span class="text-danger"> No data found </span>';
        }
    }

    public function set_fee_mark_paid(Request $request){
        $fee = $this->Fee::find($request->fee_id);
        $fee->fee_status = 1;
        $fee->save();
        echo 1;
    }
    
    //expense-type
    public function manage_expense_type(Request $request){

        if ($request->ajax()) {
            $expensetypes = ExpenseType::get();

            return Datatables::of($expensetypes)->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<a href="javascript:void(0)" class="viewexpensetype_image" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#expensetypeimage-modal"><img src="'.URL::to("/").'/images/expanse_image/thumbnail/'.$row->expense_image.'" width="100px" height="100px"></a></a>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a type="button" data-id="' . $row->id . '" class="btn btn-sm btn-primary waves-effect waves-light expensetype_edit" data-bs-toggle="modal" data-bs-target="#updateexpensetype-modal"><i class="mdi mdi-square-edit-outline"></i></a>
                    <a type="button" data-id="' . $row->id . '" class="btn btn-sm btn-danger waves-effect waves-light expensetype_delete"><i class="mdi mdi-trash-can-outline"></i></a>';
                    return $btn;
                })
                ->rawColumns(['photo','action'])
                ->make(true);
        }
        return view('backend.accounting.expense-type.manage_expense_type');
    }
    // public function add_expense_type(){
    //     return view('backend.accounting.expense-type.add_expense_type');
    // }
    protected function expenseTypeImageUpload($request){
        $expanseImage = $request->file('expense_image');
        $image = Image::make($expanseImage);
        $fileType = $expanseImage->getClientOriginalExtension();
        $imageName = 'expanse_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/expanse_image/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        $thumbnail = $directory . "thumbnail/" . $imageName;
        $image->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnail);

        return $imageName;
    }
    public function save_expense_type(Request $request){

        $request->validate([
            'expense_name' => 'required',
            'expense_image' => 'required',
            // 'syllabus_image' => 'required|mimes:doc,docx,pdf',
        ]);

        $expenseType = new ExpenseType();
        $expenseType->expense_name = $request->expense_name;
        $expenseType->expense_image = $this->expenseTypeImageUpload($request);
        $expenseType->save();

        return response()->json(['success'=> 'Expense type has been added successfully !!']);
    }
    public function edit_expense_type(Request $request){
        $expensetype = ExpenseType::find($request->id);
        return response()->json($expensetype);
    }
    public function view_expensetype_image(Request $request){
        $expensetype = ExpenseType::find($request->id);
        return response()->json($expensetype);
    }
    public function expenseTypeBasicInfo($request, $expenseType, $imageUrl = null){
        $expenseType->expense_name = $request->expense_name;

        if($imageUrl !=''){
            $expenseType->expense_image = $imageUrl;
        }
        
        $expenseType->save();
    }
    public function update_expense_type(Request $request){

        $request->validate([
            'expense_name' => 'required',
            // 'syllabus_image' => 'required|mimes:doc,docx,pdf',
        ]);

        $expenseImage = $request->file('expense_image');
        $expenseType = ExpenseType::find($request->id);

        if($expenseImage){
            if (File::exists($expenseType->expense_image)) {
                unlink($expenseType->expense_image);
            }
            $imageUrl = $this->expenseTypeImageUpload($request);
            $this->expenseTypeBasicInfo($request, $expenseType, $imageUrl);
        }else{
            $this->expenseTypeBasicInfo($request, $expenseType);
        }
        return response()->json(['success'=> 'Expense type has been updated successfully !!']);
    }
    public function delete_expense_type(Request $request){
        ExpenseType::find($request->id)->delete();
        return response()->json(['success'=> 'Expense type has been deleted successfully !!']);
    }

    //expense
    public function manage_expense(Request $request){
        $expensetypes = ExpenseType::all();
        if ($request->ajax()) {
            $expenses = $this->Expense::with('expensetype')->get();

            return Datatables::of($expenses)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a type="button" data-id="' . $row->id . '" class="btn btn-sm btn-primary waves-effect waves-light expense_edit" data-bs-toggle="modal" data-bs-target="#updateexpense-modal"><i class="mdi mdi-square-edit-outline"></i></a>
                    <a type="button" data-id="' . $row->id . '" class="btn btn-sm btn-danger waves-effect waves-light expense_delete"><i class="mdi mdi-trash-can-outline"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.accounting.expense.manage_expense', [
            'expensetypes' => $expensetypes
        ]);
    }
    // public function add_expense(){
    //     $expensetypes = ExpenseType::get();
    //     return view('backend.accounting.expense.add_expense', [
    //         'expensetypes' => $expensetypes
    //     ]);
    // }
    public function save_expense(Request $request){

        $request->validate([
            'expensetype_id' => 'required',
            'expense_ammount' => 'required',
            'expense_description' => 'required',
        ]);

        $expense = new $this->Expense();
        $expense->expensetype_id = $request->expensetype_id;
        $expense->expense_ammount = $request->expense_ammount;
        $expense->expense_description = $request->expense_description;
        $expense->save();

        return response()->json(['success'=> 'Expense has been added successfully !!']);
    }
    public function edit_expense(Request $request){
        $expense = $this->Expense::find($request->id);
        return response()->json($expense);
    }
    public function update_expense(Request $request){

        $request->validate([
            'expensetype_id' => 'required',
            'expense_ammount' => 'required',
            'expense_description' => 'required',
        ]);

        $expense = $this->Expense::find($request->id);
        $expense->expensetype_id = $request->expensetype_id;
        $expense->expense_ammount = $request->expense_ammount;
        $expense->expense_description = $request->expense_description;
        $expense->save();

        return response()->json(['success'=> 'Expense has been updated successfully !!']);
    }
    public function delete_expense(Request $request){
        $this->Expense::find($request->id)->delete();
        return response()->json(['success'=> 'Expense has been deleted successfully !!']);
    }

    

}
