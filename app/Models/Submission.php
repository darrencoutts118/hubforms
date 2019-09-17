<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Metable\Metable;

class Submission extends Model
{
    //
    use Metable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'metas',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
