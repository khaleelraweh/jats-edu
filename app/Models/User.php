<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, EntrustUserWithPermissionsTrait, SearchableTrait, HasTranslations;


    protected $guarded = [];
    public $translatable = ['description', 'motavation', 'biography'];



    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    // protected $fillable = [
    //     'first_name',
    //     'last_name',
    //     'username',
    //     'mobile',
    //     'user_image',
    //     'status',
    //     'email',
    //     'password',

    // ];

    protected $searchable = [
        'columns' => [

            'users.first_name' => 10,
            'users.last_name' => 10,
            'users.username' => 10,
            'users.email' => 10,
            'users.mobile' => 10,
        ]
    ];



    // for receiving the notifications depends on the channel next to the route
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'App.Models.User.' . $this->id;
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // to get full name as property instead of first_name and last_name
    protected $appends = ['full_name'];

    // ucfirst : get first alphabet as bigger alpha
    public function getFullNameAttribute(): string
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // public function courses(): BelongsToMany
    // {
    //     return $this->belongsToMany(Course::class);
    // }

    public function scopeHasCourses($query)
    {
        return $query->whereHas('courses');
    }

    public function specializations(): BelongsToMany
    {
        return $this->belongsToMany(Specialization::class);
    }

    //check if the user has role directly
    // public function hasRole($role)
    // {
    //     return $this->roles()->where('name', $role)->exists();
    // }

    // public function hasRole($role)
    // {
    //     return $this->roles()->where('name', $role);
    // }


    // to return the the user who has role lake lectures or admin or customer
    public function scopeWhereHasRoles($query, $role)
    {
        return $query->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'userable');
    }
    public function events(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'userable');
    }

    public function courses(): MorphToMany
    {
        return $this->morphedByMany(Course::class, 'userable');
    }

    public function requestToTeaches()
    {
        return $this->hasMany(TeachRequest::class);
    }

    public function certificateRequests()
    {
        return $this->hasMany(CertificateRequest::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certifications::class);
    }

    public function hasTeachRequests(): bool
    {
        return $this->requestToTeaches()->exists();
    }

    public function latestTeachRequestStatus()
    {
        $teachRequest = $this->requestToTeaches()->latest()->first();

        if (!$teachRequest) {
            return null;
        }

        return $teachRequest->teach_request_status;
    }

    public function instPageVisit()
    {
        return $this->belongsTo(InstPageVisit::class, 'inst_page_visit_id', 'id');
    }
}
