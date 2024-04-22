<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteRequest extends FormRequest
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
            'type' => ['required', 'string'], 
            'modele_id' => ['nullable', 'numeric' ,'exists:modele,id'], 
            'package_id' => ['nullable', 'numeric' ,'exists:package,id'],
            'user_id' => ['nullable', 'numeric' ,'exists:users,id'],
        ];
    }
}
