<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\datasiswa;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // datasiswa::create([
        //     'Nisn' => 897326977692,
        //     'Nama_siswa' => 'Rahmat',
        //     'Jenis_kelamin' => 'laki laki',
        //     'Kelas_id' => 1,
        //     'Jurusan_id' => 1,
        //     'Alamat' => 'bondowoso',
        //     'No_Handphone' => 93827589237,
        //     'Nama_Ortu_Ayah' => 'garry',
        //     'Nama_Ortu_Ibu' => 'ayunda',
        //     'No_Handphone_Ayah' => 847648976489,
        //     'No_Handphone_Ibu' => 4968490690
        // ]);
        role::create([
            'nama_role'=> 'admin'
        ]);

        role::create([
            'nama_role'=> 'superadmin'
        ]);

        role::create([
            'nama_role'=> 'operator'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin22'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'operator',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('operator22'),
            'role_id' => 2
        ]);

    }
}
