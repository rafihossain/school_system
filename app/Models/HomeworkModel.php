<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkModel extends Model
{
    use HasFactory;
    protected $table = "homeworks";
    protected $fillable = ['title','teacher_id','class_id','section_id','subject_id','start_date','end_date','description'];

    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }

}
