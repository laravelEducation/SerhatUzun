<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UrunTableSeeder extends Seeder
{
    public static function factory(int $int)
    {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("urun")->insert([
            'urun_adi'=>str::random(5),
            'fiyati' =>5.4,
            'aciklama'=>'meyve'
        ]);
    }
}
