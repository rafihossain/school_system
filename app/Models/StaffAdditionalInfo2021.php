<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAdditionalInfo2021 extends Model
{
    use HasFactory;
    protected $table = "staff_additional_info_2021";
    protected $fillable = ['user_id','first_name','last_name','date_of_birth','whatsapp','blood_group','present_address','permanent_address'];

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
