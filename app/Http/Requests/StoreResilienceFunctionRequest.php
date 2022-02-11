<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreResilienceFunctionRequest extends FormRequest
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
            'name' => 'required|string|min:2|unique:resilience_functions',
            'rtd_id' => 'required|integer|exists:resilience_temporal_dimensions,id'
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
            'name.required' => 'Resilience function name is required',
            'name.unique' => 'Resilience function name already exist',
            'name.min' => 'Enter a valid resilience function name',
            'name.string' => 'Resilience function name must be a string',
            'rtd_id.required' => 'Select a resilience temporal dimension',
            'rtd_id.exists' => 'Resilience temporal dimension doesn\'t exist'
        ];
    }
}
