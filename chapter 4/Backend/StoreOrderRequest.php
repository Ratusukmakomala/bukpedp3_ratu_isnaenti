<?php

namespace App\Http\Requests\Api;

use App\Traits\HasApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreOrderRequest extends FormRequest
{
    use HasApiResponse;
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
            'table_number'      => 'required|integer',
            'order_name'        => 'required|string',
            'payment'           => 'required|in:cash,debit',
            'orders'            => 'required|array',
            'orders.*.menu_id'  => 'required',
            'orders.*.qty'      => 'required|integer'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return $this->responseValidation($validator->errors());
    }
}
