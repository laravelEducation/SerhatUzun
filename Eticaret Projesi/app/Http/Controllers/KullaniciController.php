<?php

namespace App\Http\Controllers;

use App\Mail\KullaniciKayitMail;
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
