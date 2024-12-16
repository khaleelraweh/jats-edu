<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Certifications extends Model
{
    use HasFactory, HasTranslations, SearchableTrait;
    protected $guarded = [];

    public $translatable = ['full_name'];

    protected $searchable = [
        'columns' => [

            'certifications.full_name' => 10,
        ]
    ];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function sponser()
    {
        return $this->belongsTo(Sponser::class, 'sponser_id', 'id');
    }
}
