<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee2021 extends Model
{
    use HasFactory;
    protected $table = "fees_2021";
    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }
    public function parent(){
        return $this->belongsTo(User::class,'parent_id');
    }
}
