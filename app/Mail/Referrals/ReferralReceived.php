<?php

namespace App\Mail\Referrals;

use App\User;
use App\Referral;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReferralReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;

    public $referral;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $sender, Referral $referral)
    {
        $this->sender = $sender;
        $this->referral = $referral;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->sender->name . ' has invited you.')
            ->markdown('emails.referrals.received');
    }
}
