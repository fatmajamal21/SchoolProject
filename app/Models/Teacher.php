<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    static public function get_academic_qualification_code($code)
    {
        if ($code == 'diploma') {
            return ' دبلوم';
        } elseif ($code == 'bachelors') {
            return ' بكالوريوس';
        } elseif ($code == 'master') {
            return ' ماجستير';
        } else {
            return ' دكتوراة';
        }
    }
}
