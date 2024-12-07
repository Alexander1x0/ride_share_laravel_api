<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RideDetailsRequest extends FormRequest
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
            "from" => "required|string",
            "to" => "required|string",
            "transport_id" => "required|integer|exists:transports,id",
            "car_id" => "nullable|integer|exists:cars,id",
            "bike_id" => "nullable|integer",
            "cycle_id" => "nullable|integer",
            "taxi_id" => "nullable|integer",
            "when" => "required|string|in:now,Now,later,Later",
            "date" => "required|date_format:Y-m-d",
            "time" => "required|string",
            "value" => "required|numeric|min:0",
            "payment_way" => "required|string",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'car_id' => $this->car_id ?? null,
            'bike_id' => $this->bike_id ?? null,
            'cycle_id' => $this->cycle_id ?? null,
            'taxi_id' => $this->taxi_id ?? null,
        ]);
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $transportFields = ['car_id', 'bike_id', 'cycle_id', 'taxi_id'];

            $filledTransportFields = array_filter(
                $this->only($transportFields),
                fn ($value) => !is_null($value)
            );

            if (count($filledTransportFields) !== 1) {
                $validator->errors()->add(
                    'transport_choice',
                    'Exactly one transport option must be selected (car, bike, cycle, or taxi).'
                );
            }
        });
    }

    public function messages()
    {
        return [
            "car_id.exists" => "The selected car is invalid.",
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
