<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('anasayfa');
});*/

/*Route::get('/', [App\Http\Controllers\AnasayfaController::class, 'index']);     => Bu da çalışıyor Aşağıda ki Route Tanımla Sistemide.*/


Route::get('/','App\Http\Controllers\AnasayfaController@index')->name('anasayfa');

Route::get('/kategori/{slug_kategoriadi}','App\Http\Controllers\KategoriController@index')->name('kategori');

Route::get('/urun/{slug_urunadi}','App\Http\Controllers\UrunController@index')->name('urun');

Route::post('/ara','App\Http\Controllers\UrunController@ara')->name('urun_ara');

Route::get('/ara','App\Http\Controllers\UrunController@ara')->name('urun_ara');

Route::group(['prefix'=>'sepet'],function(){

    Route::get('/','App\Http\Controllers\SepetController@index')->name('sepet');
    Route::post('/ekle','App\Http\Controllers\SepetController@ekle')->name('sepet.ekle');
    Route::delete('/kaldir/{rowId}','App\Http\Controllers\SepetController@kaldir')->name('sepet.kaldir');
    Route::delete('/bosalt','App\Http\Controllers\SepetController@bosalt')->name('sepet.bosalt');
    Route::patch('/guncelle/{rowId}','App\Http\Controllers\SepetController@guncelle')->name('sepet.guncelle');




});

Route::middleware(['auth'])->group(function(){
    Route::get('/odeme','App\Http\Controllers\OdemeController@index')->name('odeme');
    Route::get('/siparisler','App\Http\Controllers\SiparislerController@index')->name('siparisler');
    Route::get('/siparisler/{id}','App\Http\Controllers\SiparislerController@detay')->name('siparis');
});


Route::group(['prefix'=>'kullanici'],function(){

    Route::get('/oturumac','App\Http\Controllers\KullaniciController@giris_form')->name('kullanici.oturumac');
    Route::post('/oturumac','App\Http\Controllers\KullaniciController@giris');

    Route::get('/kaydol','App\Http\Controllers\KullaniciController@kaydol_form')->name('kullanici.kaydol');
    Route::post('/kaydol','App\Http\Controllers\KullaniciController@kaydol');

    Route::get('/aktiflestir/{anahtar}','App\Http\Controllers\KullaniciController@aktiflestir')->name('aktiflestir');
    Route::post('/oturumukapat','App\Http\Controllers\KullaniciController@oturumukapat')->name('kullanici.oturumukapat');

});

Route::get('/test/mail',function(){
    $kullanici = \App\Models\User::find(2);
    return new App\Mail\KullaniciKayitMail($kullanici);
});



