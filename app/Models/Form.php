<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    //
    protected $with = [
        'fields'
    ];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
