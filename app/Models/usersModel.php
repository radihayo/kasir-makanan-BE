<?php

namespace App\Models;

use App\Models\roleModel;
use App\Models\employeesModel;
use App\Traits\UUIDAsPrimaryKey;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class usersModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable, UUIDAsPrimaryKey;
    protected $fillable = [
        'username',
        'password',
        'id_role',
        'id_employee'
    ];
    protected $table = 'users';

    // public function employee_data(): HasOne
    // {
    //     return $this->hasOne(employeesModel::class, 'id_employee', 'id');
    // }

    public function role_data()
    {
        return $this->belongsTo(roleModel::class, 'id_role', 'id');
    }

    public function employee_data()
    {
        return $this->belongsTo(employeesModel::class, 'id_employee', 'id');
    }
}
