<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense2020 extends Model
{
    use HasFactory;

    protected $table = "expenses_2020";
    public function expensetype(){
        return $this->belongsTo(ExpenseType::class,'expensetype_id');
    }
}
