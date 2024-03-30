<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStopWordRequest extends FormRequest
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
        return [
            'text' => 'required|unique:stop_word,text'
        ];
    }

    public function messages()
    {
        return [
            'text.required' => 'Stop Word Wajib Diisi',
            'text.unique' => 'Stop Word Telah Ada',
        ];
    }
}
