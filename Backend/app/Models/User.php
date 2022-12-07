<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Laratrust\Traits\LaratrustUserTrait;



class User extends Authenticatable implements JWTSubject
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    use HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'photo'
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
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // public function roles()
    // {
    //      return $this->belongsToMany(Role::class);
    // }

    public function parents()
    {
        return $this->hasMany(Parents::class, 'auhtor', 'id');
    }

    public function childers()
    {
        return $this->hasManyThrough(Childer::class, Parents::class, 'auhtor', 'parent_id');
    }

    public function payments() {
        return $this->hasManyDeep(
            Payment::class,
            [Parents::class, Childer::class],
            [
                'auhtor',
                'parent_id',
                'childrens_id'
            ],
            [
                'id',
                'id',
                'id'
            ]
        );
    }


}
