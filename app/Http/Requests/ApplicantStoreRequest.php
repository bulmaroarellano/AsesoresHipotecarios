<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicantStoreRequest extends FormRequest
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
            'nombre' => ['required', 'max:255', 'string'],
            'apellidos' => ['required', 'max:255', 'string'],
            'fecha_de_nacimiento' => ['required', 'date', 'before:18 years ago'],
            'sexo' => ['required', 'in:masculino,femenino,otro'],
            'curp' => [
                'required',
                'unique:applicants,curp',
                'max:18',
                'string',
                'regex:/^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,A-Z][0-9]$/'],
            'correo_electronico' => [
                'required',
                'unique:applicants,correo_electronico',
                'max:255',
                'string',
            ],
            'address' => ['required', 'max:255', 'string'],
        ];
    }
}
