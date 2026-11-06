<?php
// Pastikan helper URL aktif (untuk base_url) dan beri nilai default agar view tidak error
helper('url');

$title     = $title     ?? 'Portofolio';
$nama      = $nama      ?? 'NAMA ANDA';
$jurusan   = $jurusan   ?? '';
$kampus    = $kampus    ?? '';
$tagline   = $tagline   ?? '';
$email     = $email     ?? '';
$telepon   = $telepon   ?? '';
$linkedin  = $linkedin  ?? '';
$sapaan    = $sapaan    ?? 'Dimas';
$foto      = $foto      ?? 'assets/img/foto.png';
$bg        = $bg        ?? 'assets/img/bg.jpg';
$ready     = $ready     ?? 'Ready to';
$ready_sub = $ready_sub ?? '';
$menu      = $menu      ?? [];
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
    :root {
        --blue: #1d4ed8;
        --blue-light: #5b8cff;
        --navy: #081850;
        /* Skala teks yang dipakai KIRI & KANAN agar seragam */
        --fs-head: clamp(1.05rem, 1.5vw, 1.55rem);
        --fs-body: clamp(.88rem, 1.08vw, 1.08rem);
        --fs-small: clamp(.72rem, .88vw, .86rem);
        --block-w: clamp(280px, 27vw, 470px);
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Poppins', sans-serif; background: var(--navy); color: #fff; -webkit-font-smoothing: antialiased; }

    /* ===== COVER ===== */
    .cover { position: relative; min-height: 100vh; min-height: 100svh; overflow: hidden; }
    .cover__bg {
        position: absolute; inset: 0;
        background: url('<?= base_url($bg) ?>') center/cover no-repeat, #274a8f;
        transform: scale(1.04);
    }
    .cover__overlay {
        position: absolute; inset: 0;
        background:
            linear-gradient(to top, rgba(6,18,64,.88) 0%, rgba(6,18,64,.35) 32%, rgba(6,18,64,0) 55%),
            linear-gradient(120deg, rgba(8,24,80,.82) 0%, rgba(29,78,216,.5) 55%, rgba(8,24,80,.82) 100%);
    }
    /* cahaya lembut di belakang foto */
    .cover__glow {
        position: absolute; z-index: 1; left: 50%; bottom: 0; transform: translateX(-50%);
        width: min(62vw, 900px); height: 82vh; pointer-events: none;
        background: radial-gradient(ellipse at 50% 65%, rgba(110,150,255,.5), rgba(110,150,255,0) 65%);
    }

    .cover__logo { position: absolute; top: 28px; left: 40px; z-index: 6; }

    /* Menu atas */
    .cover__nav {
        position: absolute; top: 28px; right: 40px; z-index: 6;
        display: flex; gap: 8px; flex-wrap: wrap; justify-content: flex-end;
    }
    .cover__nav a {
        color: #fff; text-decoration: none;
        font-size: .8rem; font-weight: 500;
        padding: 8px 16px; border-radius: 8px;
        background: rgba(29,78,216,.9);
        border: 1px solid rgba(255,255,255,.18);
        backdrop-filter: blur(6px);
        transition: transform .2s, background .2s, color .2s;
    }
    .cover__nav a:hover { background: #fff; color: var(--blue); transform: translateY(-2px); }

    /* PORTOFOLIO: di tengah, di belakang foto, tidak tertutup kepala */
    .cover__title {
        position: absolute; z-index: 2; left: 0; right: 0; top: 10.5vh;
        text-align: center; white-space: nowrap;
        font-weight: 800; line-height: 1; letter-spacing: .04em;
        font-size: min(9.5vw, 19vh);
        background: linear-gradient(180deg, #ffffff 35%, #bcd0ff 100%);
        -webkit-background-clip: text; background-clip: text;
        -webkit-text-fill-color: transparent; color: transparent;
        filter: drop-shadow(0 10px 28px rgba(4,12,60,.5));
    }

    /* Foto (PNG transparan) di depan, kepala di bawah tulisan */
    .cover__photo {
        position: absolute; z-index: 3; left: 0; right: 0; bottom: 0; margin: 0 auto;
        height: 75vh; max-width: 90%; object-fit: contain;
        filter: drop-shadow(0 18px 38px rgba(3,10,50,.55));
    }

    /* Blok teks kiri & kanan: lebar, posisi, dan skala font sama */
    .cover__left, .cover__right {
        position: absolute; z-index: 5; bottom: 7vh; width: var(--block-w);
    }
    .cover__left  { left: 5%; }
    .cover__right { right: 5%; text-align: right; }

    .pill {
        display: inline-block; font-weight: 600; font-size: var(--fs-head);
        line-height: 1.2; padding: 8px 20px; border-radius: 6px;
    }
    .pill--outline { border: 2px solid #fff; background: rgba(255,255,255,.08); backdrop-filter: blur(4px); }
    .pill--solid   { background: var(--blue); box-shadow: 0 8px 24px rgba(29,78,216,.45); }

    .text {
        margin-top: 14px; font-size: var(--fs-body); font-weight: 400; line-height: 1.6;
        text-shadow: 0 2px 12px rgba(4,12,60,.6);
    }
    .cover__left .text  { padding-left: 14px;  border-left: 3px solid var(--blue-light); }
    .cover__right .text { padding-right: 14px; border-right: 3px solid var(--blue-light); }

    .meta { margin-top: 12px; text-shadow: 0 2px 12px rgba(4,12,60,.6); }
    .meta small { display: block; font-size: var(--fs-small); font-weight: 600; letter-spacing: .06em; text-transform: uppercase; opacity: .9; }
    .meta span  { display: block; font-size: var(--fs-body); font-weight: 500; margin-top: 2px; }

    .actions { margin-top: 16px; display: flex; gap: 10px; flex-wrap: wrap; }
    .btn {
        font-size: var(--fs-small); font-weight: 600; text-decoration: none;
        padding: 10px 20px; border-radius: 6px; transition: transform .2s, background .2s, color .2s;
    }
    .btn--primary { background: #fff; color: var(--blue); }
    .btn--ghost   { border: 1.5px solid rgba(255,255,255,.7); color: #fff; }
    .btn:hover { transform: translateY(-2px); }
    .btn--ghost:hover { background: rgba(255,255,255,.15); }

    /* Animasi masuk */
    @keyframes rise { from { opacity: 0; transform: translateY(26px); } to { opacity: 1; transform: none; } }
    @keyframes fade { from { opacity: 0; } to { opacity: 1; } }
    .cover__title { animation: rise .9s ease both .05s; }
    .cover__photo { animation: rise 1s ease both .25s; }
    .cover__left  { animation: rise .9s ease both .5s; }
    .cover__right { animation: rise .9s ease both .65s; }
    .cover__nav, .cover__logo { animation: fade .8s ease both; }
    @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }

    /* ===== Layar kecil: susun ke bawah ===== */
    @media (max-width: 900px) {
        .cover { display: flex; flex-direction: column; align-items: center; padding: 170px 6% 40px; }
        .cover__nav { left: 20px; right: 20px; top: 84px; justify-content: flex-start; }
        .cover__title, .cover__photo, .cover__left, .cover__right, .cover__glow {
            position: relative; left: auto; right: auto; top: auto; bottom: auto;
        }
        .cover__title { font-size: 13vw; }
        .cover__photo { height: 48vh; margin-top: 12px; }
        .cover__glow  { display: none; }
        .cover__left, .cover__right { width: 100%; text-align: left; margin-top: 24px; }
        .cover__right .text { padding-right: 0; border-right: 0; padding-left: 14px; border-left: 3px solid var(--blue-light); }
    }
    </style>
</head>
<body>

<section class="cover" id="home">
    <div class="cover__bg"></div>
    <div class="cover__overlay"></div>
    <div class="cover__glow"></div>

    <!-- Logo -->
    <div class="cover__logo" aria-hidden="true">
        <svg viewBox="0 0 48 48" width="44" height="44" fill="#fff">
            <path d="M4 40 L20 8 L28 24 L20 24 Z"/>
            <path d="M24 40 L40 8 L44 16 L34 40 Z" opacity=".85"/>
        </svg>
    </div>

    <!-- Menu atas -->
    <nav class="cover__nav">
        <?php foreach ($menu as $m): ?>
           <a href="<?= site_url($m['id']) ?>"><?= esc($m['label']) ?></a>
        <?php endforeach; ?>
    </nav>

    <!-- PORTOFOLIO (di belakang foto) -->
    <h1 class="cover__title">PORTOFOLIO</h1>

    <!-- Foto -->
    <img class="cover__photo" src="<?= base_url($foto) ?>" alt="<?= esc($nama) ?>">

    <!-- Kiri bawah -->
    <div class="cover__left">
        <span class="pill pill--outline"><?= esc($ready) ?></span>
        <p class="text"><?= esc($ready_sub) ?></p>
        <?php if ($email !== ''): ?>
        <div class="actions">
            <a class="btn btn--ghost" href="mailto:<?= esc($email, 'attr') ?>">Hubungi Saya</a>
        </div>
        <?php endif; ?>
    </div>

    <!-- Kanan bawah -->
    <div class="cover__right">
        <span class="pill pill--solid"><?= esc($nama) ?></span>
        <p class="text"><?= esc($tagline) ?></p>
        <div class="meta">
            <small><?= esc($jurusan) ?></small>
            <span><?= esc($kampus) ?></span>
        </div>
    </div>
</section>

</body>
</html>