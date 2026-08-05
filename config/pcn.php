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
    | Default = the deployed workers.dev URL. This works out of the box with
    | ZERO Cloudflare setup (the worker is already live, CORS is open), so it's
    | the simplest option for whoever deploys the fork.
    |
    | To later use a branded URL on pcnboxe.com, attach the worker to a route in
    | Cloudflare (once only):
    |   Workers & Pages -> pcnboxe-contact-worker -> Settings -> Domains & Routes
    |   -> Add Route:  pcnboxe.com/api/contact*   (zone: pcnboxe.com)
    | then set  PCN_CONTACT_ENDPOINT=https://pcnboxe.com/api/contact
    |
    | Override anytime via the PCN_CONTACT_ENDPOINT env var (Coolify variable in
    | production) without touching code.
    |
    */

    'contact_endpoint' => env(
        'PCN_CONTACT_ENDPOINT',
        'https://pcnboxe-contact-worker.pcnboxe06.workers.dev'
    ),

    /*
    |--------------------------------------------------------------------------
    | Cloudflare Turnstile (spam / bot protection on the contact form)
    |--------------------------------------------------------------------------
    |
    | Public "Site Key" from Cloudflare Dashboard -> Turnstile -> Add Site.
    | Register it for the domain(s) the form is actually served on (e.g.
    | pcn.boxeros.app / pugilistclubnicois.fr) or the widget won't validate.
    |
    | Leave EMPTY to disable Turnstile — the form then works without it. Only
    | when a real key is set does the widget render and a token get required.
    | The private "Secret Key" is NOT used here; it lives on the worker, which
    | must verify the token server-side against Cloudflare's siteverify API.
    |
    */

    // Turnstile stays OFF until the key is confirmed to allow the live domain.
    // To enable: set PCN_TURNSTILE_SITE_KEY=0x4AAAAAAEGUaJ2zYPn1GeQU (or put it
    // as the default below) once the key's registered domains include the site's
    // real host (e.g. pcn.boxeros.app) + localhost for testing.
    'turnstile_site_key' => env('PCN_TURNSTILE_SITE_KEY'),

];
