<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function courseSection()
    {
        return $this->belongsTo(CourseSection::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function studentEvaluations()
    {
        return $this->hasMany(StudentEvaluation::class);
    }
}
