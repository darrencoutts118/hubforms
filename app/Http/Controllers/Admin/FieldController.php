<?php

namespace App\Http\Controllers\Admin;

use App\Forms\FieldForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\FieldCreateRequest;
use App\Models\Field;
use App\Models\Form;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Form $form)
    {
        //
        $fields = $form->fields()->paginate();

        return view('admin.fields.index', compact('form', 'fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Form $form, FormBuilder $formBuilder)
    {
        //
        $createForm = $formBuilder->create(FieldForm::class, [
            'method' => 'POST',
            'url'    => route('admin.fields.store', $form),
        ]);

        return view('admin.fields.create', compact('form', 'createForm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldCreateRequest $request, Form $form)
    {
        //
        $field = new Field;
        $field->fill($request->all());
        $field->form()->associate($form);
        $field->save();

        return redirect()->route('admin.fields.index', $form)->with('success', 'Field ' . $field->title . ' successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Form $form, Field $field, FormBuilder $formBuilder)
    {
        //
        $editForm = $formBuilder->create(FieldForm::class, [
            'method' => 'PUT',
            'model'  => $field,
            'url'    => route('admin.fields.update', [$form, $field]),
        ]);

        return view('admin.fields.edit', compact('form', 'field', 'editForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form, Field $field)
    {
        //
        $field = new Field;
        $field->fill($request->all());
        $field->form()->associate($form);
        $field->save();

        return redirect()->route('admin.fields.index', $form)->with('success', 'Field ' . $field->title . ' successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Form $form, Field $field)
    {
        //
        $field->delete();

        return redirect()->route('admin.fields.index', $form)->with('success', 'Field ' . $field->title . ' successfully deleted');
    }
}
