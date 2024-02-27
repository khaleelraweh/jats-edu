<?php

namespace App\Models;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class ProductCategory extends Model
{
    use HasFactory, HasTranslations, HasTranslatableSlug, SearchableTrait;

    protected $guarded = [];

    public $translatable = ['category_name', 'slug', 'description'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category_name')
            ->saveSlugsTo('slug');
    }


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

        // return Str::slug($slugString, $this->slugOptions->slugSeparator, $this->slugOptions->slugLanguage);
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

    protected $searchable = [
        'columns' => [
            'product_categories.category_name' => 10,
        ]
    ];


    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function scopeRootCategory($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeHasProducts($query)
    {

        return $query->whereHas('products');
    }

    public function scopeProductCategory($query)
    {
        return $query->whereSection(1); //means any product 
    }

    public function scopeCardCategory($query)
    {
        return $query->whereSection(2); //only product whoes section is 1 means card product 
    }


    // Get Parent of This Element in the same table inner Relationship
    public function parent()
    {
        return $this->hasOne(ProductCategory::class, 'id',  'parent_id');
    }

    // Get All Childreen of This Element in the same table inner Relationship
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
    }

    // Get The children that allowed to be appeared and used
    public function appearedChildren()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id')->where('status', true);
    }

    //This will get all route categories and its childreen under route categories
    public static function tree($level = 1)
    {
        return static::with(implode('.', array_fill(0, $level, 'children')))
            ->whereNull('parent_id')
            ->whereStatus(true)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function cards()
    {
        return $this->hasMany(Product::class);
    }



    // product category has only one photo in photo table so relationship is morphone
    public function photo(): MorphOne
    {
        return $this->morphOne(Photo::class, 'imageable');
    }

    // to get only first one media elemet
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
}
