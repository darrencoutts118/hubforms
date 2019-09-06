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
            $model        = new FieldModel;
            $model->name  = $name;
            $model->title = $field['title'];
            $model->type  = $field['type'];
            $model->rules = $field['rules'];
            $model->save();
        }
    }
}
