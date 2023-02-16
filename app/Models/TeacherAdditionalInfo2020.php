<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAdditionalInfo2020 extends Model
{
    use HasFactory;
    protected $table = "teacher_additional_info_2020";
    protected $fillable = ['user_id','department_id','designation_id','date_of_birth','blood_id','present_address','office_address','teacher_profile_pic','status'];

    public function getTeacher()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getDepartment()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function teacher_single_attendence()
    {
        return $this->belongsTo(TeacherAttendence::class,'user_id','teacher_id');
    }

    public function teacher_attendence()
    {
        return $this->hasMany(TeacherAttendence::class,'teacher_id','user_id');
    }
    
}
