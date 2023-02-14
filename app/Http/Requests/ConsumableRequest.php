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
            'asset.suplier_id' => ['required'],
            'asset.brand_id' => ['required'],
            'asset.name' => ['required', 'max:255'],
            'asset.barcode' => ['required', 'unique:assets,barcode'],
            'asset.current_price' => ['required', 'min:3', 'max:20'],
            'asset.funds_source_id' => ['required'],
            'asset.purchase_at' => ['required'],
            'rack.*.warehouse_id' => ['required'],
            'rack.*.id' => ['required'],
            'rack.*.qty' => ['required', 'numeric'],
            'tag_ids' => ['required'],
            // 'tag_ids.*' => ['required'],
            'lifetime' => ['nullable'],
            'images.*' => ['nullable', 'image', 'max:4096'],
            'spec.*.name' => ['nullable', 'string', 'max:50'],
            'spec.*.value' => ['nullable', 'string', 'max:100']
        ];
    }

    public function messages()
    {
        return [
            'asset.suplier_id.required' => 'suplier barang harus dipilih!',
            'asset.brand_id.required' => 'Merek barang harus dipilih!',
            'asset.name.required' => 'Nama barang harus diisi!',
            'asset.name.max' => 'Nama barang maksimal 255 karakter',
            'asset.barcode.required' => 'Barcode barang harus diisi!',
            'asset.barcode.unique' => 'Barcode tersedia, silahkan tambah stok barang',
            'asset.current_price.required' => 'Harga item harus diisi!',
            'asset.current_price.min' => 'Harga minimal 3 digits',
            'asset.current_price.max' => 'Harga maksimal 20 digits',
            'asset.funds_source_id.required' => 'Sumber dana harus dipilih!',
            'asset.purchase_at.required' => 'Tanggal beli harus diisi!',
            'rack.*.warehouse_id.required' => 'Gudang penyimpanan harus dipilih!',
            'rack.*.id.numeric' => 'Rack harus dipilih!',
            'rack.*.qty.required' => 'Qty harus diisi!',
            'rack.*.qty.numeric' => 'Qty harus berupa angka!',
            'tag_ids.required' => 'Kategori harus dipilih!',
            'images.*.image' => 'File harus berupa gambar!',
            'images.*.max' => 'Gambar maksimal 4 MB'
        ];
    }
}
