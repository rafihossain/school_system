<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Student2021 extends Model
{
    use HasFactory;

    protected $table = "students_2021";

    protected $fillable = ['user_id','department_id','section_id','class_id','parent_id','roll_no','admission_date'];

    public function getStudent()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function getStudentBasicInfo()
    {
        return $this->belongsTo(StudentBasicInfo::class,'user_id','user_id');
    }
    public function getStdAdditionalInfo()
    {
        return $this->belongsTo(StudentAdditionalInfo::class,'user_id','user_id');
    }
    public function class()
    {
        return $this->belongsTo(ClassModal::class,'class_id','id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id','id');
    }
    public function student_mark()
    {
        return $this->belongsTo(StudentMark::class,'user_id','student_id');
    }

    public function getSubject()
    {
        return $this->hasMany(Subject::class,'class_id','class_id');
    }

    public function studentMark_new()
    {
        return $this->hasMany(StudentMark::class,'student_id','user_id');
    }

    public function getParent()
    {
        return $this->belongsTo(User::class,'parent_id','id');
    }
    public function getClass()
    {
        return $this->belongsTo(ClassModal::class,'class_id','id');
    }
    public function getSection()
    {
        return $this->belongsTo(Section::class,'section_id','id');
    }

    public function student_single_attendence()
    {
        return $this->belongsTo(StudentAttendence::class,'user_id','student_id');
    }

    public function student_attendence()
    {
        return $this->hasMany(StudentAttendence::class,'student_id','user_id');
    }

    public function get_student()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function getparentBasicInfo(){
        return $this->belongsTo(AdditionalInfo::class,'parent_id', 'user_id');
    }

    public function session(){
        return $this->belongsTo(SessionModel::class,'session_id');
    }
}
