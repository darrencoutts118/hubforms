<?php

namespace App\Models;

use App\Forms\Form as BaseForm;
use Illuminate\Database\Eloquent\Model;
use Kris\LaravelFormBuilder\FormBuilder;
use Str;

class Form extends Model
{
    //
    protected $with = [
        'fields',
    ];

    protected $fillable = [
        'title',
        'intro',
        'notification',
    ];

    /*public function getRouteKeyName()
    {
    return 'uuid';
    }*/

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($form) {
            $form->uuid = (string) Str::uuid();
        });
    }

    public function getBuilder()
    {
        $formBuilder = app(FormBuilder::class);

        return $formBuilder->create(BaseForm::class, [
            'method' => 'POST',
            'url'    => route('form.submit', $this),
        ]);
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function getConfirmationAttribute()
    {
        return $this->confirmation_text ?? 'You have successfully submitted the form.';
    }
}
