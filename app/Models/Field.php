<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Field extends Model implements Sortable
{
    //
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'order',
        'sort_when_creating' => true,
    ];

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
