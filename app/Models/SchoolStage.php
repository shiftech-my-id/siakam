<?php

namespace App\Models;

class SchoolStage extends  BaseModel
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'priority',
    ];
}
