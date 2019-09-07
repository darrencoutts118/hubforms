<?php

namespace App\Models;

use App\Forms\Form as BaseForm;
use Illuminate\Database\Eloquent\Model;
use Kris\LaravelFormBuilder\FormBuilder;

class Form extends Model
{
    //
    protected $with = [
        'fields'
    ];

    public function getBuilder()
    {
        $formBuilder = app(FormBuilder::class);

        return $formBuilder->create(BaseForm::class, [
            'method' => 'POST',
            'url' => route('form.submit', $this)
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
}
