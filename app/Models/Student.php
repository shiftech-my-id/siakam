<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends BaseModel
{
    protected $timestamp = false;
    use HasFactory;

    protected $fillable = [
        'nisn',
        'fullname',
        'grade_id',
        'stage_id',
        'gender',
        'active',
    ];

    public function grade()
    {
        return $this->belongsTo(SchoolGrade::class);
    }

    public function stage()
    {
        return $this->belongsTo(SchoolStage::class);
    }
}
