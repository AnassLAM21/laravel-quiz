<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{

    protected $fillable = ['title','body'];

    public function quizzes()
    {
        return $this->hasMany('App\Quiz');
    }

    //created By
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
