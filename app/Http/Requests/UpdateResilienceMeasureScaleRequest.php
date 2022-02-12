<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateResilienceMeasureScaleRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:resilience_measure_scales',
            'weight' => 'required|numeric',
            'order' => 'required|integer',
            'rm_id' => 'required|integer|exists:resilience_measures,id'
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
            'name.required' => 'Resilience measure scale name is required',
            'name.unique' => 'Resilience measure scale name already exist',
            'name.min' => 'Enter a valid resilience measure scale name',
            'name.string' => 'Resilience measure scale name must be a string',
            'order.integer' => 'Order must be an integer',
            'order.required' => 'Order is required',
            'order.numeric' => 'Order must be a number',
            'order.required' => 'Order is required',
            'rm_id.required' => 'Select a resilience measure',
            'rm_id.exists' => 'Resilience measure doesn\'t exist'
        ];
    }
}
