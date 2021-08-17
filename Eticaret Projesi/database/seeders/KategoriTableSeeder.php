<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->truncate();
        $id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Elektronik','slug'=>'elektronik']);
        DB::table('kategori')->insert(['kategori_adi'=>'Bilgisayar/Tablet','slug'=>'bilgisayar/tablet','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'TV ve Ses Sistemleri','slug'=>'tv/ses sistemi','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Kamera','slug'=>'kamera','ust_id'=>$id]);
        
        DB::table('kategori')->insert(['kategori_adi'=>'Kitap','slug'=>'kitap']);
        DB::table('kategori')->insert(['kategori_adi'=>'Dergi','slug'=>'dergi']);
        DB::table('kategori')->insert(['kategori_adi'=>'Mobilya','slug'=>'mobilya']);
        DB::table('kategori')->insert(['kategori_adi'=>'Sanat','slug'=>'sanat']);
        DB::table('kategori')->insert(['kategori_adi'=>'Kişisel Bakım','slug'=>'Kişisel Bakım']);
        DB::table('kategori')->insert(['kategori_adi'=>'Giyim','slug'=>'giyim']);
        DB::table('kategori')->insert(['kategori_adi'=>'Aksesuar','slug'=>'aksesuar']);


    }
}