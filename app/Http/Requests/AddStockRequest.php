<?php

namespace App\Http\Requests;

class AddStockRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'asset.suplier_id' => ['required'],
            'asset.current_price' => ['required', 'min:3', 'max:20'],
            'asset.funds_source_id' => ['required'],
            'rack.*.warehouse_id' => ['required'],
            'rack.*.id' => ['required'],
            'rack.*.qty' => ['required', 'numeric'],
            'purchase_at' => ['required', 'date_format:Y-m-d']
        ];
    }

    public function messages()
    {
        return [
            'asset.suplier_id.required' => 'suplier barang harus dipilih!',
            'asset.current_price.required' => 'Harga item harus diisi!',
            'asset.current_price.min' => 'Harga minimal 3 digits',
            'asset.current_price.max' => 'Harga maksimal 20 digits',
            'asset.funds_source_id.required' => 'Sumber dana harus dipilih!',
            'rack.*.warehouse_id.required' => 'Gudang penyimpanan harus dipilih!',
            'rack.*.id.numeric' => 'Rack harus dipilih!',
            'rack.*.qty.required' => 'Qty harus diisi!',
            'rack.*.qty.numeric' => 'Qty harus berupa angka!',
            'purchase_at.required' => 'Tanggal beli harus diisi!',
            'purchase_at.date_format' => 'Format tanggal harus YYYY-mm-dd',
        ];
    }
}
