<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    |
    | If you're using API credentials, change these settings. Get your
    | credentials from https://dashboard.nexmo.com | 'Settings'.
    |
    */

    'api_key'    => function_exists('env') ? env('NEXMO_KEY', '') : '5932e432',
    'api_secret' => function_exists('env') ? env('NEXMO_SECRET', '') : 'FwzW1c74hpAkYtHr',

    /*
    |--------------------------------------------------------------------------
    | Signature Secret
    |--------------------------------------------------------------------------
    |
    | If you're using a signature secret, use this section. This can be used
    | without an `api_secret` for some APIs, as well as with an `api_secret`
    | for all APIs.
    |
    */

    'signature_secret' => function_exists('env') ? env('NEXMO_SIGNATURE_SECRET', '') : '',

    /*
    |--------------------------------------------------------------------------
    | Private Key
    |--------------------------------------------------------------------------
    |
    | Private keys are used to generate JWTs for authentication. Generation is
    | handled by the library. JWTs are required for newer APIs, such as voice
    | and media
    |
    */

    'private_key' => function_exists('env') ? env('NEXMO_PRIVATE_KEY', '') : '-----BEGIN PUBLIC KEY-----
    MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4hiHcx/7NUrdeKFCklh0
    SCKKpMkCewf+kHHtb1LSueCRaSo+JvGTJ8YLYGDiEbyrwJRHXF4fFeA+EBidligO
    YZ9C69Xb62NpFKieF63ySPSRnzdP2eyva/wXMeDJBmbO/+w50ue7lsXuPLD+DGba
    yXgis2mCl75sKELK8NyBNlaNJYHLQvqUi3kmToJRVIpO8xA6H3F7JAKj/6s4JdOM
    4PCIe7/SLfaimFBx1jQ9baX0Aba2ZqOyfvehrPkOJAGaQtx9dWGuzcoZzNU5DJOD
    o+lWerFYrsEPbCgVBgkmB883PWvE4VPoMmCFUJqNkuxZV1vbAPpKLHU5eTVzjsig
    nQIDAQAB
    -----END PUBLIC KEY-----
    ',
    'application_id' => function_exists('env') ? env('NEXMO_APPLICATION_ID', '') : '7e4a23cf-6aa6-47a7-9d40-582b3791c03e',

    /*
    |--------------------------------------------------------------------------
    | Application Identifiers
    |--------------------------------------------------------------------------
    |
    | Add an application name and version here to identify your application when
    | making API calls
    |
    */

    'app' => ['name' => function_exists('env') ? env('NEXMO_APP_NAME', 'NexmoLaravel') : 'speedShipping',
    'version' => function_exists('env') ? env('NEXMO_APP_VERSION', '1.1.2') : '1.1.2'],

    /*
    |--------------------------------------------------------------------------
    | Client Override
    |--------------------------------------------------------------------------
    |
    | In the event you need to use this with nexmo/client-core, this can be set
    | to provide a custom HTTP client.
    |
    */

    'http_client' => function_exists('env') ? env('NEXMO_HTTP_CLIENT', '') : '',
];