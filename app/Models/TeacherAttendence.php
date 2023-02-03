<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendence extends Model
{
    use HasFactory;
    protected $table = "teacher_attendence";
    protected $fillable = ['teacher_id','attendence_date','status'];
}
