<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Private admin inbox credentials
    |--------------------------------------------------------------------------
    |
    | Login for the private dashboard at /profile (visitor stats + messages).
    | Set ENQ_USER / ENQ_PASS in the environment (Coolify variables in
    | production, .env locally). Never commit real credentials.
    |
    */

    'admin_user' => env('ENQ_USER', 'admin'),

    'admin_pass' => env('ENQ_PASS'),

];
