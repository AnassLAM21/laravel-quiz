<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = ['body','is_right_choice'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
 