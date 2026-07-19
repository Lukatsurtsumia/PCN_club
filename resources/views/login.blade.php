<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Connexion &middot; PCN</title>
    <style>
        :root { color-scheme: dark; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px;
               background: radial-gradient(ellipse at top, #14213f, #0a1020 70%); color: #e5eaf3;
               font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; }
        .card { width: 100%; max-width: 390px; background: #101a30; border: 1px solid #1e2a44; border-radius: 22px;
                padding: 38px 32px; box-shadow: 0 25px 70px rgba(0,0,0,.45); }
        .logo { text-align: center; font-weight: 800; font-size: 24px; letter-spacing: .06em; }
        .logo span { color: #60a5fa; }
        .sub { text-align: center; color: #7c8aa5; font-size: 13px; margin: 6px 0 30px; }
        label { display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em;
                color: #8ea0bd; margin-bottom: 7px; }
        input { width: 100%; background: #0a1020; border: 1px solid #253a5c; border-radius: 12px; padding: 13px 15px;
                color: #fff; font-size: 15px; outline: none; transition: border-color .2s, box-shadow .2s; margin-bottom: 20px; }
        input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.2); }
        button { width: 100%; background: #2563eb; color: #fff; border: none; border-radius: 999px; padding: 14px;
                 font-size: 15px; font-weight: 700; letter-spacing: .02em; cursor: pointer; transition: background .2s, transform .1s; }
        button:hover { background: #3b82f6; }
        button:active { transform: translateY(1px); }
        .err { background: #3b1220; border: 1px solid #7f1d1d; color: #fca5a5; border-radius: 10px; padding: 11px 14px;
               font-size: 13px; margin-bottom: 20px; text-align: center; }
        .back { display: block; text-align: center; margin-top: 22px; color: #64748b; font-size: 13px; text-decoration: none; }
        .back:hover { color: #94a3b8; }
    </style>
</head>
<body>
    <form class="card" method="POST" action="{{ route('profile.login') }}">
        @csrf
        <div class="logo">PCN <span>ADMIN</span></div>
        <div class="sub">Tableau de bord privé</div>

        @if ($errors->any())
            <div class="err">{{ $errors->first() }}</div>
        @endif

        <label for="username">Nom d'utilisateur</label>
        <input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" autofocus required>

        <label for="password">Mot de passe</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>

        <button type="submit">Se connecter</button>
        <a class="back" href="/">&larr; Retour au site</a>
    </form>
</body>
</html>
