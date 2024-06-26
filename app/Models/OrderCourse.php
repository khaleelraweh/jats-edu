<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCourse extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'order_course';

    public $timestamps = false;
    public $incrementing = false;
}
