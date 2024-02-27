<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class CardCode extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'card_codes.code' => 10,
        ]
    ];

    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }


    public function code_type()
    {
        //            code type ?              1               :              0
        return $this->code_type ? __('panel.cc_Indirect_code') : __('panel.cc_direct_code');
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function scopeActiveProduct($query)
    {
        return $query->whereHas('product', function ($query) {
            $query->whereStatus(1);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }



    public function scopeCardCategory($query)
    {
        return $query->whereHas('product', function ($query) {
            $query->whereHas('category', function ($query) {
                $query->whereSection(2);
            });
        });
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
