<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'firebase' => [
        'firebase_api_key' => env('FIREBASE_API_KEY')
    ],

    'pintaria' => [
        'client_id' => env('PINTARIA_SSO_CLIENT_ID'),
        'client_secret' => env('PINTARIA_SSO_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . '/oauth/callback',
        'contact' => env('AHMENG_CONTACT_URL'),
        'welcome' => env('AHMENG_WELCOME_URL'),
        'referral' => env('AHMENG_REFERRAL_URL'),
    ],

    'pintaria_auth_provider' => [
        'url' => env('PINTARIA_AUTH_PROVIDER_URL'),
        'user_url' => env('PINTARIA_AUTH_PROVIDER_URL') . '/api/user',
        'auth_url' => env('PINTARIA_AUTH_PROVIDER_URL') . '/oauth/authorize',
        'token_url' => env('PINTARIA_AUTH_PROVIDER_URL') . '/oauth/token',
        'register_url' => env('PINTARIA_AUTH_PROVIDER_URL') . '/daftar',
    ],

    'lms' => [
        'url' => env('LMS_ENDPOINT'),
        'api_url' => env('LMS_API_ENDPOINT'),
    ],

    'midtrans' => [
        'client_key' => env('MIDTRANS_CLIENT_KEY'),
        'server_key' => env('MIDTRANS_SERVER_KEY'),
    ],

    'mutual' => [
        'check_promo_url' => env('MUTUAL_API_URL') . '/promotions_check',
        'check_user_promo_url' => env('MUTUAL_API_URL') . '/referral_check',
        'referrer_reward_url' => env('MUTUAL_API_URL') . '/referrer_rewards',
        'generate_referral_code_url' => env('MUTUAL_API_URL') . '/generate',
    ],

    'gcs_image_domain' => [
        'url' => env('GCS_IMAGE_DOMAIN_URL'),
    ],
    'recaptcha_client_key' => env('RECAPTCHA_CLIENT_KEY'),

    'barantum' => [
        'login_url' => env('BARANTUM_URL') . 'login',
        'save_data_url' => env('BARANTUM_URL') . 'save_data',
    ],

    'sendgrid' => [
        'sendgrid_api_key' => env('SENDGRID_API_KEY'),
    ],

    'akulaku' => [
        'app_id' => env('AKULAKU_APP_ID'),
        'secret_key' => env('AKULAKU_SECRET_KEY'),
    ],
];
