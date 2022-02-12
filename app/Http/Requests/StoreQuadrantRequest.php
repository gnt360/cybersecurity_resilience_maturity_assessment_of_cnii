<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreQuadrantRequest extends FormRequest
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
            'name' => 'required|string|min:2|unique:quadrants',
            'low_limit' => 'required|numeric',
            'upper_limit' => 'required|numeric'
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
            'name.required' => 'Quadrant name is required',
            'name.unique' => 'Quadrant name already exist',
            'name.min' => 'Enter a valid quadrant name',
            'name.string' => 'Quadrant name must be a string',
            'low_limit.numeric' => 'Low limit must be a number',
            'low_limit.required' => 'Low limit is required',
            'upper_limit.numeric' => 'Upper limit must be a number',
            'upper_limit.required' => 'Upper limit is required'
        ];
    }
}
