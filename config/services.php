<?php

return [

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

    /*
    |--------------------------------------------------------------------------
    | Sales Confirmation API
    |--------------------------------------------------------------------------
    |
    | Configuration for the Sales Confirmation Voice Call API
    |
    */
    'sales_confirmation' => [
        'url' => env('SALES_CONFIRMATION_API_URL', 'https://voicebox.wetechhub.com/api/sale-confirmation/send-sales-confirmation'),
        'api_key' => env('SALES_CONFIRMATION_API_KEY', ''),
        'enabled' => env('SALES_CONFIRMATION_ENABLED', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | BD Courier API (Fraud Check)
    |--------------------------------------------------------------------------
    |
    | Configuration for the BD Courier Fraud Check API
    |
    */
    'bd_courier' => [
        'url' => env('BD_COURIER_API_URL', 'https://api.bdcourier.com/courier-check'),
        'api_key' => env('BD_COURIER_API_KEY', ''),
        'enabled' => env('BD_COURIER_ENABLED', true),
    ],

];
