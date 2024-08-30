<?php

namespace App\Models;

use App\Models\User;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class employeesModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'id',
        'nama', 
        'email', 
        'jenis_kelamin', 
        'tempat_lahir', 
        'tanggal_lahir',
        'foto',
        'agama',
        'no_telp',
        'alamat'
    ];
    protected $table = 'employees';

    public function data_users()
    {
        return $this->hasOne(User::class, 'id_employee', 'id');
    }
}
