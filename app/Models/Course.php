<?php

namespace App\Models;

use App\Helper\MySlugHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
// use Illuminate\Foundation\Auth\User;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Course extends Model

{
    use HasFactory, HasTranslations, HasTranslatableSlug, SearchableTrait;

    protected $guarded = [];

    // for translatable field 
    public $translatable = ['title', 'subtitle', 'slug', 'description'];


    // searchable lab 
    protected $searchable = [
        'columns' => [
            'courses.title' => 10,
        ]
    ];

    // for slug 
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
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


    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }

    public function certificate()
    {
        return $this->status ? __('panel.certificate_yes') : __('panel.certificate_no');
    }

    public function language()
    {
        if ($this->language == 1)
            return __('panel.language_ar');
        else if ($this->language == 2)
            return __('panel.language_en');
        else {
            return __('panel.language_ar');
        }
    }

    public function skill_level()
    {
        if ($this->skill_level == 1)
            return __('panel.skill_level_beginner');
        else if ($this->skill_level == 2)
            return __('panel.skill_level_intermediate');
        else if ($this->skill_level == 3) {
            return __('panel.skill_level_advance');
        }
    }

    public function featured()
    {
        return $this->featured ? __('panel.yes') : __('panel.no');
    }

    public function scopeFeatured($query)
    {
        return $query->whereFeatured(true);
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function scopeHasQuantity($query)
    {
        return $query->where('quantity', '>=', -1);
    }

    public function scopeActiveCourseCategory($query)
    {
        return $query->whereHas('courseCategory', function ($query) {
            $query->whereStatus(1);
        });
    }


    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');
    }


    public function firstMedia(): MorphOne
    {
        return $this->MorphOne(Photo::class, 'imageable')->orderBy('file_sort', 'asc');
    }

    public function lastMedia(): MorphOne
    {
        return $this->MorphOne(Photo::class, 'imageable')->orderBy('file_sort', 'desc');
    }

    // one product may have more than one photo
    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // public function reviews(): HasMany
    // {
    //     return $this->hasMany(CourseReview::class);
    // }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }


    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(Instructor::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function specializations()
    {
        return $this->hasManyThrough(Specialization::class, User::class);
    }


    // public function topics()
    // {
    //     return $this->hasMany(CourseTopics::class, 'course_id', 'id');
    // }

    // public function requirements()
    // {
    //     return $this->hasMany(CourseRequirement::class, 'course_id', 'id');
    // }

    public function topics(): MorphMany
    {
        return $this->morphMany(Topic::class, 'topicable');
    }

    public function requirements(): MorphMany
    {
        return $this->morphMany(Requirement::class, 'requirementable');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
