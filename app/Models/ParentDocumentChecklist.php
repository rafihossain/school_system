<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentDocumentChecklist extends Model
{
    use HasFactory;
    protected $table = "parent_document_checklist";
    protected $fillable = ['user_id','attested_passport_size_photograph','attested_national_id_card'];
}
