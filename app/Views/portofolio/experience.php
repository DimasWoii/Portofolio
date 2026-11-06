<?php
// Halaman Experience (banyak entri). Semua variabel punya nilai default agar tidak error.
helper('url');

$title = $title ?? 'Experience';
$nama  = $nama  ?? 'NAMA ANDA';
$menu  = $menu  ?? [];
$aktif = $aktif ?? 'experience';

// Kompatibel dengan data lama ($pengalaman tunggal)
$daftarPengalaman = $daftarPengalaman ?? (isset($pengalaman) ? [$pengalaman] : []);

// Sertifikat kosong = entri tanpa sertifikat
$defaultItem = [
    'tab'              => '',
    'judul'            => 'Professional Experience',
    'logo'             => '',
    'perusahaan'       => '',
    'posisi'           => '',
    'divisi'           => '',
    'periode'          => '',
    'foto'             => [],
    'poin'             => [],
    'sertifikat_judul' => 'Certificate',
    'sertifikat'       => '',
];
foreach ($daftarPengalaman as $k => $item) {
    $daftarPengalaman[$k] = array_merge($defaultItem, $item);
}

$placeholder = "data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22330%22%3E%3Crect width=%22100%25%22 height=%22100%25%22 fill=%22%2316346e%22/%3E%3C/svg%3E";
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-top: #050b1f;
            --bg-mid: #0a1e4a;
            --bg-glow: #1c4fb8;
            --accent: #ffd43b;
            --accent-text: #1a1a1a;
            --card-border: rgba(140, 180, 255, .35);
            --text: #ffffff;

            /* Pengaturan foto: ubah di sini jika ingin lebih besar / kecil */
            --foto-ratio: 4 / 3;      /* rasio kotak foto (lebar / tinggi) */
            --foto-max-h: 260px;      /* tinggi maksimum kotak foto */
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

        /* ---------- Header (sama seperti About) ---------- */
        .topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
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
        .exp-tab:focus-visible,
        .zoomable:focus-visible {
            outline: 2px solid #fff;
            outline-offset: 3px;
        }

        /* ---------- Pemilih pengalaman (1 - 6) ---------- */
        .exp-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 26px;
        }

        .exp-tab {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
            font-size: .78rem;
            font-weight: 500;
            color: #fff;
            padding: 6px 14px 6px 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .22);
            cursor: pointer;
            transition: background .2s, color .2s, transform .2s;
        }

        .exp-tab:hover { background: rgba(255, 255, 255, .18); transform: translateY(-2px); }

        .exp-tab .no {
            display: grid;
            place-items: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(29, 78, 216, .9);
            font-size: .7rem;
            font-weight: 700;
        }

        .exp-tab.is-active,
        .exp-tab.is-active:hover {
            background: var(--accent);
            color: var(--accent-text);
            font-weight: 600;
            border-color: var(--accent);
        }

        .exp-tab.is-active .no { background: var(--accent-text); color: var(--accent); }

        /* ---------- Grid utama (dengan sertifikat) ---------- */
        .layout {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            column-gap: 44px;
            grid-template-areas:
                "judul   sertjudul"
                "company sertjudul"
                "role    sertcard"
                "card    sertcard";
            align-items: start;
        }

        .exp[hidden] { display: none; }

        .judul        { grid-area: judul; }
        .company      { grid-area: company; }
        .role         { grid-area: role; }
        .card-exp     { grid-area: card; min-width: 0; }
        .sert-judul   { grid-area: sertjudul; align-self: end; }
        .sert-card    { grid-area: sertcard; align-self: stretch; min-width: 0; }

        /* ---------- Grid tanpa sertifikat: satu kolom penuh ---------- */
        .layout.exp--no-cert {
            grid-template-columns: 1fr;
            grid-template-areas:
                "judul"
                "company"
                "role"
                "card";
        }

        /* Tanpa sertifikat, kartu lebih lebar: foto boleh lebih tinggi */
        .exp--no-cert .foto-item { --foto-max-h: 320px; }
        .exp--no-cert .poin-list li { font-size: 14px; grid-template-columns: 22px 1fr; }
        .exp--no-cert .poin-list .star { font-size: 26px; }

        .judul {
            color: var(--accent);
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .company {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .company img { height: 48px; width: auto; display: block; }

        .company h1 {
            font-size: 32px;
            font-weight: 800;
            line-height: 1.1;
        }

        .role { margin-bottom: 14px; }

        .role .posisi {
            font-size: 14px;
            font-weight: 500;
            letter-spacing: .02em;
        }

        .role .divisi-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 6px;
        }

        .role .divisi {
            font-size: 14px;
            font-weight: 500;
        }

        .badge {
            background: #1f4fc4;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 999px;
            white-space: nowrap;
        }

        /* ---------- Kartu pengalaman ---------- */
        .card-exp {
            background: linear-gradient(180deg, #0f2a5f 0%, #0b1f48 100%);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
        }

        /* ---------- Foto: tidak terpotong (zoom) & tidak terlalu kecil ---------- */
        .foto-row {
            display: grid;
            /* jumlah kolom diatur dari PHP (1-3) lewat inline style */
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .foto-item {
            position: relative;
            width: 100%;
            aspect-ratio: var(--foto-ratio);
            max-height: var(--foto-max-h);
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(5, 11, 31, .55);
            border: 1px solid rgba(140, 180, 255, .18);
            border-radius: 8px;
            overflow: hidden;
        }

        .foto-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;      /* seluruh foto terlihat, tidak ter-crop */
            object-position: center;
            display: block;
            cursor: zoom-in;
            transition: transform .2s;
        }

        .foto-item:hover img { transform: scale(1.03); }

        .poin-list {
            list-style: none;
            margin-top: 16px;
            display: grid;
            gap: 10px;
        }

        .poin-list:first-child { margin-top: 0; }

        .poin-list li {
            display: grid;
            grid-template-columns: 18px 1fr;
            column-gap: 6px;
            font-size: 12.5px;
            line-height: 1.55;
            text-align: justify;
        }

        .poin-list .star {
            font-size: 22px;
            line-height: 1;
            font-weight: 700;
        }

        /* Label (Key Responsibilities / Value/Impact): kuning + bold */
        .poin-list strong {
            font-weight: 700;
            color: var(--accent);
        }

        /* ---------- Sertifikat ---------- */
        .sert-judul {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .sert-card {
            background: rgba(255, 255, 255, .05);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
            min-height: 340px;
        }

        .sert-card img {
            max-width: 100%;
            max-height: 520px;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .45);
            cursor: zoom-in;
        }

        /* ---------- Lightbox (klik foto untuk memperbesar) ---------- */
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
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 8px;
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
            line-height: 1;
            cursor: pointer;
        }

        .lightbox__close:hover { background: rgba(255, 255, 255, .3); }

        /* ---------- Animasi muncul saat di-scroll (hanya bila JS aktif) ---------- */
        .js .reveal { opacity: 0; transform: translateY(22px); transition: opacity .7s ease, transform .7s ease; }
        .js .reveal.in { opacity: 1; transform: none; }
        @media (prefers-reduced-motion: reduce) { .js .reveal { opacity: 1; transform: none; transition: none; } }

        /* ---------- Responsive ---------- */
        @media (max-width: 860px) {
            .layout {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "judul"
                    "company"
                    "role"
                    "card"
                    "sertjudul"
                    "sertcard";
            }

            .layout.exp--no-cert {
                grid-template-areas:
                    "judul"
                    "company"
                    "role"
                    "card";
            }

            .sert-judul { margin-top: 28px; }
            .company h1 { font-size: 24px; }
            .company img { height: 38px; }
            .sert-card { min-height: 0; }
            .foto-item,
            .exp--no-cert .foto-item { --foto-max-h: 240px; }
            .exp--no-cert .poin-list li { font-size: 12.5px; grid-template-columns: 18px 1fr; }
            .exp--no-cert .poin-list .star { font-size: 22px; }
        }

        @media (max-width: 720px) {
            .page { padding: 20px 18px 40px; }
            .topbar { flex-wrap: wrap; }
            .topbar__nav { justify-content: flex-start; flex-basis: 100%; }
        }

        /* HP: foto jadi 1 kolom agar cukup besar */
        @media (max-width: 560px) {
            .foto-row { grid-template-columns: 1fr !important; }
            .foto-item,
            .exp--no-cert .foto-item { --foto-max-h: 260px; }
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

    <!-- Pemilih pengalaman -->
    <?php if (count($daftarPengalaman) > 1): ?>
        <div class="exp-tabs" role="tablist" aria-label="Daftar pengalaman">
            <?php foreach ($daftarPengalaman as $n => $px): ?>
                <button type="button" class="exp-tab" role="tab" aria-selected="false">
                    <span class="no"><?= $n + 1 ?></span>
                    <?= esc($px['tab'] !== '' ? $px['tab'] : 'Experience ' . ($n + 1)) ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Daftar pengalaman -->
    <?php foreach ($daftarPengalaman as $n => $pengalaman): ?>
    <?php
        $adaSertifikat = ($pengalaman['sertifikat'] !== '');
        $jumlahFoto    = count($pengalaman['foto']);
        $kolomFoto     = max(1, min($jumlahFoto, 3));
    ?>
    <section class="layout exp <?= $adaSertifikat ? '' : 'exp--no-cert' ?>" id="exp-<?= $n + 1 ?>">

        <h2 class="judul"><?= esc($pengalaman['judul']) ?></h2>

        <div class="company">
            <?php if ($pengalaman['logo'] !== ''): ?>
                <img onerror="this.style.display='none'" src="<?= base_url($pengalaman['logo']) ?>" alt="Logo <?= esc($pengalaman['perusahaan'], 'attr') ?>">
            <?php endif; ?>
            <h1><?= esc($pengalaman['perusahaan']) ?></h1>
        </div>

        <div class="role">
            <p class="posisi"><?= esc($pengalaman['posisi']) ?></p>
            <div class="divisi-row">
                <span class="divisi"><?= esc($pengalaman['divisi']) ?></span>
                <?php if ($pengalaman['periode'] !== ''): ?>
                    <span class="badge"><?= esc($pengalaman['periode']) ?></span>
                <?php endif; ?>
            </div>
        </div>

        <article class="card-exp">
            <?php if (! empty($pengalaman['foto'])): ?>
                <div class="foto-row" style="grid-template-columns: repeat(<?= $kolomFoto ?>, 1fr);">
                    <?php foreach ($pengalaman['foto'] as $i => $f): ?>
                        <div class="foto-item">
                            <img class="zoomable" tabindex="0" role="button"
                                 onerror="this.onerror=null;this.src='<?= $placeholder ?>'"
                                 src="<?= base_url($f) ?>" alt="Dokumentasi kegiatan <?= $i + 1 ?>"
                                 loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <ul class="poin-list">
                <?php foreach ($pengalaman['poin'] as $p): ?>
                    <li>
                        <span class="star" aria-hidden="true">*</span>
                        <span><strong><?= esc($p['label'] ?? '') ?> :</strong> <?= esc($p['isi'] ?? '') ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </article>

        <?php if ($adaSertifikat): ?>
            <h2 class="sert-judul"><?= esc($pengalaman['sertifikat_judul']) ?></h2>

            <aside class="sert-card">
                <img class="zoomable" tabindex="0" role="button"
                     onerror="this.onerror=null;this.src='<?= $placeholder ?>'"
                     src="<?= base_url($pengalaman['sertifikat']) ?>" alt="<?= esc($pengalaman['sertifikat_judul'], 'attr') ?>">
            </aside>
        <?php endif; ?>

    </section>
    <?php endforeach; ?>

</main>

<!-- Lightbox: tampilan foto ukuran penuh -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau foto">
    <button type="button" class="lightbox__close" id="lightboxClose" aria-label="Tutup">&times;</button>
    <img id="lightboxImg" src="" alt="">
</div>

<script>
// Pilih pengalaman: tampilkan satu entri, tombol 1-N. Tanpa JS semua entri tampil berurutan.
(function () {
    var tabs  = [].slice.call(document.querySelectorAll('.exp-tab'));
    var items = [].slice.call(document.querySelectorAll('.exp'));
    if (!items.length) return;

    function show(i) {
        items.forEach(function (el, k) { el.hidden = (k !== i); });
        tabs.forEach(function (t, k) {
            var on = (k === i);
            t.classList.toggle('is-active', on);
            t.setAttribute('aria-selected', on ? 'true' : 'false');
        });
    }

    tabs.forEach(function (t, k) {
        t.addEventListener('click', function () {
            show(k);
            if (history.replaceState) history.replaceState(null, '', '#exp-' + (k + 1));
        });
    });

    var m = location.hash.match(/^#exp-(\d+)$/);
    var start = m ? Math.min(Math.max(parseInt(m[1], 10) - 1, 0), items.length - 1) : 0;
    show(start);
})();

// Lightbox: klik foto / sertifikat untuk melihat ukuran penuh
(function () {
    var box   = document.getElementById('lightbox');
    var big   = document.getElementById('lightboxImg');
    var close = document.getElementById('lightboxClose');
    var last  = null;

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
})();

// Animasi muncul saat masuk layar (sama seperti halaman About)
(function () {
    var els = document.querySelectorAll(
        '.topbar, .exp-tabs, .exp .judul, .exp .company, .exp .role, .exp .card-exp, .exp .sert-judul, .exp .sert-card'
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