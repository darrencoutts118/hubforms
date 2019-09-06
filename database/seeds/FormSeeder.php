<?php

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
        $form = new Form;
        $form->title = 'Example Form';
        $form->save();
    }
}
