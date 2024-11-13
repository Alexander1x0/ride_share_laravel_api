<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255|min:3",
            "email" => "required|email|unique:users,email|bail",
            'phone_number' => 'required|string|unique:users,phone_number|regex:/^0\d{10}$/|bail',
            "gender" => "required|string|in:male,Male,female,Female,other",
            "password" => "required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/|confirmed",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Get the first error message
        $errorMessage = $validator->errors()->first();

        // Throw the exception with only the first error message
        throw new HttpResponseException(
            response()->json([
                'message' => $errorMessage,
            ], 422)
        );
    }
}
