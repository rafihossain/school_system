<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDocumentChecklist extends Model
{
    use HasFactory;
    protected $table = "student_document_checklist";
    protected $fillable = ['user_id','attested_passport_size_photograph','attested_national_id_card','attested_all_certificate','attested_relevent_document','migration_certificate_different_board','previous_school_leaving_certificate','b_from_goverment'];
}
