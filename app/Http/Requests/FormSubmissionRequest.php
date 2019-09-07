<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormSubmissionRequest extends FormRequest
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
        // Get the rules from the form builder, and use them to validate the request
        return $this->form->getBuilder()->getRules();
    }
}
