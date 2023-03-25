<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationSend extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(isset($this->user->seat_number) && isset($this->user->reception_seat_number)){
            $subject = 'ボーイスカウト日本連盟100周年記念式典・レセプションのご案内';
        }elseif(isset($this->user->seat_number) && empty($this->user->reception_seat_number)){
            $subject = 'ボーイスカウト日本連盟100周年記念式典のご案内';
        }elseif(empty($this->user->seat_number) && isset($this->user->reception_seat_number)){
            $subject = 'ボーイスカウト日本連盟100周年レセプションのご案内';
        }

        return $this->view('emails.invitation')
            ->subject($subject)
            ->with('user', $this->user);
    }
}
