<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class employeesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'nama'=>$this->nama, 
            'email'=>$this->email, 
            'jenis_kelamin'=>$this->jenis_kelamin, 
            'tempat_lahir'=>$this->tempat_lahir, 
            'tanggal_lahir'=>$this->tanggal_lahir,
            'foto'=>$this->foto,
            'agama'=>$this->agama,
            'no_telp'=>$this->no_telp,
            'alamat'=>$this->alamat
        ];
    }
}
