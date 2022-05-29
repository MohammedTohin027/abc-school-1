<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeAmount extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function fee_categoy(){
        return $this->belongsTo(StudentFreeCategory::class, 'free_category_id', 'id');
    }

    public function class_name(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
}