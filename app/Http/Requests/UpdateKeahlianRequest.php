<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKeahlianRequest extends FormRequest
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
        $id = $this->route('keahlian')->id;
        return [
            'keahlian' => [
                'required',
                Rule::unique('keahlians', 'keahlian')->ignore($id),
                'regex:/^[A-Za-z0-9\s\/]+$/'
            ]
        ];
    }


    public function messages()
    {
        return [
            'keahlian.required' => 'Data Keahlian tidak boleh kosong',
            'keahlian.unique' => 'Data Keahlian sudah tersedia',
            'keahlian.regex' => 'Data tidak boleh berisi selain huruf, angka, spasi, dan tanda(/)',
        ];
    }
}
