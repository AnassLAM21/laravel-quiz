<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['title','body','user_id'];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    //created By
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
