<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //filename	extension	path	type

    protected $fillable = ['name','extension','path','type'];


    // public function fillable()
    // {
    //     return $this->morphTo();
    // }
}
