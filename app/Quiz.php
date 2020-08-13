<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    public function module()
    {
        return $this->belongsTo('App\Module');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    //created By
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    //passed By
    public function participants()
    {
        return $this->belongsToMany('App\Quiz', 'user_quiz')
                    ->withTimestamps()
                    ->withPivot('score');
    }

}
