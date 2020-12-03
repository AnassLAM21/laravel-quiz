<?php

namespace App\Models;

use App\Models\User;
use App\Models\Module;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    protected $fillable = ['title','body','publish','published_at','time','views_count','votes_count'];
    protected $appends = ['updated_at','updated_at'];

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
        return $this->belongsTo(User::class,'user_id','id');
    }

    //passed By
    public function participants()
    {
        return $this->belongsToMany('App\Models\Quiz', 'user_quiz')
                    ->withTimestamps()
                    ->withPivot('score');
    }
}
