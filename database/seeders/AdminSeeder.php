<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\roleModel;
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
        $uuidEmployee = Str::uuid();
        employeesModel::create([
            'id'=>$uuidEmployee,
            'nama' => 'admin',
            'email' => 'admin@mail.com',
            'jenis_kelamin' => '0',
            'tempat_lahir' => 'restrict',
            'tanggal_lahir' => '2000-01-01',
            'foto'=>'default.jpg',
            'agama' => '0',
            'no_telp' => '111111111111',
            'alamat' => 'restrict'
        ]);

        $uuidUser = Str::uuid();
        $getRole = roleModel::where('role', 'admin')->firstOrFail();
        User::create([
            'id'=> $uuidUser,
            'username' => 'admin@mail.com',
            'password' => Hash::make('111111111111'),
            'id_role' => $getRole->id,
            'id_employee' => $uuidEmployee
        ]);
    }
}
