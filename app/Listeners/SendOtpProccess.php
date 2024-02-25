<?php

namespace App\Listeners;

use App\Events\SendOtp;
use App\Mail\ForgetPassword;
use App\Mail\OtpCode;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Mail;

class SendOtpProccess
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendOtp $event): void
    {
        $user = User::where('email', $event->email)->first();

        $otp = (new Otp)->generate($event->email, 'numeric', 4);
        if (! $event->resetPassword) {
            Mail::to($user)->send(new OtpCode($otp->token));
        } else {
            Mail::to($user)->send(new ForgetPassword($otp->token));

        }


    }
}
