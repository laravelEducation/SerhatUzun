<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\UrunDetay;
use App\Models\Urun;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriler = Kategori::whereRaw('ust_id is null')->get();
        $urunler_slider = UrunDetay::with('urun')->where('goster_slider',1)->take(5)->get();
        $urun_gunun_firsati = Urun::select('urun.*')
            ->join('urun_detay','urun_detay.urun_id','urun_id')
            ->where('urun_detay.goster_gunun_firsati',1)
            ->orderBy('updated_at','desc')
            ->first() ;
            $urunler_one_cikan =  Urun::select('urun.*')->join('urun_detay', 'urun_detay.urun_id', 'urun.id')->where('urun_detay.goster_one_cikan', 1)->take(4)->get();
            $urunler_cok_satan =  Urun::select('urun.*')->join('urun_detay', 'urun_detay.urun_id', 'urun.id')->where('urun_detay.goster_cok_satan', 1)->take(4)->get();
            $urunler_indirimli = Urun::select('urun.*')->join('urun_detay', 'urun_detay.urun_id', 'urun.id')->where('urun_detay.goster_indirimli', 1)->take(4)->get();

    /*    $urunler_one_cikan = Urun::with('urun.*')->where('goster_one_cikan', 1)->get();
        $urunler_cok_satan = Urun::with('urun.*')->where('goster_cok_satan', 1)->get();
        $urunler_indirimli = Urun::with('urun.*')->where('goster_indirimli', 1)->get();
*/
        return view ("anasayfa",compact('kategoriler','urunler_slider','urun_gunun_firsati','urunler_one_cikan'
        ,'urunler_cok_satan','urunler_indirimli'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
