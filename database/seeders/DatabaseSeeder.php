<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

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
        // $faker = Faker::create();
        // foreach(range(1,9) as $index)
        // {
        //     DB::table('anggotas')->insert([
        //         'id_anggota'=>$faker->unique()->randomDigitNotNull,
        //         'name'=>$faker->name,
        //         'tmlahir'=>$faker->city,
        //         'tglahir'=>$faker->dateTime,
        //         'alamat'=>$faker->address,
        //         'ktp'=>$faker->randomNumber,
        //         'pendidikan'=>$faker->randomLetter,
        //         'Pekerjaan'=>$faker->jobTitle,
        //         'hp'=>$faker->phoneNumber
        //     ]);
        // }
        User::create([
            'level' => 'superadmin',
            'name' => 'Tomi',
            'username' => 'tomi',
            'password' => bcrypt('koperasi1')
        ]);
        User::create([
            'level' => 'admin',
            'name' => 'Mufidz',
            'username' => 'mufidz',
            'password' => bcrypt('mufidz12345')
        ]);
    }
}
