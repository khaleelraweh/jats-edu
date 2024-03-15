<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class CourseReview extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [

            'course_reviews.name' => 10,
            'course_reviews.email' => 10,
            'course_reviews.title' => 10,
            'course_reviews.message' => 10,
        ]
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function status(): string
    {
        return $this->status ? 'مفعل' : 'غير مفعل';
    }
}
