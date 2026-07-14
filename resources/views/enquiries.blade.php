<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Demandes · PCN</title>
    <style>
        :root { color-scheme: dark; }
        * { box-sizing: border-box; }
        body { margin: 0; background: #0a1020; color: #e5eaf3; font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, sans-serif; }
        .wrap { max-width: 860px; margin: 0 auto; padding: 32px 20px 64px; }
        header { display: flex; align-items: baseline; justify-content: space-between; gap: 12px; border-bottom: 1px solid #1e293b; padding-bottom: 18px; margin-bottom: 24px; }
        h1 { font-size: 22px; margin: 0; letter-spacing: .04em; }
        .count { color: #60a5fa; font-weight: 700; font-size: 14px; }
        .empty { color: #7c8aa5; text-align: center; padding: 60px 0; }
        .card { background: #101a30; border: 1px solid #1e2a44; border-radius: 16px; padding: 20px; margin-bottom: 16px; }
        .top { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 12px; }
        .name { font-weight: 700; font-size: 17px; }
        .date { color: #6b7a97; font-size: 12px; white-space: nowrap; }
        .meta { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 12px; }
        .chip { font-size: 12px; background: #17233c; border: 1px solid #253a5c; border-radius: 999px; padding: 4px 12px; color: #b9c6de; }
        .chip a { color: #7db3ff; text-decoration: none; }
        .course { background: #14306a; border-color: #1d4ed8; color: #bcd3ff; }
        .msg { color: #cdd6e6; line-height: 1.6; white-space: pre-wrap; font-size: 15px; }
        .hint { color: #64748b; font-size: 12px; margin-top: 28px; text-align: center; }
        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 28px; }
        .stat { background: #101a30; border: 1px solid #1e2a44; border-radius: 14px; padding: 16px; text-align: center; }
        .stat .num { display: block; font-size: 26px; font-weight: 800; color: #fff; letter-spacing: .02em; }
        .stat .lbl { display: block; margin-top: 4px; font-size: 11px; text-transform: uppercase; letter-spacing: .12em; color: #6b7a97; }
        .stat.accent .num { color: #60a5fa; }
        @media (max-width: 560px) { .stats { grid-template-columns: repeat(2, 1fr); } }
    </style>
</head>
<body>
    <div class="wrap">
        <header>
            <h1>🥊 PCN - Tableau de bord</h1>
            <span class="count">{{ count($rows) }} demandes</span>
        </header>

        <div class="stats">
            <div class="stat accent">
                <span class="num">{{ number_format($visits['unique'] ?? 0) }}</span>
                <span class="lbl">Visiteurs</span>
            </div>
            <div class="stat">
                <span class="num">{{ number_format($visits['total'] ?? 0) }}</span>
                <span class="lbl">Pages vues</span>
            </div>
            <div class="stat">
                <span class="num">{{ number_format($todayVisits ?? 0) }}</span>
                <span class="lbl">Aujourd'hui</span>
            </div>
            <div class="stat">
                <span class="num">{{ count($rows) }}</span>
                <span class="lbl">Demandes</span>
            </div>
        </div>

        @forelse ($rows as $r)
            <div class="card">
                <div class="top">
                    <span class="name">{{ $r['name'] ?? 'Unknown' }}</span>
                    <span class="date">{{ $r['at'] ?? '' }}</span>
                </div>
                <div class="meta">
                    @if (!empty($r['email']))<span class="chip">✉ <a href="mailto:{{ $r['email'] }}">{{ $r['email'] }}</a></span>@endif
                    @if (!empty($r['phone']))<span class="chip">☎ <a href="tel:{{ $r['phone'] }}">{{ $r['phone'] }}</a></span>@endif
                    @if (!empty($r['course']))<span class="chip course">{{ $r['course'] }}</span>@endif
                </div>
                <div class="msg">{{ $r['message'] ?? '' }}</div>
            </div>
        @empty
            <div class="empty">Aucune demande pour le moment. Les messages envoyés depuis le formulaire de contact du site apparaîtront ici.</div>
        @endforelse

        <p class="hint">Page privée · rechargez pour actualiser. Modifiez l'accès dans <code>.env</code> (ENQ_USER / ENQ_PASS).</p>
    </div>
</body>
</html>
