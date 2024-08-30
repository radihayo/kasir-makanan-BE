<?php

namespace Database\Seeders;

use App\Models\roleModel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uuid1 = Str::uuid();
        $uuid2 = Str::uuid();
        $datas = [
            ['id' => $uuid1,'role' => 'admin'],
            ['id' => $uuid2,'role' => 'user']
        ];
        foreach($datas as $data){
            roleModel::create($data);
        }
    }
}
