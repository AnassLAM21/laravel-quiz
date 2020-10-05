<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['title','body','choices_count','right_choice_id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fillable');
    }
}
