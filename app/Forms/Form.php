<?php

namespace App\Forms;

use App\Models\Field;
use Kris\LaravelFormBuilder\Form as BaseForm;

class Form extends BaseForm
{
    public function buildForm()
    {
        $fields = Field::all();

        foreach ($fields as $field) {
            $this->add($field->name, $field->type, [
                'rules' => $field->rules,
            ]);
        }

        $this->add('submit', 'submit', ['attr' => ['class' => 'btn btn-primary']]);
    }
}
