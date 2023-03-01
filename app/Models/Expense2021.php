<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense2021 extends Model
{
    use HasFactory;

    protected $table = "expenses_2021";
    public function expensetype(){
        return $this->belongsTo(ExpenseType::class,'expensetype_id');
    }
}
