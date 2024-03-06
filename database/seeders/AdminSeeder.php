<?php

namespace Database\Seeders;

use App\Models\roleModel;
use App\Models\usersModel;
use Illuminate\Support\Str;
use App\Models\employeesModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $uuid = Str::uuid();
        employeesModel::create([
            'id'=>$uuid,
            'nama' => 'admin',
            'email' => 'admin@mail.com',
            'jenis_kelamin' => '0',
            'tempat_lahir' => 'restrict',
            'tanggal_lahir' => '2000-01-01',
            'agama' => '0',
            'no_telp' => '111111111111',
            'alamat' => 'restrict'
        ]);

        $get_role = roleModel::where('role', 'admin')->firstOrFail();
        usersModel::create([
            'username' => 'admin@mail.com',
            'password' => Hash::make('111111111111'),
            'id_role' => $get_role->id,
            'id_employee' => $uuid
        ]);
    }
}
