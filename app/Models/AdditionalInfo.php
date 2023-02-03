<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    use HasFactory;
    protected $table = "parent_additional_info";
    protected $fillable = ['user_id','first_name','last_name','date_of_birth','spouse_name','spouse_occupation','occupation','whatsapp','blood_group','present_address','office_address'];
    //protected $hidden = ['created_at','updated_at'];

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
