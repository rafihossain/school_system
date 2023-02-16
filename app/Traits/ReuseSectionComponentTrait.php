<?php

namespace App\Traits;

use App\Models\ClassModal;
use App\Models\Classroom;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Image;

trait ReuseSectionComponentTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    protected $Student;
    public function __construct()
    {
        $this->Student = 'App\Models\Student'.Session::get('session_name');
    }

    public function reuse_class($request){
        $request->validate([
            'class_name' => 'required',
            'class_numeric' => 'required',
        ]);
        
        $class = new ClassModal();
        $class->session_id = Session::get('session_id');
        $class->class_name = $request->class_name;
        $class->class_numeric = $request->class_numeric;
        $class->class_status = $request->class_status;
        $class->save();
    }
    public function reuse_section($request){
        $request->validate([
            'class_id' => 'required',
            'section_name' => 'required',
            'section_capacity' => 'required',
        ]);

        $section = new Section();
        $section->class_id = $request->class_id;
        $section->section_name = $request->section_name;
        $section->section_capacity = $request->section_capacity;
        $section->save();
    }
    public function reuse_classroom($request){
        $request->validate([
            'classroom_name' => 'required',
            'classroom_description' => 'required',
        ]);
        $classroom = new Classroom();
        $classroom->classroom_name = $request->classroom_name;
        $classroom->classroom_description = $request->classroom_description;
        $classroom->save();
    }
    protected function feeBasicInfoSave($request, $student){
        $fee = new Fee();
        $fee->student_id = $student->user_id;
        $fee->parent_id = 10;
        $fee->txn_number = Str::random(13);
        $fee->invoice_type = $request->invoice_type;
        $fee->feetype_id = $request->feetype_id;
        $fee->class_id = $request->class_id;
        $fee->section_id = $request->section_id;
        $fee->amount_due = $request->amount_due;
        $fee->due_date = $request->due_date;
        $fee->fee_status = $request->fee_status;
        $fee->fee_description = $request->fee_description;
        $fee->save();
    }
    public function reuse_fee($request){
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
            $students = $this->Student::where(['class_id'=> $request->class_id,'section_id' => $request->section_id])->get();
            // dd($students);
            foreach($students as $student){
                $this->feeBasicInfoSave($request, $student);
            }
        }else{
            $student = $this->Student::where(['class_id'=> $request->class_id,'section_id' => $request->section_id])->first();
            // dd($student);
            $this->feeBasicInfoSave($request, $student);
        }
    }
    protected function feetypeImageUpload($request){
        $feetypeImage = $request->file('feetype_image');
        $image = Image::make($feetypeImage);
        $fileType = $feetypeImage->getClientOriginalExtension();
        $imageName = 'feetype_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/accounting/feetype_image/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageUrl;
    }
    public function reuse_feetype($request){
        $request->validate([
            'feetype_name' => 'required',
            // 'syllabus_image' => 'required|mimes:doc,docx,pdf',
        ]);
        $feeType = new FeeType();
        $feeType->feetype_name = $request->feetype_name;
        $feeType->feetype_image = $this->feetypeImageUpload($request);
        $feeType->save();
    }


}