<?php

use App\Models\Field;
use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Form::class, 10)->create()->each(function ($form) {
            factory(Field::class, rand(3, 20))->create(['form_id' => $form->id]);
        });
    }
}
