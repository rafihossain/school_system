<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = "subjects";
    protected $fillable = ['section_id','class_id','subject_name','subject_code'];

    public function student_mark_new()
    {
        return $this->belongsTo(StudentMark::class,'subject_id','id');
    }
}
