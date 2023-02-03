<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;
    protected $table = "exam_schedule";
    protected $fillable = ['exam_id','class_id','section_id','class_room_id','subject_id','exam_date','start_time','end_time'];

    public function exam_list()
    {
        return $this->belongsTo(ExamList::class,'exam_id','id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModal::class,'class_id','id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id','id');
    }
    
    public function class_room()
    {
        return $this->belongsTo(Classroom::class,'class_room_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
