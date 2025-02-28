<?php

use SadiqSalau\LaravelOtp\OtpNotification;

return [
    /*
    |--------------------------------------------------------------------------
    | OTP format
    |--------------------------------------------------------------------------
    |
    | Can be one of alpha, alphanumeric, numeric
    |
    */
    'format' => env('OTP_FORMAT', 'numeric'),

    /*
    |--------------------------------------------------------------------------
    | OTP characters length
    |--------------------------------------------------------------------------
    |
    | Number of characters of OTP
    |
    */
    'length' => env('OTP_LENGTH', 6),

    /*
    |--------------------------------------------------------------------------
    | OTP expiration
    |--------------------------------------------------------------------------
    |
    | Number of minutes before OTP expires
    |
    */
    'expires' => env('OTP_EXPIRES', 15),

    /*
    |--------------------------------------------------------------------------
    | OTP notification
    |--------------------------------------------------------------------------
    |
    | Notification to use for OTP
    |
    */
    'notification' => OtpNotification::class,
];
