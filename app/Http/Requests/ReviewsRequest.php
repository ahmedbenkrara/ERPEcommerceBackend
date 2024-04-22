<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname' => ['required', 'string'], 
            'email' => ['required', 'string'], 
            'title' => ['required', 'string'], 
            'rate' => ['required', 'numeric'], 
            'message' => ['required', 'string'], 
            'type' => ['required', 'string'], 
            'modele_id' => ['nullable', 'numeric' ,'exists:modele,id'], 
            'package_id' => ['nullable', 'numeric' ,'exists:package,id']
        ];
    }
}
