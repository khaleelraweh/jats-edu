<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstPageVisit extends Model
{
    use HasFactory;
    protected $fillable = ['page', 'views', 'visited_at'];
}
