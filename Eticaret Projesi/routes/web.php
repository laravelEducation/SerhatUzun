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

Route::get('/sepet','App\Http\Controllers\SepetController@index')->name('sepet');

Route::get('/odeme','App\Http\Controllers\OdemeController@index')->name('odeme');

Route::get('/siparisler','App\Http\Controllers\SiparislerController@index')->name('siparisler');

Route::get('/siparisler/{id}','App\Http\Controllers\SiparislerController@detay')->name('siparis');

Route::group(['prefix'=>'kullanici'],function(){

    Route::get('/oturumac','App\Http\Controllers\KullaniciController@giris_form')->name('kullanici.oturumac');
    Route::get('/kaydol','App\Http\Controllers\KullaniciController@kaydol_form')->name('kullanici.kaydol');

});




