<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kode_produk' => 'required|size:5|unique:products,kode_produk',
            'nama_produk' => 'required|max:50',
            'harga' => 'required',
            'deskripsi' => 'required'
        ];
    }

    public function messages():array
    {
        return[
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada',
            'kode_produk.size' => 'Panjang Harus 5',
            'nama_produk.max' => 'Panjang Maksimal 50',
        ];
    }
}
