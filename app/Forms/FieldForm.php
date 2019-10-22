<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class FieldForm extends Form
{
    public function buildForm()
    {
        // Add fields here...

        $this->add('title', Field::TEXT, ['rules' => 'required|min:3']);

        $this->add('name', Field::TEXT, ['rules' => 'required|regex:/^\S*$/u']);

        $this->add('type', 'choice', [
            'choices' => [
                Field::TEXT           => 'Text',
                Field::TEXTAREA       => 'Textarea',
                Field::SELECT         => 'Select',
                Field::CHOICE         => 'Choice',
                Field::CHECKBOX       => 'Checkbox',
                Field::RADIO          => 'Radio',
                //Field::PASSWORD     => 'password',
                //Field::HIDDEN       => 'hidden',
                //Field::FILE         => 'file',
                //Field::STATIC       => 'static',
                Field::DATE           => 'Date',
                //Field::DATETIME_LOCAL => 'datetime-local',
                Field::MONTH          => 'Month',
                Field::TIME           => 'Time',
                Field::WEEK           => 'Week',
                Field::COLOR          => 'Color',
                //Field::SEARCH       => 'search',
                //Field::IMAGE        => 'image',
                Field::EMAIL          => 'Email',
                Field::URL            => 'Url',
                Field::TEL            => 'Tel',
                Field::NUMBER         => 'Number',
                Field::RANGE          => 'Range',
                //Field::ENTITY       => 'entity',
            ],
            'choice_options' => [
                'wrapper'    => ['class' => 'choice-wrapper'],
                'label_attr' => ['class' => 'label-class'],
            ],
            'expanded' => false,
            'multiple' => false,
        ]);

        $this->add('rules', Field::TEXT);

        $this->add('submit', Field::BUTTON_SUBMIT, ['attr' => ['class' => 'btn btn-primary']]);
    }
}
