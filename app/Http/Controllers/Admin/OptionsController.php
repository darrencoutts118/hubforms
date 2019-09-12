<?php

namespace App\Http\Controllers\Admin;

use App\Forms\FieldForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\FieldCreateRequest;
use App\Models\Field;
use App\Models\Form;
use App\Models\Option;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Form $form, Field $field)
    {
        //
        $options = $field->options()->paginate();

        return view('admin.options.index', compact('form', 'field', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Form $form, Field $field, FormBuilder $formBuilder)
    {
        //
        $createForm = $formBuilder->create(FieldForm::class, [
            'method' => 'POST',
            'url'    => route('admin.options.store', $form),
        ]);

        return view('admin.options.create', compact('form', 'createForm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldCreateRequest $request, Form $form, Field $field)
    {
        //
        $field = new Field;
        $field->fill($request->all());
        $field->form()->associate($form);
        $field->save();

        return redirect()->route('admin.options.index', $form)->with('success', 'Field ' . $field->title . ' successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Form $form, Field $field, Option $option, FormBuilder $formBuilder)
    {
        //
        $editForm = $formBuilder->create(FieldForm::class, [
            'method' => 'PUT',
            'model'  => $field,
            'url'    => route('admin.options.update', [$form, $field]),
        ]);

        return view('admin.options.edit', compact('form', 'field', 'editForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form, Field $field, Option $option)
    {
        //
        $field = new Field;
        $field->fill($request->all());
        $field->form()->associate($form);
        $field->save();

        return redirect()->route('admin.options.index', $form)->with('success', 'Field ' . $field->title . ' successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Form $form, Field $field, Option $option)
    {
        //
        $field->delete();

        return redirect()->route('admin.options.index', $form)->with('success', 'Field ' . $field->title . ' successfully deleted');
    }
}
