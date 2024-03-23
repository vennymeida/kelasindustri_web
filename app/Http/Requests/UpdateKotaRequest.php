<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKotaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('kotum')->id;
        return [
            'kota' => 'required|regex:/^[a-zA-Z\s]+$/u|unique:kotas,kota,' . $id
        ];
    }

    public function messages()
    {
        return [
            'kota.required' => 'Data kota tidak boleh kosong',
            'kota.unique' => 'Data kota sudah digunakan sebelumnya',
            'kota.regex' => 'Data kota tidak boleh mengandung @!_?',
        ];
    }
}
