<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateResilienceControlRequest extends FormRequest
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
            'name' => 'required|string|min:2|unique:resilience_controls',
            'rfc_id' => 'required|integer|exists:resilience_function_categories,id'
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
            'name.required' => 'Resilience control name is required',
            'name.unique' => 'Resilience control name already exist',
            'name.min' => 'Enter a valid resilience control name',
            'name.string' => 'Resilience control name must be a string',
            'rfc_id.required' => 'Select a resilience function category',
            'rfc_id.exists' => 'Resilience function category doesn\'t exist'
        ];
    }
}
