<?php
// Halaman Selected Project (maksimal 3 project, dipilih lewat tab).
// Semua variabel punya nilai default agar tidak error.
helper('url');

$title  = $title  ?? 'Selected Project';
$nama   = $nama   ?? 'NAMA ANDA';
$menu   = $menu   ?? [];
$aktif  = $aktif  ?? 'project';

$projects = $projects ?? [];
$projects = array_slice(array_values($projects), 0, 3); // maksimal 3

// Cadangan: kalau controller lama masih mengirim 1 project (format lama)
if (empty($projects) && isset($judul)) {
    $projects = [[
        'judul' => $judul, 'periode' => $periode ?? '', 'topik' => $topik ?? '',
        'scope' => $scope ?? null, 'dataset' => $dataset ?? null,
        'instrumen' => $instrumen ?? null, 'pengolahan' => $pengolahan ?? null,
        'hasil' => $hasil ?? null, 'dokumentasi' => $dokumentasi ?? null,
    ]];
}

$placeholder = "data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22220%22%3E%3Crect width=%22100%25%22 height=%22100%25%22 fill=%22%2316346e%22/%3E%3C/svg%3E";
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
            max-width: 1280px;
            margin: 0 auto;
            padding: 22px 36px 48px;
        }

        /* ---------- Header ---------- */
        .topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
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
        .topbar__logo:focus-visible,
        .zoomable:focus-visible {
            outline: 2px solid #fff;
            outline-offset: 3px;
        }

        /* ---------- Baris judul: judul besar + badge periode ---------- */
        .titlebar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .titlebar h1 {
            font-size: clamp(30px, 5.2vw, 58px);
            font-weight: 800;
            font-style: italic;
            line-height: 1.05;
            background: linear-gradient(90deg, #2f6bff 0%, #ffffff 90%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            padding-right: .15em;
        }

        .badge {
            background: #1f4fc4;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 18px;
            border-radius: 999px;
            white-space: nowrap;
            border: 1px solid rgba(255, 255, 255, .2);
        }

        /* ---------- Grid utama ---------- */
        .layout {
            display: grid;
            grid-template-columns: 2fr 1fr 1.55fr;
            gap: 16px;
            grid-template-areas:
                "title  title  right"
                "colA   data   right";
            align-items: stretch;
        }

        .area-title { grid-area: title; }
        .area-colA  { grid-area: colA; display: grid; gap: 16px; align-content: start; min-width: 0; }
        .area-data  { grid-area: data; min-width: 0; }
        .area-right { grid-area: right; display: grid; gap: 16px; align-content: start; min-width: 0; }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 16px 20px;
            backdrop-filter: blur(4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .3);
        }

        .card h2 {
            color: var(--accent);
            font-weight: 800;
            font-size: 28px;
            line-height: 1.1;
            margin-bottom: 12px;
            text-align: center;
        }

        .card--right h2 { text-align: right; }

        .card h3 {
            color: var(--accent);
            font-size: 13.5px;
            font-weight: 700;
            margin: 10px 0 4px;
        }

        .card ul { list-style: none; display: grid; gap: 8px; }

        .card li {
            display: grid;
            grid-template-columns: 16px 1fr;
            font-size: 12.5px;
            line-height: 1.6;
            text-align: justify;
        }

        .card li::before { content: "\2022"; font-weight: 700; font-size: 18px; line-height: 1.25; }

        .hl { color: var(--accent); font-weight: 700; }

        /* ---------- Kartu judul penelitian ---------- */
        .topic {
            padding: 14px 20px;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.5;
        }

        .topic .lbl { color: var(--accent); font-weight: 800; }

        /* ---------- Instrumen + pengolahan (sejajar) ---------- */
        .row2 {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 16px;
        }

        .card--small h2 { font-size: 15px; text-align: left; margin-bottom: 8px; }
        .card--small li { font-size: 12px; text-align: left; line-height: 1.5; }
        .card--small ul { gap: 4px; }

        /* ---------- Logo pengolahan data (tanpa teks) ---------- */
        .tools {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .tool-logo {
            display: grid;
            place-items: center;
            height: 56px;
            padding: 8px;
            background: #fff;           /* tile putih supaya logo gelap tetap terlihat */
            border-radius: 10px;
        }

        .tool-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
        }

        /* ---------- Hasil ---------- */
        .res-cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .res-cols p { font-size: 11.5px; line-height: 1.55; text-align: justify; }

        .chart {
            margin-top: 8px;
            background: #fff;
            border-radius: 6px;
            padding: 4px;
            display: grid;
            place-items: center;
        }

        .chart img {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
            display: block;
            cursor: zoom-in;
        }

        .reco {
            margin-top: 12px;
            font-size: 11.5px;
            line-height: 1.55;
            text-align: justify;
        }

        /* ---------- Dokumentasi: foto tidak terpotong ---------- */
        .foto-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .foto {
            margin: 0;
            position: relative;
            aspect-ratio: 4 / 3;
            background: rgba(5, 11, 31, .55);
            border: 1px solid rgba(140, 180, 255, .2);
            border-radius: 8px;
            overflow: hidden;
        }

        .foto img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            cursor: zoom-in;
        }

        .foto figcaption {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 12px 6px 4px;
            font-size: 9.5px;
            font-weight: 600;
            text-align: center;
            background: linear-gradient(180deg, transparent, rgba(0, 0, 0, .75));
            pointer-events: none;
        }

        /* ---------- Lightbox ---------- */
        .lightbox {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(3, 8, 22, .92);
            cursor: zoom-out;
        }

        .lightbox.is-open { display: flex; }

        .lightbox img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
            background: #fff0;
            box-shadow: 0 12px 40px rgba(0, 0, 0, .6);
        }

        .lightbox__close {
            position: absolute;
            top: 14px;
            right: 18px;
            width: 40px;
            height: 40px;
            border: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }

        /* ---------- Tab project ---------- */
        [hidden] { display: none !important; }

        .ptabs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .ptab {
            font-family: inherit;
            font-size: .8rem;
            font-weight: 600;
            color: #fff;
            background: rgba(29, 78, 216, .35);
            border: 1px solid var(--card-border);
            border-radius: 999px;
            padding: 8px 20px;
            cursor: pointer;
            transition: background .2s, color .2s, transform .2s;
        }

        .ptab:hover { background: rgba(29, 78, 216, .9); transform: translateY(-2px); }

        .ptab[aria-selected="true"] {
            background: var(--accent);
            color: var(--accent-text);
            border-color: var(--accent);
        }

        .ptab:focus-visible { outline: 2px solid #fff; outline-offset: 3px; }

        /* ---------- Animasi muncul saat di-scroll (hanya bila JS aktif) ---------- */
        .js .reveal { opacity: 0; transform: translateY(22px); transition: opacity .7s ease, transform .7s ease; }
        .js .reveal.in { opacity: 1; transform: none; }
        @media (prefers-reduced-motion: reduce) { .js .reveal { opacity: 1; transform: none; transition: none; } }

        /* ---------- Responsive ---------- */
        @media (max-width: 1000px) {
            .layout {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "title"
                    "colA"
                    "data"
                    "right";
            }
        }

        @media (max-width: 720px) {
            .page { padding: 20px 16px 40px; }
            .topbar { flex-wrap: wrap; }
            .topbar__nav { justify-content: flex-start; flex-basis: 100%; }
            .row2, .res-cols { grid-template-columns: 1fr; }
            .card h2 { font-size: 24px; }
            .card li { text-align: left; }
        }

        @media (max-width: 520px) {
            .foto-row { grid-template-columns: 1fr; }
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

    <!-- Tab pilihan project (otomatis hilang kalau hanya 1) -->
    <?php if (count($projects) > 1): ?>
        <div class="ptabs" role="tablist" aria-label="Pilih project">
            <?php foreach ($projects as $n => $pr): ?>
                <button type="button" class="ptab" role="tab"
                        id="tab-project-<?= $n + 1 ?>"
                        data-target="project-<?= $n + 1 ?>"
                        aria-controls="project-<?= $n + 1 ?>"
                        aria-selected="<?= $n === 0 ? 'true' : 'false' ?>">
                    <?= esc($pr['tab'] ?? ('Project ' . ($n + 1))) ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php foreach ($projects as $n => $pr):
        $judul       = $pr['judul']       ?? 'Project ' . ($n + 1);
        $periode     = $pr['periode']     ?? '';
        $topik       = $pr['topik']       ?? '';
        $scope       = $pr['scope']       ?? ['judul' => 'Scope of Work', 'poin' => []];
        $dataset     = $pr['dataset']     ?? ['judul' => 'Datasets Sources', 'grup' => []];
        $instrumen   = $pr['instrumen']   ?? ['judul' => 'Tools & Technologies', 'poin' => []];
        $pengolahan  = $pr['pengolahan']  ?? ['judul' => 'Data Processing & Documentation', 'item' => []];
        $hasil       = $pr['hasil']       ?? ['judul' => 'Result and Impact', 'kolom' => [], 'rekomendasi' => []];
        $dokumentasi = $pr['dokumentasi'] ?? ['judul' => 'Documentation', 'foto' => []];
    ?>
    <section class="project-panel" id="project-<?= $n + 1 ?>" role="tabpanel"
             aria-labelledby="tab-project-<?= $n + 1 ?>" <?= $n === 0 ? '' : 'hidden' ?>>

        <!-- Judul besar + periode -->
        <div class="titlebar">
            <h1><?= esc($judul) ?></h1>
            <?php if ($periode !== ''): ?><span class="badge"><?= esc($periode) ?></span><?php endif; ?>
        </div>

        <div class="layout">

            <!-- Judul penelitian -->
            <div class="card topic area-title">
                <span class="lbl">Title :</span> <?= esc($topik) ?>
            </div>

            <!-- Kolom kiri: Scope of Work + Instrumen + Pengolahan -->
            <div class="area-colA">
                <article class="card">
                    <h2><?= esc($scope['judul'] ?? 'Scope of Work') ?></h2>
                    <ul>
                        <?php foreach (($scope['poin'] ?? []) as $p): ?>
                            <li>
                                <span>
                                    <?php if (! empty($p['label'])): ?><span class="hl"><?= esc($p['label']) ?></span><?php endif; ?>
                                    <?= esc($p['isi'] ?? '') ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </article>

                <div class="row2">
                    <article class="card card--small">
                        <h2><?= esc($instrumen['judul'] ?? 'Tools & Technologies') ?></h2>
                        <ul>
                            <?php foreach (($instrumen['poin'] ?? []) as $p): ?>
                                <li><span><?= esc($p) ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>

                    <article class="card card--small">
                        <h2><?= esc($pengolahan['judul'] ?? 'Data Processing & Documentation') ?></h2>
                        <div class="tools">
                            <?php foreach (($pengolahan['item'] ?? []) as $t): ?>
                                <div class="tool-logo">
                                    <img src="<?= base_url($t['logo'] ?? '') ?>"
                                         alt="<?= esc($t['alt'] ?? '', 'attr') ?>"
                                         loading="lazy"
                                         onerror="this.onerror=null;this.src='<?= $placeholder ?>'">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Kolom tengah: Datasets Sources -->
            <article class="card area-data">
                <h2><?= esc($dataset['judul'] ?? 'Datasets Sources') ?></h2>
                <?php foreach (($dataset['grup'] ?? []) as $g): ?>
                    <h3><?= esc($g['judul'] ?? '') ?></h3>
                    <ul>
                        <?php foreach (($g['poin'] ?? []) as $p): ?>
                            <li><span><?= esc($p) ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
            </article>

            <!-- Kolom kanan: Result and Impact + Documentation -->
            <div class="area-right">
                <article class="card card--right">
                    <h2><?= esc($hasil['judul'] ?? 'Result and Impact') ?></h2>

                    <div class="res-cols">
                        <?php foreach (($hasil['kolom'] ?? []) as $k): ?>
                            <div>
                                <p>
                                    <?php if (! empty($k['label'])): ?><span class="hl"><?= esc($k['label']) ?></span><?php endif; ?>
                                    <?= esc($k['isi'] ?? '') ?>
                                </p>
                                <?php if (! empty($k['gambar'])): ?>
                                    <div class="chart">
                                        <img class="zoomable" tabindex="0" role="button"
                                             onerror="this.onerror=null;this.src='<?= $placeholder ?>'"
                                             src="<?= base_url($k['gambar']) ?>" alt="<?= esc($k['alt'] ?? 'Grafik hasil', 'attr') ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (! empty($hasil['rekomendasi'])): ?>
                        <p class="reco">
                            <span class="hl"><?= esc($hasil['rekomendasi']['label'] ?? '') ?></span>
                            <?= esc($hasil['rekomendasi']['isi'] ?? '') ?>
                        </p>
                    <?php endif; ?>
                </article>

                <article class="card card--right">
                    <h2><?= esc($dokumentasi['judul'] ?? 'Documentation') ?></h2>
                    <div class="foto-row">
                        <?php foreach (($dokumentasi['foto'] ?? []) as $i => $f): ?>
                            <figure class="foto">
                                <img class="zoomable" tabindex="0" role="button" loading="lazy"
                                     onerror="this.onerror=null;this.src='<?= $placeholder ?>'"
                                     src="<?= base_url($f['src'] ?? '') ?>" alt="<?= esc(($f['caption'] ?? '') !== '' ? $f['caption'] : 'Dokumentasi ' . ($i + 1), 'attr') ?>">
                                <?php if (! empty($f['caption'])): ?>
                                    <figcaption><?= esc($f['caption']) ?></figcaption>
                                <?php endif; ?>
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </article>
            </div>

        </div>
    </section>
    <?php endforeach; ?>

</main>

<!-- Lightbox: klik foto / grafik untuk ukuran penuh -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau gambar">
    <button type="button" class="lightbox__close" id="lightboxClose" aria-label="Tutup">&times;</button>
    <img id="lightboxImg" src="" alt="">
</div>

<script>
(function () {
    var box = document.getElementById('lightbox');
    var big = document.getElementById('lightboxImg');
    var close = document.getElementById('lightboxClose');
    var last = null;

    function open(img) {
        last = img;
        big.src = img.currentSrc || img.src;
        big.alt = img.alt || '';
        box.classList.add('is-open');
        document.body.style.overflow = 'hidden';
        close.focus();
    }

    function hide() {
        box.classList.remove('is-open');
        big.src = '';
        document.body.style.overflow = '';
        if (last) last.focus();
    }

    document.querySelectorAll('.zoomable').forEach(function (img) {
        img.addEventListener('click', function () { open(img); });
        img.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(img); }
        });
    });

    box.addEventListener('click', hide);
    close.addEventListener('click', function (e) { e.stopPropagation(); hide(); });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && box.classList.contains('is-open')) hide();
    });

    // ---------- Tab project ----------
    var tabs   = document.querySelectorAll('.ptab');
    var panels = document.querySelectorAll('.project-panel');

    function showProject(id, pushHash) {
        var found = false;
        panels.forEach(function (p) { if (p.id === id) found = true; });
        if (!found) id = panels.length ? panels[0].id : '';

        panels.forEach(function (p) { p.hidden = (p.id !== id); });
        tabs.forEach(function (t) {
            t.setAttribute('aria-selected', t.dataset.target === id ? 'true' : 'false');
        });
        if (pushHash && history.replaceState) history.replaceState(null, '', '#' + id);
    }

    tabs.forEach(function (t) {
        t.addEventListener('click', function () { showProject(t.dataset.target, true); });
    });

    window.addEventListener('hashchange', function () {
        showProject(location.hash.slice(1), false);
    });

    if (tabs.length) showProject(location.hash.slice(1), false);
})();

// Animasi muncul saat masuk layar (sama seperti halaman About)
(function () {
    var els = document.querySelectorAll(
        '.topbar, .ptabs, .project-panel .titlebar, .project-panel .card'
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