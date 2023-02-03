<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendence extends Model
{
    use HasFactory;
    protected $table = "student_attendence";
    protected $fillable = ['student_id','attendence_date','status'];
}
