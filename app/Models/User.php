<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function photo()
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'photo');
    }

    

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, Role::class);
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function organizer()
    {
        return $this->hasOne(Organizer::class);
    }
}
