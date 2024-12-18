<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSponsor extends Model
{
    use HasFactory;

    protected $table = 'course_sponsor';

    protected $fillable = [
        'course_id',
        'sponsor_id',
        'certificate_cost',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'sponsor_id');
    }
}
