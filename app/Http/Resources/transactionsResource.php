<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class transactionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'kode_produk'=>$this->kode_produk,
            'jumlah'=>$this->jumlah,
            'tanggal_transaksi'=>$this->tanggal_transaksi,
            'waktu_transaksi'=>$this->waktu_transaksi,
            'pegawai_melayani'=>$this->pegawai_melayani,
            'keterangan'=>$this->keterangan,
            'status'=>$this->status
        ];
    }
}
