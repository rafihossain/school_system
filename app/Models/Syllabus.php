<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    use HasFactory;

    protected $table = "syllabus";

    public function class(){
        return $this->belongsTo(ClassModal::class,'class_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
}
