<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = ['body'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }


    public static function boot()
    {
        parent::boot();

        static::created(function ($choice) {    
            $choice->question->increment('choices_count');                     
              
        });        

        static::deleted(function ($choice) {            
            $choice->question->decrement('choices_count');  
        });
    }



    








}
 