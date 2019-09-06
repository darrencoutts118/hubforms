<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class FormController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Form $form, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\Form::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $submission = new Submission;

        $submission->form_id = 1;

        foreach ($request->except(['_token']) as $key => $value) {
            $submission->{$key} = $value;
        }

        $submission->save();

        return redirect()->back()->withSuccess('You have successfully submitted the form.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Form $form, FormBuilder $formBuilder)
    {
        $form->html = $formBuilder->create(\App\Forms\Form::class, [
            'method' => 'POST',
            'url' => route('form.submit', $form)
        ]);

        return view('form', compact('form'));
    }
}
