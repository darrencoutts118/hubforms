<?php

namespace Tests\Unit\Models;

use App\Models\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_a_uuidTest()
    {
        // given a new form
        $form = factory(Form::class)->create();

        // it generates its own uuid
        $this->assertNotEmpty($form->uuid);
    }

    public function test_it_does_not_change_uuid_when_updating()
    {
        // given a new form
        $form = factory(Form::class)->create();

        // that has a uuid when it is created
        $uuid = $form->uuid;

        // if we change the form
        $form->title = 'A new title';

        // the uuid should be the same
        $form = $form->fresh();
        $this->assertEquals($uuid, $form->uuid);
    }
}
