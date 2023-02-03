<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends Model
{
    use HasFactory;

    public function class(){
        return $this->belongsTo(ClassModal::class,'class_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id');
    }
    public function room(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }

}
