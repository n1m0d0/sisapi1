<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CapiRequest extends FormRequest
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
            'gestion' => 'required|min:4|max:4',
            'entidad' => 'required|max:4|min:4',
            'sisin' => 'required|string|max:20',
            'numeroC31' => 'required|string|max:30',
            'fechaAprobacion' => 'required|date',
            'montoTotal' => 'required|max:14',
            'detalle' => 'required|array',
            'detalle.*.fuente' => 'required|max:2',
            'detalle.*.organismo' => 'required|max:3',
            'detalle.*.partida' => 'required|max:5',
            'detalle.*.entidadTransferencia' => 'required|max:4',
            'detalle.*.monto' => 'required|max:14',
        ];
    }

    public function messages()
    {
        return [
            'gestion' => 'la :attribute es obligatorio ',
            'entidad' => 'la :attribute es obligatorio ',
            'sisin' => 'el codigo SISIN es obligatorio ',
            'numeroC31' => 'el codigo C31 es obligatorio ',
            'fechaAprobacion' => 'la Fecha de Aprobacion es obligatorio ',
            'montoTotal' => 'el Monto Total es obligatorio ',
            'detalle' => 'el :attribute es obligatorio ',
            'detalle.*.fuente' => 'la :attribute es obligatorio ',
            'detalle.*.organismo' => 'el :attribute es obligatorio ',
            'detalle.*.partida' => 'la :attribute es obligatorio ',
            'detalle.*.entidadTransferencia' => 'la Entidad de Transferencia es obligatorio ',
            'detalle.*.monto' => 'el :attribute es obligatorio ',
        ];
    }

    protected function failedValidation(Validator $validator, )
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Ha ocurrido un error',
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
