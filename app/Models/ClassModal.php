<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModal extends Model
{
    use HasFactory;
    protected $table = "classes";
    protected $fillable = ['session_id','class_name','class_numeric','class_status'];
    
    public function session(){
        return $this->belongsTo(SessionModel::class,'session_id');
    }
}
