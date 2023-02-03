<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAdditionalInfo extends Model
{
    use HasFactory;
    protected $table = "student_additional_info";
    protected $fillable = ['user_id','residential_address','student_phone','student_mobile','student_whatsapp','religion','nationality','domicile','blood_group','medical_history','	special_instruction','admission_cancel_date','transport_required','free_student','status'];
}
