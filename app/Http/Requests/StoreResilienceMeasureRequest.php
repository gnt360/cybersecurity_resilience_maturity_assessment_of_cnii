<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreResilienceMeasureRequest extends FormRequest
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
            'name' => 'required|string|min:2|unique:resilience_measures',
            'order' => 'required|integer',
            'rc_id' => 'required|integer|exists:resilience_controls,id'
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
            'name.required' => 'Resilience measure name is required',
            'name.unique' => 'Resilience measure name already exist',
            'name.min' => 'Enter a valid resilience measure name',
            'name.string' => 'Resilience measure name must be a string',
            'order.integer' => 'Order must be an integer',
            'order.required' => 'Order is required',
            'rc_id.required' => 'Select a resilience control',
            'rc_id.exists' => 'Resilience control doesn\'t exist'
        ];
    }
}
