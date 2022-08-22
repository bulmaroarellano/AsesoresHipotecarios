<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'monto_solicitado' => $this->destino === 'Casa' || $this->destino==='casa'? 'required|between:0,200000':$this->destino === 'Auto' || $this->destino==='auto'?'required|between:0,100000':$this->destino === 'Prestamo' || $this->destino==='prestamo'?'required|between:0,50000': $this->destino==='tarjeta de credito'?'required|between:0,20000':'required',

            'destino' => [
                'required',
                'in:casa,auto,prestamo,tarjeta de credito',
            ],
            'monto_solicitado' => ['nullable', 'max:255', 'string'],
            'plazo' => ['nullable', 'max:2'],
        ];
    }
}
