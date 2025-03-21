<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class CompanyRequest extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    // searchable lab 
    protected $searchable = [
        'columns' => [
            'company_requests.cp_user_name' => 10,
            'company_requests.cp_user_email' => 10,
            'company_requests.cp_user_phone' => 10,
            'company_requests.cp_company_name' => 10,
            'company_requests.cp_job_title' => 10,
            'company_requests.cp_company_size' => 10,
            'company_requests.cp_company_country' => 10,
            'company_requests.cp_company_city' => 10,
        ]
    ];

    const NEW_REQUEST = 0;        // when he start the request
    const UNDER_PROCESS = 1;     // When the admin is reviewing the request 
    const ACCEPTED = 2;         // when the admin is accepting
    const REJECTED = 3;         // when admin reject the request



    // public function status()
    // {
    //     return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    // }


    public function status()
    {

        switch ($this->status) {
            case 0:
                $result = __('panel.company_request_new_request');
                break;
            case 1:
                $result = __('panel.company_request_under_proccess');
                break;
            case 2:
                $result = __('panel.company_request_accepted');
                break;
            case 3:
                $result = __('panel.company_request_rejected');
                break;
        }
        return $result;
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
