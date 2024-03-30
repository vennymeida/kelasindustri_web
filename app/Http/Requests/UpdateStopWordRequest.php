<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStopWordRequest extends FormRequest
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
        $id = $this->route('stop_word')->id;
        return [
            'text' =>
            [
                'required',
                Rule::unique('stop_word')->ignore($this->stop_word)

            ]
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
