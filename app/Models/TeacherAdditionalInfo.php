<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAdditionalInfo extends Model
{
    use HasFactory;
    protected $table = "teacher_additional_info";
    protected $fillable = ['department_id','user_id','first_name','last_name','date_of_birth','whatsapp','blood_group','present_address','office_address'];

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
