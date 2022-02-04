<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrganisationRequest extends FormRequest
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
            'name' => 'required|string|min:2|unique:organisations',
            'sector_id' => 'required|integer|exists:sectors,id',
            'code' => 'unique:organisations'
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
            'name.required' => 'Organisation name is required',
            'name.unique' => 'Organisation name already exist',
            'name.min' => 'Enter a valid organisation name',
            'name.string' => 'Organisation name must be a string',
            'sector_id.required' => 'Select a sector',
            'sector_id.exists' => 'Sector doesn\'t exist'
        ];
    }
}
