<?php

namespace App\Http\Requests\Taxpayers;

use Illuminate\Foundation\Http\FormRequest;

class TaxpayersCreateFormRequest extends FormRequest
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
            // Taxpayer
            'rif'              => 'required',
            'name'    => 'required',
            'taxpayer_type'    => 'required',
            'economic_sector'  => 'required',
            'permanent_status' => 'required',
            'address' => 'required',
            'representation' => 'required',
            'economic_activities' => 'required',
            // Commercial Register
            'num'              => 'required|unique:commercial_registers',
            'volume'           => 'required',
            'case_file'        => 'required',
            'start_date'       => 'required'
        ];
    }

    public function attributes()
    {
        return [
            // Taxpayer
            'rif'              => 'RIF del contribuyente',
            'name'    => 'nombre o razón social',
            'address' => 'dirección fiscal',
            'type'    => 'tipo de contribuyente',
            'phone'   => 'número de teléfono del contribuyente',
            'economic_sector'  => 'sector económico',
            'permanent_status' => 'estado de permanencia',
            'address' => 'dirección',
            'economic_activities' => 'actividad económica',
            'representation' => 'representante',
            'taxpayer_type' => 'tipo de contribuyente',
            // Commercial register
            'num'              => 'número del registro comercial',
            'volume'           => 'tomo del registro comercial',
            'case_file'        => 'expediente',
            'start_date'       => 'fecha inicio de las actividades'
        ];
    }

    public function messages()
    {
        return [
            // Taxpayer
            'rif.required'              => 'Ingrese el :attribute',
            'name.required'    => 'Ingrese el :attribute',
            'address.required' => 'Ingrese la :attribute',
            'type.required'    => 'Seleccione el :attribute',
            'economic_sector.required'  => 'Seleccione un :attribute',
            'phone.digits'     => 'El :attribute debe ser de 9 dígitos',
            'permanent_status.required' => 'Seleccione el :attribute.',
            'address.required' => 'Ingrese la :attribute del contribuyente',
            'economic_activities.required' => 'Asigne al menos una :attribute',
            'representation.required' => 'Seleccione un :attribute',
            'taxpayer_type' => 'Seleccione un :attribute',
            // Commercial Register
            'num.required'              => 'Ingrese el :attribute del contribuyente',
            'num.unique'                => 'Este :attribute se encuentra registrado',
            'volume.required'           => 'Ingrese el :attribute del contribuyente',
            'case_file.required'        => 'Ingrese el :attribute del contribuyente',
            'start_date.required'       => 'Ingrese :attribute del contribuyente'
        ];
    }
}
