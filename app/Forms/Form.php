<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form as BaseForm;

class Form extends BaseForm
{
    public function buildForm()
    {
        $form = request()->form;

        $fields = $form->fields;

        foreach ($fields as $field) {
            $this->add($field->name, $field->type, [
                'rules' => $field->rules,
                'label' => $field->title,
            ]);
        }

        $this->add('submit', 'submit', ['attr' => ['class' => 'btn btn-primary']]);
    }
}
