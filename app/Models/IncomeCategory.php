<?php

namespace App\Models;

use App\Models\Income;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function incomes() {
        return $this->hasMany(Income::class,'category_id', 'id');
    }
}