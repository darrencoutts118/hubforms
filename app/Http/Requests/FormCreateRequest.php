<?php

namespace App\Http\Requests;

use App\Forms\FormForm;
use Illuminate\Foundation\Http\FormRequest;
use Kris\LaravelFormBuilder\FormBuilder;

class FormCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return app(FormBuilder::class)->create(FormForm::class)->getRules();
    }
}
