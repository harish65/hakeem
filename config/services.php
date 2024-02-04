<?php
$server = @$_SERVER['HTTP_HOST'];
$explode = explode('.',$server);
$result= [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'http://your-callback-url',
    ],

    'facebook' => [
        'client_id' => env('FB_CLIENT_ID'),
        'client_secret' => env('FB_CLIENT_SECRET'),
        'redirect' => env('FB_REDIRECT_URL'),
    ],
    'google' => [
        'client_id' => env('GM_CLIENT_ID'),
        'client_secret' => env('GM_CLIENT_SECRET'),
        'redirect' => env('GM_REDIRECT_URL'),
    ],
    // 'google'=>[
    //     'client_id' => '663594125312-eml3m76ou3aa5kkqjg65dovcqb9d0edb.apps.googleusercontent.com',
    //     'client_secret' => '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',
    //     'redirect' => 'https://hexalud.royoconsult.com/callback/google',
    // ],
    'stripe' =>[
        'secret' => env('STRIPE_TEST_KEY'),
    ],
    'authorize' =>[
        'login' => env('MERCHANT_LOGIN_ID'),
        'key' => env('MERCHANT_TRANSACTION_KEY'),
    ],
];
if($explode[0]=='telegreen'){
    $result['google']=[
            'client_id' => '228366500806-b3mcivnljjcvslec40jb4kr3116pqko0.apps.googleusercontent.com',
            'client_secret' => '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',
            'redirect' => 'https://telegreen.in/callback/google',
    ];
    $result['facebook'] =[
        'client_id' => '1601384093591052',
        'client_secret' => '45ba142e94c5008887125fda9043d12d',
        'redirect' => 'https://telegreen.in/callback/facebook',
    ];
}
if($explode[0] == 'hexalud'){
    $result['google']=[
        'client_id' => '663594125312-eml3m76ou3aa5kkqjg65dovcqb9d0edb.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://hexalud.royoconsult.com/callback/google',
];
    $result['facebook'] =[
        'client_id' => env('FB_CLIENT_ID'),
        'client_secret' => env('FB_CLIENT_SECRET'),
        'redirect' => env('FB_REDIRECT_URL'),
    ];
}
if($explode[0] == 'iedu'){
    $result['google']=[
        'client_id' => '928727066719-rq4p3m4o5i4cr6gudjblhimvr1qsec5m.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://iedu.ae/callback/google',
    ];
}
if($explode[0] == 'petpal'){
    
    $result['facebook'] =[
        'client_id' =>"1102489507058943",
        'client_secret' => "8b5b53985a605d1d7e9c9069754bafd5",
        'redirect' => "https://royoconsult.com/callback/facebook",
    ];
}
return $result;
