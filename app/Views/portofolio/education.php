<?php
// Halaman Education. Semua variabel punya nilai default agar tidak error.
helper('url');

$title      = $title      ?? 'Education';
$nama       = $nama       ?? 'NAMA ANDA';
$menu       = $menu       ?? [];
$aktif      = $aktif      ?? 'education';
$judul      = $judul      ?? 'Education';
$subjudul   = $subjudul   ?? '';
$ringkasan  = $ringkasan  ?? '';
$pendidikan = $pendidikan ?? [];   // kartu besar (kolom kiri)
$samping    = $samping    ?? [];   // kartu kecil (kolom kanan)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.documentElement.classList.add('js')</script>
    <title><?= esc($title) ?> | <?= esc($nama) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-top: #050b1f;
            --bg-mid: #0a1e4a;
            --bg-glow: #1c4fb8;
            --accent: #ffd43b;
            --accent-text: #1a1a1a;
            --card-border: rgba(140, 180, 255, .35);
            --card-bg: rgba(255, 255, 255, .06);
            --text: #ffffff;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { min-height: 100%; }

        body {
            font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Arial, sans-serif;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            background:
                radial-gradient(ellipse 70% 55% at 25% 100%, var(--bg-glow) 0%, transparent 70%),
                linear-gradient(180deg, var(--bg-top) 0%, var(--bg-mid) 100%);
            background-attachment: fixed;
            min-height: 100vh;
        }

        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 22px 40px 48px;
        }

        /* ---------- Header ---------- */
        .topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 26px;
            position: relative;
            z-index: 10;
        }

        .topbar__logo { display: block; flex: 0 0 auto; }

        .topbar__nav {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: flex-end;
            list-style: none;
        }

        .topbar__nav a {
            display: block;
            color: #fff;
            text-decoration: none;
            font-size: .8rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            background: rgba(29, 78, 216, .9);
            border: 1px solid rgba(255, 255, 255, .18);
            white-space: nowrap;
            transition: transform .2s, background .2s, color .2s;
        }

        .topbar__nav a:hover { background: #fff; color: #1d4ed8; transform: translateY(-2px); }

        .topbar__nav a.is-active,
        .topbar__nav a.is-active:hover {
            background: var(--accent);
            color: var(--accent-text);
            font-weight: 600;
        }

        .topbar__nav a:focus-visible,
        .topbar__logo:focus-visible {
            outline: 2px solid #fff;
            outline-offset: 3px;
        }

        /* ---------- Judul besar ---------- */
        .hero { margin-bottom: 22px; }

        .hero h1 {
            font-size: clamp(34px, 6vw, 60px);
            font-weight: 800;
            font-style: italic;
            line-height: 1.05;
            letter-spacing: -.01em;
            background: linear-gradient(90deg, #2f6bff 0%, #ffffff 85%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
        }

        .hero-card {
            margin-top: 14px;
            padding: 14px 20px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            backdrop-filter: blur(4px);
            font-size: 15px;
            font-weight: 600;
            line-height: 1.5;
        }

        .hero-card .lbl { color: var(--accent); font-weight: 800; }

        /* ---------- Grid kartu ---------- */
        .grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 22px;
            align-items: start;
        }

        .col { display: grid; gap: 22px; min-width: 0; }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 20px 24px;
            backdrop-filter: blur(4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .3);
        }

        .card h2 {
            color: var(--accent);
            font-weight: 800;
            font-size: 26px;
            line-height: 1.15;
            margin-bottom: 4px;
        }

        .col--side .card h2 { font-size: 20px; margin-bottom: 12px; }

        .edu__major {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .edu__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .badge {
            background: #1f4fc4;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, .18);
        }

        .badge--gold {
            background: var(--accent);
            color: var(--accent-text);
            border-color: transparent;
        }

        .card ul { list-style: none; display: grid; gap: 8px; }

        .card li {
            display: grid;
            grid-template-columns: 16px 1fr;
            font-size: 13.5px;
            line-height: 1.6;
            text-align: justify;
        }

        .card li::before { content: "\2022"; font-weight: 700; font-size: 18px; line-height: 1.3; }

        .card li strong { color: var(--accent); font-weight: 700; }

        .col--side .card li { font-size: 13px; text-align: left; }

        /* ---------- Animasi muncul saat di-scroll (hanya bila JS aktif) ---------- */
        .js .reveal { opacity: 0; transform: translateY(22px); transition: opacity .7s ease, transform .7s ease; }
        .js .reveal.in { opacity: 1; transform: none; }
        @media (prefers-reduced-motion: reduce) { .js .reveal { opacity: 1; transform: none; transition: none; } }

        /* ---------- Responsive ---------- */
        @media (max-width: 860px) {
            .grid { grid-template-columns: 1fr; }
            .card h2 { font-size: 22px; }
        }

        @media (max-width: 720px) {
            .page { padding: 20px 18px 40px; }
            .topbar { flex-wrap: wrap; }
            .topbar__nav { justify-content: flex-start; flex-basis: 100%; }
            .card { padding: 16px 18px; }
            .card li { text-align: left; }
        }
    </style>
</head>
<body>
<main class="page">

    <!-- Header: logo + menu -->
    <header class="topbar">
        <a class="topbar__logo" href="<?= base_url('/') ?>" aria-label="Kembali ke halaman depan">
            <svg viewBox="0 0 48 48" width="40" height="40" fill="#fff">
                <path d="M4 40 L20 8 L28 24 L20 24 Z"/>
                <path d="M24 40 L40 8 L44 16 L34 40 Z" opacity=".85"/>
            </svg>
        </a>

        <nav aria-label="Menu portofolio">
            <ul class="topbar__nav">
                <?php foreach ($menu as $m): ?>
                    <?php $isActive = (($m['id'] ?? '') === $aktif); ?>
                    <li>
                        <a href="<?= site_url($m['id'] ?? '') ?>"
                           class="<?= $isActive ? 'is-active' : '' ?>"
                           <?= $isActive ? 'aria-current="page"' : '' ?>>
                            <?= esc($m['label'] ?? '') ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>

    <!-- Judul -->
    <section class="hero">
        <h1><?= esc($judul) ?></h1>
        <?php if ($ringkasan !== ''): ?>
            <div class="hero-card">
                <?php if ($subjudul !== ''): ?><span class="lbl"><?= esc($subjudul) ?> :</span><?php endif; ?>
                <?= esc($ringkasan) ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- Kartu -->
    <section class="grid">

        <!-- Kolom kiri: riwayat pendidikan -->
        <div class="col">
            <?php foreach ($pendidikan as $e): ?>
                <article class="card">
                    <h2><?= esc($e['institusi'] ?? '') ?></h2>

                    <?php if (! empty($e['jurusan'])): ?>
                        <p class="edu__major"><?= esc($e['jurusan']) ?></p>
                    <?php endif; ?>

                    <div class="edu__meta">
                        <?php if (! empty($e['periode'])): ?><span class="badge"><?= esc($e['periode']) ?></span><?php endif; ?>
                        <?php if (! empty($e['lokasi'])): ?><span class="badge"><?= esc($e['lokasi']) ?></span><?php endif; ?>
                        <?php if (! empty($e['ipk'])): ?><span class="badge badge--gold"><?= esc($e['ipk']) ?></span><?php endif; ?>
                    </div>

                    <?php if (! empty($e['poin'])): ?>
                        <ul>
                            <?php foreach ($e['poin'] as $p): ?>
                                <li>
                                    <span>
                                        <?php if (! empty($p['label'])): ?>
                                            <strong><?= esc($p['label']) ?> :</strong>
                                        <?php endif; ?>
                                        <?= esc($p['isi'] ?? '') ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- Kolom kanan: kartu kecil -->
        <div class="col col--side">
            <?php foreach ($samping as $s): ?>
                <article class="card">
                    <h2><?= esc($s['judul'] ?? '') ?></h2>
                    <ul>
                        <?php foreach (($s['poin'] ?? []) as $p): ?>
                            <li><span><?= esc($p) ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endforeach; ?>
        </div>

    </section>

</main>

<script>
// Animasi muncul saat masuk layar (sama seperti halaman About)
(function () {
    var els = document.querySelectorAll(
        '.topbar, .hero h1, .hero-card, .grid .card'
    );
    if (!els.length) return;

    els.forEach(function (e) { e.classList.add('reveal'); });

    if (!('IntersectionObserver' in window)) {
        els.forEach(function (e) { e.classList.add('in'); });
        return;
    }

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
            if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); }
        });
    }, { threshold: .12 });

    els.forEach(function (e) { io.observe(e); });
})();
</script>
</body>
</html>