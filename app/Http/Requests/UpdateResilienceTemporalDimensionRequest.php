<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateResilienceTemporalDimensionRequest extends FormRequest
{
    use ApiResponse;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:resilience_temporal_dimensions',
            'weight' => 'required|numeric'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse( $validator->errors(), 'Validation errors', Response::HTTP_BAD_REQUEST)
        );

    }

    public function messages() //OPTIONAL
    {
        return [
            'name.required' => 'Resilience temporal dimension name is required',
            'name.unique' => 'Resilience temporal dimension name already exist',
            'name.min' => 'Enter a valid resilience temporal dimension name',
            'name.string' => 'Resilience temporal dimension name must be a string'
        ];
    }
}
