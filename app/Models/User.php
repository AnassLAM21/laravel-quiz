<?php

namespace App\Models;

use App\Models\Quiz;
use App\Models\Module;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Created
    public function createQuizzes()
    {
        return $this->hasMany(Quiz::class,'user_id', 'id');
    }

    //Passed 
    public function passQuizzes()
    {
        return $this->belongsToMany(Quiz::class, 'user_quiz')
                    ->withTimestamps()
                    ->withPivot('score');
    }

    //Created module
    public function modules()
    {
        return $this->hasMany(Module::class);
    }


    public function files()
    {
        return $this->morphMany(File::class, 'fillable');
    }



}
