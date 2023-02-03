<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBasicInfo extends Model
{
    use HasFactory;
    protected $table = "student_basic_info";
    protected $fillable = ['user_id','class_id','section_id','first_name','last_name','date_of_birth','b_form','registration','father_name','father_occupation','father_cnic','mother_name','	mother_language','mother_occupation','guardian_name','guardian_office_address','guardian_office_phone','guardian_mobile_phone','guardian_mobile_whatsapp','guardian_mobile_email','student_profile_pic'];

    
    public function getparentBasicInfo(){
        return $this->belongsTo(AdditionalInfo::class,'parent_id','user_id');
    }

    public function userInfo(){
        return $this->belongsTo(user::class,'parent_id','id');
    }
}
