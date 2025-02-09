<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
            'fullname' => ['string', 'required'],
            'nickname' => ['string', 'required'],
            'password' => ['string', 'required', 'min:6'],
            'email' => ['email', 'required', 'unique:users'],
            'avatar' => ['string', 'nullable'],
            'birthdate' => ['date', 'nullable'],
            'address.zipcode' => ['string', 'required'],
            'address.street' => ['string', 'required'],
            'address.number' => ['string', 'required'],
            'address.neighborhood' => ['string', 'required'],
            'address.city' => ['string', 'required'],
            'address.state' => ['string', 'required'],
            'address.state_id' => ['required', 'exists:states,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
