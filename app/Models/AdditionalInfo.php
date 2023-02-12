<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    use HasFactory;
    protected $table = "parent_additional_info";

    protected $fillable = ['user_id','father_occupation','father_cnic','mother_name','mother_nid','mother_occupation'];

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
