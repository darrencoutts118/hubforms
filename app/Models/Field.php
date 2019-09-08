<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //
    protected $fillable = [
        'title',
        'name',
        'type',
        'rules',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
