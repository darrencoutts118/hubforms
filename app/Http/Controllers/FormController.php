<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormSubmissionRequest;
use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FormSubmissionRequest $request
     * @param  \App\Models\Form                         $form
     * @return \Illuminate\Http\Response
     */
    public function store(FormSubmissionRequest $request, Form $form)
    {
        $submission = new Submission;

        $submission->form_id = $form->id;

        foreach ($request->except(['_token']) as $key => $value) {
            $submission->{$key} = $value;
        }

        $submission->save();

        return redirect()->back()->withSuccess('You have successfully submitted the form.');
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Form         $form
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Form $form)
    {
        return view('form.show', compact('form'));
    }
}
