<?php

namespace App\Models;

class SchoolGrade extends BaseModel
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'stage_id',
        'description',
        'priority',
    ];
}
