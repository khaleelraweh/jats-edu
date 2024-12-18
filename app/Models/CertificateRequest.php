<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class CertificateRequest extends Model
{
    use HasFactory, HasTranslations, SearchableTrait;
    protected $guarded = [];

    public $translatable = ['full_name', 'certificate_name'];

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
    public function identityTtype()
    {
        if ($this->identity_type == 0) {
            return __('panel.identity_type_personal_card');
        } elseif ($this->identity_type == 1) {
            return __('panel.identity_type_passport');
        }
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'sponsor_id', 'id');
    }
}
