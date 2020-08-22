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

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }

    public function module()
    {
        return $this->belongsTo('App\Module');
    }

    public function files()
    {
        return $this->morphMany('App\File', 'fillable');
    }


}
