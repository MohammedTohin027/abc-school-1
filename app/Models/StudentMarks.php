<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentMarks extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function student_class(){
        return $this->BelongsTo(StudentClass::class, 'class_id', 'id');
    }
    public function year(){
        return $this->BelongsTo(Year::class, 'year_id', 'id');
    }
    public function assign_subject(){
        return $this->BelongsTo(AssignSubject::class, 'assign_subject_id', 'id');
    }
    public function exam_type(){
        return $this->BelongsTo(ExanType::class, 'exam_type_id', 'id');
    }
}
