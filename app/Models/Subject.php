<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'titel',
        'book',
        'teacher_id',
        'grade_id',
    ];

    // علاقة المادة بالمرحلة الدراسية
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    // علاقة المادة بالمعلم
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
