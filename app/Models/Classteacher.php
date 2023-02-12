<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classteacher extends Model
{
    use HasFactory;

    protected $fillable = ['class_id','section_id','teacher_id'];

    public function class(){
        return $this->belongsTo(ClassModal::class,'class_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id');
    }
}
