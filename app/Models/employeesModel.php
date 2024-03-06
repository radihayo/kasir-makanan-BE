<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'agama',
        'no_telp',
        'alamat'
    ];
    protected $table = 'employees';

    public function data_users()
    {
        return $this->hasOne(usersModel::class, 'id_employee', 'id');
    }
}
