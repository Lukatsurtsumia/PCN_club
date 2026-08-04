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

    /*
    |--------------------------------------------------------------------------
    | Contact form endpoint
    |--------------------------------------------------------------------------
    |
    | The homepage contact form POSTs a JSON payload
    | { name, email, phone, course, message } to this URL. It points at the
    | PCN Cloudflare Worker (workers/contact-worker) which relays the message
    | by email via Resend. Override with PCN_CONTACT_ENDPOINT (Coolify variable
    | in production) to switch to the custom domain route once it's live, e.g.
    | https://pugilistclubnicois.fr/api/contact
    |
    */

    'contact_endpoint' => env(
        'PCN_CONTACT_ENDPOINT',
        'https://pcnboxe-contact-worker.pcnboxe06.workers.dev'
    ),

];
