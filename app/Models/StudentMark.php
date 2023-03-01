<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    use HasFactory;
    protected $table = "student_marks";
    protected $fillable = ['student_id','exam_id','subject_id','mark'];

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
