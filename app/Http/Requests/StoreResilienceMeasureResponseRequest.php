<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreResilienceMeasureResponseRequest extends FormRequest
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
            'rm_id' => 'required|integer|exists:resilience_measures,id',
            'rms_id' => 'required|integer|exists:resilience_measure_scales,id',
            'user_id' => 'required|integer|exists:users,id'
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
            'rm_id.required' => 'Select a resilience measure',
            'rm_id.exists' => 'Resilience measure doesn\'t exist',
            'rms_id.required' => 'Select a resilience measure scale',
            'rms_id.exists' => 'Resilience measure scale doesn\'t exist',
            'user_id.required' => 'Only users are allowed',
            'user_id.exists' => 'Not a valid user'
        ];
    }
}
