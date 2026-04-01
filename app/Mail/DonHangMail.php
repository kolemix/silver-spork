<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonHangMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donHang;

    public function __construct($donHang)
    {
        $this->donHang = $donHang;
    }

    public function build()
    {
        return $this->subject('Đặt hàng thành công!')
                    ->view('emails.don_hang');
    }
}