<?php

namespace App\Http\Controllers;

use App\Models\SepetUrun;
use App\Models\Urun;
use App\Models\Sepet;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;



use Illuminate\Http\Request;
use Validator;

//vendor\bumbummen99\shoppingcart\src\Facades\Cart.php
class SepetController extends Controller    
{
    public function __construct()
    {
        $this->middleware('auth');
    }
       
        
    public function index(){
        return view ('sepet');
        
    }

    public function ekle(){
       
        $urun = Urun::find(request('id'));
        
        $cartItem = Cart::add($urun->id, $urun->urun_adi, 1 , $urun->fiyati, 0, 
        );

        if(auth()->check()){
            $aktif_sepet_id = session(('aktif_sepet_id'));
            if(!isset($aktif_sepet_id))
            {
            $aktif_sepet = Sepet::create([
                'kullanici_id'=>auth()->id()

            ]);
            $aktif_sepet_id = $aktif_sepet->id;
            session()->put('aktif_sepet_id',$aktif_sepet_id);
            }

            SepetUrun::updateOrCreate(
                ['sepet_id'=>$aktif_sepet_id,'urun_id'=>$urun->id],
                ['adet'=>$cartItem->qty,'fiyati'=>$urun->fiyati,'durum'=>'Beklemede']
            );
        }
        
        return redirect()->route('sepet')
        ->with('mesaj_tur','success')
        ->with('mesaj','Ürün Sepete Eklendi');
        
    }

    public function kaldir($rowId){
        if (auth()->check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($rowId);
            SepetUrun::where('sepet_id', $aktif_sepet_id)->where('urun_id', $cartItem->id)->delete();
        }

        Cart::remove($rowId);
        return redirect()->route('sepet')
        ->with('mesaj_tur','success')
        ->with('mesaj','Ürün Sepetten Kaldırıldı ');
    }

    public function bosalt(){
        if (auth()->check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            SepetUrun::where('sepet_id', $aktif_sepet_id)->delete();
        }
        Cart::destroy();

        return redirect()->route('sepet')
        ->with('mesaj_tur','success')
        ->with('mesaj','Sepetiniz Boşaltıldı');
    }    
    
    public function guncelle($rowId){

        $validator = Validator::make(request()->all(),[
            'adet'=>'required|numeric|between:1,2'

        ]);

        if($validator->fails())
        {
            session()->flash('mesah_tur','danger');
            session()->flash('mesah','Adet Değeri 1-5 arasında olmalıdır');
            return response()->json(['success'=>false]);
        }
        
        if (auth()->check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($rowId);

            if(request('adet')==0)
            {
                SepetUrun::where('sepet_id', $aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();

            }
            else{
            SepetUrun::where('sepet_id', $aktif_sepet_id)->where('urun_id',$cartItem->id)
            ->update(['adet'=>request('adet')]) ;
        }}


        Cart::update($rowId,request('adet'));

        session()->flash('mesah_tur','success');
        session()->flash('mesah','Adet Bilgisi Güncell endi');
        return response()->json(['success'=>TRUE]);
    }    
}
