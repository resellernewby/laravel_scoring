<?php

namespace App\Http\Requests;

class CheckoutRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'taken_by' => ['required', 'string', 'max:150'],
            'location_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'taken_by.required' => 'Nama pengambil harus diisi!',
            'taken_by.string' => 'Nama pengambil harus berupa huruf',
            'taken_by.max' => 'Nama pengambil maksimal 150 karakter',
            'location_id.required' => 'Lokasi distribusi harus dipilih'
        ];
    }
}
