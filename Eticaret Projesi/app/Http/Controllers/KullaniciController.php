<?php

namespace App\Http\Controllers;

use App\Mail\KullaniciKayitMail;
use App\Models\SepetUrun;
use App\Models\Sepet;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;




  
class KullaniciController extends Controller
{
    public function giris_form(){
        return view('kullanici.oturumac'); 
    }

    public function giris(){
       $this->validate(request(),[
        'email'=>'required|email',
        'sifre'=>'required'
       ]); 
       if(Auth::attempt(['email'=>request('email'),'password'=>request('sifre')],request()->has('benihatirla')))
       {
        request()->session()->regenerate();

        $aktif_sepet_id = Sepet::firstOrCreate(['kullanici_id'=>auth()->id()])->id;
        session()->put('aktif_sepet_id',$aktif_sepet_id);

        if(Cart::count()>0)
        {
            foreach (Cart::conten() as $cartItem)
             {
                 SepetUrun::updateOrCreate(
                     ['sepet_id'=>$aktif_sepet_id,'urun_id'=>$cartItem->id],
                     ['adet'=>$cartItem->qty,'fiyati'=>$cartItem->price,'durum'=>'Beklemede']
                 );
             }
        }
        Cart::destroy();
        $sepetUrunler = SepetUrun::with('urun')->where('sepet_id',$aktif_sepet_id)->get();
        foreach($sepetUrunler as $sepetUrun)
        {
            Cart::add($sepetUrun->urun->id,$sepetUrun->urun->urun_adi,$sepetUrun->adet,$sepetUrun->fiyati);
        }

        return redirect()->intended('/');

       }else{
           $errors = ['email'=>'Hatalı Giriş'];
           return back()->withErrors($errors);
       }
    }

    public function kaydol_form(){
        return view('kullanici.kaydol');
    }

     public function kaydol()
    {
        $this ->validate(request(),[
            'adsoyad'=>'required|min:5|max:60',
            'email'=>'required|email|unique:user',
           

        ]);

        $kullanici = User::create([
            'adsoyad' =>request('adsoyad'),
            'email' =>request('email'),
            'sifre' =>\Hash::make(request('sifre')),
            'aktivasyon_anahtarı' =>Str::random(60),
            'aktif_mi ' =>0 

        ]);
        Mail::to(request('email'))->send(new KullaniciKayitMail($kullanici)); 
        Auth::login($kullanici);

        return redirect()->route('anasayfa');
    }
    public function aktislestir($anahtar)
    {
        $kullanici = User ::where('aktivasyon_anahtari',$anahtar)->first();
   
          
            $kullanici->save();
            return redirect()->to('/')->with('mesaj','Kaydınız Aktifleşti')
            ->with('mesaj_tur','success')
            ;

        

    } 
    public function oturumukapat(){
        
        Auth::logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('anasayfa');
    }
}
