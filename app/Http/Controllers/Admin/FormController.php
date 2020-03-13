<?php

namespace App\Http\Controllers\Admin;

use App\Forms\FormForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormCreateRequest;
use App\Http\Requests\FormUpdateRequest;
use App\Models\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show all of the froms
        $forms = Form::paginate();

        return view('admin.forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        //
        $createForm = $formBuilder->create(FormForm::class, [
            'method' => 'POST',
            'url'    => route('admin.forms.store'),
        ]);

        return view('admin.forms.create', compact('createForm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormCreateRequest $request)
    {
        //
        $form = new Form;
        $form->fill($request->all());
        $form->save();

        return redirect()->route('admin.forms.show', $form)->with('success', 'Form successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        // show this form
        return view('admin.forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form, FormBuilder $formBuilder)
    {
        //
        $editForm = $formBuilder->create(FormForm::class, [
            'method' => 'PUT',
            'model'  => $form,
            'url'    => route('admin.forms.update', $form),
        ]);

        return view('admin.forms.edit', compact('form', 'editForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(FormUpdateRequest $request, Form $form)
    {
        //
        $form->fill($request->all());
        $form->save();

        return redirect()->route('admin.forms.show', $form)->with('success', 'Form successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
        $form->delete();
    }
}
