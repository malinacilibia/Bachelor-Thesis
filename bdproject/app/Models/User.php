<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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
        'password',
        'is_admin'
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
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class, 'user_id');
    }
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites')->withTimestamps();
    }

    public function hasFavorited($postId)
    {
        return $this->favorites()->where('post_id', $postId)->exists();
    }
// app/Models/User.php

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function stories()
    {
        return $this->hasMany(AdoptionStory::class);
    }
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

}
