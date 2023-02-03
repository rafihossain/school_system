<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamList extends Model
{
    use HasFactory;
    protected $table = "exam_list";
    protected $fillable = ['name','start_date','end_date','note'];
}
