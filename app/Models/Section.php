<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['section_name','section_capacity','class_id'];

    public function class(){
        return $this->belongsTo(ClassModal::class,'class_id');
    }
}
