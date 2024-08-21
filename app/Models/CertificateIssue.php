<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class CertificateIssue extends Model
{
    use HasFactory, HasTranslations, SearchableTrait;

    protected $guarded = [];

    // for translatable field 
    public $translatable = ['stud_certificate_name', 'stud_full_name'];


    // searchable lab 
    protected $searchable = [
        'columns' => [
            'courses.stud_certificate_name' => 10,
        ]
    ];


    const UNDER_REVIEW = 0;        // when he start the course
    const UNDER_TREATMENT = 1;  //  under_treatment
    const RELEASED = 2;     //  released
    const REJECTED = 3;         // rejected


    public function certificateStatus()
    {

        switch ($this->stud_certificate_status) {
            case 0:
                $result = __('panel.under_review');
                break;
            case 1:
                $result = __('panel.under_treatment');
                break;
            case 2:
                $result = __('panel.released');
                break;
            case 3:
                $result = __('panel.rejected');
                break;
        }
        return $result;
    }

    public function statusWithLabel()
    {

        switch ($this->stud_certificate_status) {
            case 0:
                $result = '<label class="badge bg-success text-white p-2">' .  __('panel.under_review')  . '</label>';
                break;
            case 1:
                $result = '<label class="badge bg-secondary text-light p-2">' . __('panel.under_treatment') . '</label>';
                break;
            case 2:
                $result = '<label class="badge bg-warning text-dark p-2">' .  __('panel.released') . '</label>';
                break;
            case 3:
                $result = '<label class="badge bg-primary text-light p-2">' . __('panel.rejected') . '</label>';
                break;
        }
        return $result;
    }


    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }


    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }
}
