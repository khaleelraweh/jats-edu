<?php

namespace App\Models;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class RequestToTeach extends Model
{
    use HasFactory, HasTranslations, HasTranslatableSlug, SearchableTrait;

    protected $guarded = [];

    // for translatable field 
    public $translatable = ['full_name', 'slug'];

    // searchable lab 
    protected $searchable = [
        'columns' => [
            'request_to_teaches.full_name' => 10,
        ]
    ];

    // for slug 
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('full_name')
            ->saveSlugsTo('slug');
    }

    // to make slug unique 
    protected function generateNonUniqueSlug(): string
    {
        $slugField = $this->slugOptions->slugField;
        $slugString = $this->getSlugSourceString();

        $slug = $this->getTranslations($slugField)[$this->getLocale()] ?? null;

        $slugGeneratedFromCallable = is_callable($this->slugOptions->generateSlugFrom);
        $hasCustomSlug = $this->hasCustomSlugBeenUsed() && !empty($slug);
        $hasNonChangedCustomSlug = !$slugGeneratedFromCallable && !empty($slug) && !$this->slugIsBasedOnTitle();

        if ($hasCustomSlug || $hasNonChangedCustomSlug) {
            $slugString = $slug;
        }

        return MySlugHelper::slug($slugString);
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    const NEW_REQUEST = 0;        // when he start the request
    const UNDER_PROCESS = 1;     // When the admin is reviewing the request 
    const ACCEPTED = 2;         // when the admin is accepting
    const REJECTED = 3;         // when admin reject the request


    public function request_status()
    {

        switch ($this->request_status) {
            case 0:
                $result = __('panel.request_new_request');
                break;
            case 1:
                $result = __('panel.request_under_proccess');
                break;
            case 2:
                $result = __('panel.request_accepted');
                break;
            case 3:
                $result = __('panel.request_rejected');
                break;
        }
        return $result;
    }

    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }

    public function educational_qualification()
    {
        if ($this->educational_qualification == 1)
            return __('transf.Diploma');
        else if ($this->educational_qualification == 2)
            return __('transf.Higher Diploma');
        else if ($this->educational_qualification == 3) {
            return __('transf.Bachelor');
        } else if ($this->educational_qualification == 4) {
            return __('transf.Master');
        } else if ($this->educational_qualification == 5) {
            return __('transf.Ph_D');
        } else if ($this->educational_qualification == 6) {
            return __('transf.Professor');
        }
    }

    public function scopeActiveUser($query)
    {
        return $query->whereHas('user', function ($query) {
            $query->whereStatus(1);
        });
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }
}
