<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['publish','published_at','time','views_count','votes_count'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    //created By
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    //passed By
    public function participants()
    {
        return $this->belongsToMany('App\Quiz', 'user_quiz')
                    ->withTimestamps()
                    ->withPivot('score');
    }
}
