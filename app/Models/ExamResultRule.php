<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResultRule extends Model
{
    use HasFactory;
    protected $table = "exam_result_rules";
    protected $fillable = ['class_id','name','gpa','min_mark','max_mark'];

    public function class()
    {
        return $this->belongsTo(ClassModal::class,'class_id','id');
    }


}
