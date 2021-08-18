<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class KullaniciKayitMail extends Mailable
{
    use Queueable, SerializesModels;


    public $kullanici;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $kullanici)
    {
        $this->kullanici = $kullanici;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('serhatuzun1295@gmail.com')
        ->subject(config('app.name').'- Kullanıcı Kaydı')
        ->view('mails.kullanici_kayit');
    }
}
