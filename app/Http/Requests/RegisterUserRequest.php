<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterUserRequest extends FormRequest
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
            'full_name' => 'required|string|min:2|max:100',
            'org_id' => 'required|exists:organisations,id',
            'phone_number' => 'required|min:11|max:15|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
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
            'full_name.required' => 'Name is required',
            'phone_number.unique' => 'Phone number already exist',
            'email.unique' => 'Email already exist',
            'email.email' => 'Enter a valid email address',
            'phone_number.min' => 'Enter a valid phone number',
            'phone_number.max' => 'Enter a valid phone number',
            'full_name.string' => 'Name must be a string',
            'full_name.min' => 'Enter a valid name',
            'org_id.required' => 'Organisation is required',
            'org_id.exists' => 'Organisation doesn\'t exist',
            'password.min' => 'Password should be aleast 6 characters',
            'password.confirmed' => 'confirmed password dosen\'t match'
        ];
    }
}
