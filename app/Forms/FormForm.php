<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class FormForm extends Form
{
    public function buildForm()
    {
        // Add fields here...

        $this->add('title', Field::TEXT, ['rules' => 'required|min:3']);

        $this->add('intro', Field::TEXTAREA);

        $this->add('notification', Field::TEXT, ['rules' => 'email', 'label' => 'Notification Email Address']);

        $this->add('submit', Field::BUTTON_SUBMIT, ['attr' => ['class' => 'btn btn-primary']]);
    }
}
