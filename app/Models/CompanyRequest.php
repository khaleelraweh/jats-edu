<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class CompanyRequest extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    // searchable lab 
    protected $searchable = [
        'columns' => [
            'company_requests.full_name' => 10,
        ]
    ];

    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }
}
