<?php

use App\Models\Field as FieldModel;
use Illuminate\Database\Seeder;
use Kris\LaravelFormBuilder\Field;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = [
            'name' => [
                'title' => 'Name',
                'type'  => Field::TEXT,
                'rules' => 'required|min:5',
            ],

            'email' => [
                'title' => 'Email',
                'type'  => Field::TEXT,
                'rules' => 'email|ends_with:@test.com',
            ],

            'phone' => [
                'title' => 'Phone',
                'type'  => Field::TEXT,
                'rules' => 'required',
            ],

            'message' => [
                'title' => 'Message',
                'type'  => Field::TEXTAREA,
                'rules' => 'max:5000|min:10',
            ],
        ];

        foreach ($fields as $name => $field) {
            $model = new FieldModel;
            $model->form_id = 1;
            $model->name = $name;
            $model->title = $field['title'];
            $model->type = $field['type'];
            $model->rules = $field['rules'];
            $model->save();
        }

        $fields = [
            'name' => [
                'title' => 'Name',
                'type'  => Field::TEXT,
                'rules' => 'required|min:5',
            ],

            'email' => [
                'title' => 'Email',
                'type'  => Field::TEXT,
                'rules' => 'email',
            ],

            'personal_id' => [
                'title' => 'Personal ID',
                'type'  => Field::TEXT,
                'rules' => 'required',
            ],

            'course' => [
                'title' => 'Course You Are Applying Form',
                'type'  => Field::TEXT,
                'rules' => 'required',
            ],

            'campus' => [
                'title' => 'Campus',
                'type'  => Field::TEXT,
                'rules' => 'required',
            ],

            'message' => [
                'title' => 'Message',
                'type'  => Field::TEXTAREA,
                'rules' => 'max:5000|min:10',
            ],
        ];

        foreach ($fields as $name => $field) {
            $model = new FieldModel;
            $model->form_id = 2;
            $model->name = $name;
            $model->title = $field['title'];
            $model->type = $field['type'];
            $model->rules = $field['rules'];
            $model->save();
        }
    }
}
