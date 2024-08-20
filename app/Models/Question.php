<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];


    // public function getQuestionTypeAttribute($value)
    // {
    //     return $value == 1 ? 'single_choice' : 'multiple_choice';
    // }

    public function question_type()
    {
        if ($this->question_type == 0)
            return __('panel.single_choice');
        else if ($this->question_type == 1)
            return __('panel.multiple_choice');
    }



    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }


    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }
}
