<?php

return [

    'pesapal' => [
        'mode'      => env('PESAPAL_MODE', 'sandbox'),
        'username'  => env('PESAPAL_USERNAME', ''),
        'password'  => env('PESAPAL_PASSWORD', ''),
        'signature' => env('PESAPAL_SIGNATURE', ''),
    ],

];
