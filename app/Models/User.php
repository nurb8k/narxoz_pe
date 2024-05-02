<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'password',
        'identifier',
        'is_admin',
        'name',
        'middle_name',
        'fcm',
        'avatar',
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


//    public function students(){
//        return $this->hasMany(Student::class, 'user_identifier', 'identifier');
//    }
//    public function teachers(){
//        return $this->hasMany(Teacher::class, 'user_identifier', 'identifier');
//    }

    public function student(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Student::class, 'user_identifier', 'identifier');
    }

    public function teacher(){
        return $this->hasOne(Teacher::class, 'user_identifier', 'identifier');
    }

    public function getAvatarPathAttribute(): string
    {
        return $this->avatar=='default.png' ? asset($this->avatar) : asset('storage/'.$this->avatar);
    }

}
