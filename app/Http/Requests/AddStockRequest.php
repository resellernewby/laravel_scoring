<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddStockRequest extends FormRequest
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
            'rack.*.warehouse_id' => ['required'],
            'rack.*.id' => ['required'],
            'rack.*.qty' => ['required', 'numeric', 'max:5'],
            'price' => ['required', 'min:3', 'max:15'],
            'purchase_at' => ['required', 'date_format:Y-m-d']
        ];
    }

    public function messages()
    {
        return [
            'rack.*.warehouse_id.required' => 'Gudang harus dipilih!',
            'rack.*.id.required' => 'Rack harus dipilih!',
            'rack.*.qty' => 'Qty barang harus diisi!',
            'price.required' => 'Harga pcs harus diisi!',
            'price.min' => 'Harga pcs minimal 3 digits',
            'price.max' => 'Harga pcs maksimal 15 digits',
            'purchase_at.required' => 'Tanggal beli harus diisi!',
            'purchase_at.date_format' => 'Format tanggal harus YYYY-mm-dd',
        ];
    }
}
