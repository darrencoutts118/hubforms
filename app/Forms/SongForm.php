<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class SongForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|min:5'
            ])
            ->add('email', Field::TEXT, [
                'rules' => 'email|ends_with:@test.com'
            ])
            ->add('lyrics', Field::TEXTAREA, [
                'rules' => 'max:5000|min:10'
            ])
            ->add('publish', Field::CHECKBOX, [
                'rules' => 'required'
            ])
            ->add('submit', 'submit', ['attr' => ['class' => 'btn btn-primary']]);
    }
}
