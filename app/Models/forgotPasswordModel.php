<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class forgotPasswordModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'email',
        'code'
    ];
    protected $table = 'forgot_password';
}
