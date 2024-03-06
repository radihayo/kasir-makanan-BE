<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class transactionStoreRequest extends FormRequest
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
            'kode_produk' => 'required',
            'jumlah' => 'required',
            'tanggal_transaksi' => 'required',
            'waktu_transaksi' => 'required',
            'pegawai_melayani' => 'required',
            'keterangan'=>'required'
            // 'status' => 'required'
        ];
    }
}
