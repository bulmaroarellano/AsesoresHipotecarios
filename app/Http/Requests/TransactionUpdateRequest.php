<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionUpdateRequest extends FormRequest
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
            'folio' => [
                'required',
                Rule::unique('transactions', 'folio')->ignore(
                    $this->transaction
                ),
                'max:8',
                'string',
            ],
            'applicant_id' => ['required', 'exists:applicants,id'],
            'order_id' => ['required', 'exists:orders,id'],
            'status' => ['required', 'boolean'],
        ];
    }
}
