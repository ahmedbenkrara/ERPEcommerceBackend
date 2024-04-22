<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:6']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = [
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ];
    
        throw new HttpResponseException(response()->json($response, 422));
        // throw new HttpResponseException(response()->json([
        //     'success' => false,
        //     'message' => 'Validation errors',
        //     'data' => $validator->errors()
        // ]));
    }
}
