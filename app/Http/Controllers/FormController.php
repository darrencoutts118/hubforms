<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Form $form)
    {
        $builder = $form->getBuilder();

        if (!$builder->isValid()) {
            return redirect()->back()->withErrors($builder->getErrors())->withInput();
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
    public function show(Request $request, Form $form)
    {
        return view('form', compact('form'));
    }
}
