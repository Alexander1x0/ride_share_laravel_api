<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        Log::info('Authorize method called with input:', $this->all());
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        Log::info('Validation rules applied for request:', $this->all());
        return [
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email," . $this->user()->id ."|bail",
            'phone_number' => 'required|string|unique:users,phone_number,' . $this->user()->id ."|regex:/^0\d{10}$/|bail",
            "gender" => "required|string|in:male,Male,female,Female,other",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Get the first error message
        $errorMessage = $validator->errors()->first();

        Log::error('Validation failed:', $validator->errors()->toArray());
        // Throw the exception with only the first error message
        throw new HttpResponseException(
            response()->json([
                'message' => $errorMessage,
            ], 422)
        );
    }
}
