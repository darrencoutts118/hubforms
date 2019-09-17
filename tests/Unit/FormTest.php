<?php

namespace Tests\Unit;

use App\Models\Form;
use Tests\TestCase;

class FormTest extends TestCase
{
    public function test_it_generates_a_uuidTest()
    {
        // given a new form
        $form = factory(Form::class)->create();

        // it generates its own uuid
        $this->assertNotEmpty($form->uuid);
    }
}
