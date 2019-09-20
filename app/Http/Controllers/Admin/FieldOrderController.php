<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Form;
use Illuminate\Http\Request;

class FieldOrderController extends Controller
{
    //
    public function update(Request $request, Form $form, Field $field)
    {
        if ($request->direction == 'up') {
            $field->moveOrderUp();
        } elseif ($request->direction == 'down') {
            $field->moveOrderDown();
        } else {
            abort(404);
        }

        return redirect()->back();
    }
}
