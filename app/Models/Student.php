<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];
    function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
