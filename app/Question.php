<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['title','body'];

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function module()
    {
        return $this->belongsTo('App\Module');
    }
}
