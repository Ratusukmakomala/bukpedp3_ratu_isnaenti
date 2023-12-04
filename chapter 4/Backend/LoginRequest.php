<?php

namespace App\Http\Requests\Api;

use App\Traits\HasApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
{
    use HasApiResponse;

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
            'email'     => 'required|email:dns|exists:users,email',
            'password'  => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return $this->responseValidation($validator->errors());
    }
}
