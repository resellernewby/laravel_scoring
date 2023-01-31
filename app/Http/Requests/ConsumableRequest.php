<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsumableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'inputs.suplier_id' => ['required'],
            'inputs.brand_id' => ['required'],
            'inputs.name' => ['required', 'max:255'],
            'inputs.barcode' => ['required', 'unique:assets,barcode'],
            'inputs.current_price' => ['required', 'min:3', 'max:20'],
            'qty' => ['nullable'],
            'lifetime' => ['nullable'],
            'warehouse_id' => ['required'],
            'rack_id' => ['required_if:warehouse_id'],
            'tags' => ['required'],
            'images.*' => ['nullable', 'image', 'max:4096']
        ];
    }

    public function messages()
    {
        return [
            'inputs.suplier_id.required' => 'suplier barang harus dipilih!',
            'inputs.brand_id.required' => 'Merek barang harus dipilih!',
            'inputs.name.required' => 'Nama barang harus diisi!',
            'inputs.name.max' => 'Nama barang maksimal 255 karakter',
            'inputs.barcode.required' => 'Barcode barang harus diisi!',
            'inputs.current_price.required' => 'Harga item harus diisi!',
            'warehouse_id.required' => 'Gudang penyimpanan harus dipilih!',
        ];
    }
}
