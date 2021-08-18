<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // UrunTableSeeder::factory(10)->create();
       // $this->call(KategoriTableSeeder::class);
       $this->call([KategoriTableSeeder::class]);
       $this->call([UrunTableSeeder::class]);

    }
}
