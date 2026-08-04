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
    | { name, email, phone, course, message } to this URL. It hits the PCN
    | Cloudflare Worker (workers/contact-worker) which relays the message by
    | email via Resend.
    |
    | Default = the branded pcnboxe.com route. For this to work the worker must
    | be attached to that path in Cloudflare (once only):
    |   Workers & Pages -> pcnboxe-contact-worker -> Settings -> Domains & Routes
    |   -> Add Route:  pcnboxe.com/api/contact*   (zone: pcnboxe.com)
    |
    | Until that route exists, pcnboxe.com/api/contact returns 405 (the static
    | site rejects POST). Fallback that works with zero Cloudflare setup:
    |   PCN_CONTACT_ENDPOINT=https://pcnboxe-contact-worker.pcnboxe06.workers.dev
    |
    | Override anytime via the PCN_CONTACT_ENDPOINT env var (Coolify variable in
    | production) without touching code.
    |
    */

    'contact_endpoint' => env(
        'PCN_CONTACT_ENDPOINT',
        'https://pcnboxe.com/api/contact'
    ),

];
