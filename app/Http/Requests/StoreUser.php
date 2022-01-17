<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
// use Dotenv\Exception\ValidationException;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUser extends FormRequest
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
        return [
                'first_name' => 'required|max:50',
                'last_name' => 'required|max:50',
                'email' => 'required|max:100',
                'password' => 'required|min:8'
        ];
    }
        protected function failedValidation(Validator $validator)
        {
        throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()->first(),
        'status' => true
        ], 422));
        }
}
