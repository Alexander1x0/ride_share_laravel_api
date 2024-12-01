<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaypalRequest extends FormRequest
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
            'ride_id' => 'required|exists:rides,id',
            'value' => 'required|numeric|min:1',
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
