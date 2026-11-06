<?php
// Halaman About Me (route: /about). Semua variabel punya nilai default agar tidak error.
helper('url');

$nama     = $nama     ?? 'NAMA ANDA';
$email    = $email    ?? '';
$telepon  = $telepon  ?? '';
$linkedin = $linkedin ?? '';
$foto     = $foto     ?? 'assets/img/foto.png';
$menu     = $menu     ?? [];
$sapaan   = $sapaan   ?? 'Dimas';
$instagram = $instagram ?? '';
$qr        = $qr        ?? 'assets/qr.png';      // QR menuju CV, taruh di public/assets/qr.png
$punyaQr   = defined('FCPATH') && is_file(FCPATH . $qr);

// Tautan kontak
$linkedinUrl  = preg_match('#^https?://#', $linkedin) ? $linkedin : 'https://' . $linkedin;
$instagramUrl = 'https://instagram.com/' . ltrim($instagram, '@');

// ===== Logo Technical Software =====
$dv = 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/';
$si = 'https://cdn.simpleicons.org/';

// [nama, url logo, teks cadangan bila logo gagal dimuat]
$webTools = [
    ['HTML5',         $dv . 'html5/html5-original.svg',           'HTML'],
    ['CSS3',          $dv . 'css3/css3-original.svg',             'CSS'],
    ['JavaScript',    $dv . 'javascript/javascript-original.svg', 'JS'],
    ['PHP',           $dv . 'php/php-original.svg',               'PHP'],
    ['CodeIgniter 4', $si . 'codeigniter/EE4623',                 'CI'],
    ['Bootstrap',     $dv . 'bootstrap/bootstrap-original.svg',   'BS'],
    ['Git',           $dv . 'git/git-original.svg',               'Git'],
    ['GitHub',        $dv . 'github/github-original.svg',         'GH'],
    ['VS Code',       $dv . 'vscode/vscode-original.svg',         'VS'],
    ['XAMPP',         '',                                         'XA'], // logo inline (lihat xamppIcon)
];
$dbTools = [
    ['MySQL',         $dv . 'mysql/mysql-original.svg',           'SQL'],
    ['phpMyAdmin',    $si . 'phpmyadmin/6C78AF',                  'pMA'],
];

// Ikon Microsoft Office: [nama, warna dasar, warna gelap, huruf]
$officeTools = [
    ['Word',       '#2b579a', '#1e3f73', 'W'],
    ['Excel',      '#217346', '#185c37', 'X'],
    ['PowerPoint', '#d24726', '#a8371b', 'P'],
    ['Outlook',    '#0078d4', '#0a5a9e', 'O'],
    ['Access',     '#a4373a', '#7d2a2c', 'A'],
    ['OneNote',    '#7719aa', '#5a1280', 'N'],
    ['Teams',      '#5059c9', '#3b42a0', 'T'],
];

// Render ikon Office (SVG inline, tidak butuh internet)
function officeIcon(array $o): string
{
    [$nm, $bg, $dk, $ch] = $o;
    return '<svg viewBox="0 0 48 48" role="img" aria-label="Microsoft ' . esc($nm, 'attr') . '">'
        . '<rect width="48" height="48" rx="10" fill="' . $bg . '"/>'
        . '<rect x="22" y="9" width="19" height="30" rx="3" fill="#fff" opacity=".95"/>'
        . '<path d="M26 17h11M26 23h11M26 29h11" stroke="' . $bg . '" stroke-width="2" stroke-linecap="round"/>'
        . '<rect x="5" y="13" width="22" height="22" rx="4" fill="' . $dk . '"/>'
        . '<text x="16" y="30" text-anchor="middle" font-family="Arial,Helvetica,sans-serif" font-weight="700" font-size="16" fill="#fff">' . $ch . '</text>'
        . '</svg>';
}

// Logo XAMPP Control Panel: kotak oranye + simbol "X" putih dengan 4 lingkaran (SVG inline)
function xamppIcon(): string
{
    return '<svg viewBox="0 0 48 48" role="img" aria-label="XAMPP Control Panel">'
        . '<defs><linearGradient id="xamppG" x1="0" y1="0" x2="0" y2="1">'
        . '<stop offset="0" stop-color="#ff9b3d"/><stop offset="1" stop-color="#f2661b"/>'
        . '</linearGradient></defs>'
        . '<rect width="48" height="48" rx="9" fill="url(#xamppG)"/>'
        . '<rect x="2.5" y="2.5" width="43" height="43" rx="7" fill="none" stroke="#fff" stroke-opacity=".5" stroke-width="1.5"/>'
        . '<g fill="none" stroke="#fff" stroke-width="4.2" stroke-linecap="round" stroke-linejoin="round">'
        . '<circle cx="15" cy="16" r="4.6"/><circle cx="33" cy="16" r="4.6"/>'
        . '<circle cx="15" cy="32" r="4.6"/><circle cx="33" cy="32" r="4.6"/>'
        . '<path d="M18.5 19.2L29.5 28.8M29.5 19.2L18.5 28.8"/>'
        . '</g>'
        . '</svg>';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.documentElement.classList.add('js')</script>
    <title>About Me | <?= esc($nama) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
/* Dasar halaman */
* { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: 'Poppins', sans-serif; background: #050b22; color: #fff; -webkit-font-smoothing: antialiased; }
.about__logo { position: absolute; top: 22px; left: 5%; z-index: 2; display: block; }
.about__nav  { position: relative; z-index: 2; }

.about {
    --yellow: #ffd54a;
    position: relative; overflow: hidden;
    min-height: 100vh; padding: 28px 5% 48px;
    background:
        radial-gradient(900px 500px at 85% 10%, rgba(37,99,235,.35), transparent 60%),
        radial-gradient(700px 500px at 5% 95%, rgba(29,78,216,.28), transparent 60%),
        linear-gradient(160deg, #050b22 0%, #0a1a4d 100%);
    border-top: 1px solid rgba(255,255,255,.1);
}

/* Menu: About Me aktif (kuning) */
.about__nav { display: flex; gap: 8px; flex-wrap: wrap; justify-content: flex-end; margin-bottom: 26px; }
.about__nav a {
    color: #fff; text-decoration: none; font-size: .8rem; font-weight: 500;
    padding: 8px 16px; border-radius: 8px; background: rgba(29,78,216,.9);
    border: 1px solid rgba(255,255,255,.18); transition: transform .2s, background .2s, color .2s;
}
.about__nav a:hover { background: #fff; color: #1d4ed8; transform: translateY(-2px); }
.about__nav a.is-active { background: var(--yellow); color: #1a1a1a; font-weight: 600; }

/* Judul + paragraf */
.about__hi {
    font-size: clamp(2.2rem, 4.6vw, 4rem); font-weight: 800; font-style: italic; line-height: 1.1;
    background: linear-gradient(90deg, #6b9bff, #2f5fff);
    -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
}
.about__lead {
    margin-top: 12px; font-size: clamp(.92rem, 1.15vw, 1.12rem); line-height: 1.7;
    text-align: justify; color: rgba(255,255,255,.92); max-width: 1400px;
}
.about__lead b  { color: #fff; font-weight: 700; }
.about__lead .hl { color: var(--yellow); font-weight: 600; }

/* Grid kartu */
.about__grid {
    margin-top: 4px; display: grid; gap: 16px; align-items: stretch;
    grid-template-columns: 1fr 1fr 1.1fr .95fr;
    grid-template-areas:
        "hi   hi   hi   prof"
        "edu  comp exp  prof"
        "edu  soft exp  prof";
}
.card {
    background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.18);
    border-radius: 14px; padding: 18px 20px; backdrop-filter: blur(8px);
    box-shadow: 0 10px 30px rgba(0,0,0,.25);
}
.card h3 { font-size: clamp(1.05rem, 1.5vw, 1.4rem); font-weight: 700; margin-bottom: 12px; }
.about__intro { grid-area: hi; }
.card--edu  { grid-area: edu; }
.card--comp { grid-area: comp; }
.card--exp  { grid-area: exp; }
.card--soft { grid-area: soft; }
.card--prof { grid-area: prof; }

.card h4 { color: var(--yellow); font-size: .95rem; font-weight: 700; margin-top: 10px; }
.card h4:first-of-type { margin-top: 0; }
.card .sub { font-size: .85rem; opacity: .9; }
.card .row { display: flex; justify-content: space-between; gap: 12px; font-size: .85rem; opacity: .9; }
.card ul { margin: 6px 0 0 18px; font-size: .86rem; line-height: 1.55; }
.card li + li { margin-top: 2px; }

/* Technical software tiles (logo) */
.tiles { display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px 8px; }
.tile { text-align: center; font-size: .66rem; line-height: 1.2; }
.tile .ic {
    display: grid; place-items: center; width: 46px; height: 46px; margin: 0 auto 6px; padding: 7px;
    border-radius: 10px; background: #fff; color: #333; font-weight: 700; font-size: .8rem;
    box-shadow: 0 4px 12px rgba(0,0,0,.3); transition: transform .2s;
}
.tile:hover .ic { transform: translateY(-3px) scale(1.06); }
.tile .ic img, .tile .ic svg { width: 100%; height: 100%; object-fit: contain; display: block; }
.tile .ic--office { padding: 0; background: transparent; }
.tiles__label {
    grid-column: 1 / -1; margin-top: 6px; padding-bottom: 4px;
    font-size: .72rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--yellow);
    border-bottom: 1px solid rgba(255,255,255,.15);
}
.tiles__label:first-child { margin-top: 0; }

/* Profil (kolom kanan) */
.card--prof { display: flex; flex-direction: column; gap: 14px; padding: 14px; }
.prof__photo {
    position: relative; height: clamp(220px, 24vw, 300px); border-radius: 10px; overflow: hidden;
    background: linear-gradient(160deg, #2447ff, #0f2bd0);
}
.prof__photo img { width: 100%; height: 100%; object-fit: cover; object-position: top center; display: block; }
.prof__name {
    display: inline-block; background: var(--yellow); color: #1a1a1a; font-weight: 700;
    font-size: clamp(.95rem, 1.3vw, 1.2rem); padding: 6px 14px; border-radius: 6px; line-height: 1.2;
}
.prof__role { margin-top: 8px; font-size: .78rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; opacity: .9; }

/* Scan CV */
.scan { display: flex; align-items: center; gap: 14px; padding-top: 14px; border-top: 1px solid rgba(255,255,255,.18); }
.scan__box {
    flex: 0 0 auto; width: 92px; height: 92px; border-radius: 8px; background: #fff; padding: 5px;
    display: grid; place-items: center; color: #555; font-size: .7rem; font-weight: 600; text-align: center;
}
.scan__box img { width: 100%; height: 100%; object-fit: contain; display: block; }
.scan__box--empty { border: 2px dashed #999; }
.scan__text strong { display: block; color: var(--yellow); font-size: .95rem; }
.scan__text span { font-size: .78rem; opacity: .85; line-height: 1.4; }

/* Kontak: ikon + teks */
.contact { list-style: none; margin: auto 0 0; display: grid; gap: 10px; padding-top: 14px; border-top: 1px solid rgba(255,255,255,.18); }
.contact li { margin: 0; }
.contact a { display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; font-size: .8rem; line-height: 1.35; overflow-wrap: anywhere; }
.contact a:hover span { text-decoration: underline; }
.contact i {
    flex: 0 0 auto; width: 34px; height: 34px; border-radius: 50%; display: grid; place-items: center;
    background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.25); color: var(--yellow);
}
.contact svg { width: 18px; height: 18px; }

/* Animasi muncul saat di-scroll (hanya bila JS aktif) */
.js .reveal { opacity: 0; transform: translateY(22px); transition: opacity .7s ease, transform .7s ease; }
.js .reveal.in { opacity: 1; transform: none; }
@media (prefers-reduced-motion: reduce) { .js .reveal { opacity: 1; transform: none; transition: none; } }

/* Responsif */
@media (max-width: 1200px) {
    .about__grid { grid-template-columns: 1fr 1fr; grid-template-areas: "hi prof" "edu prof" "comp exp" "soft exp"; }
}
@media (max-width: 720px) {
    .about { padding: 20px 5% 40px; }
    .about__nav { justify-content: flex-start; }
    .about__lead { text-align: left; }
    .about__grid { grid-template-columns: 1fr; grid-template-areas: "hi" "prof" "edu" "comp" "soft" "exp"; }
    .prof__photo { height: 260px; }
}
</style>
</head>
<body>
<section class="about" id="about">

    <a class="about__logo" href="<?= base_url('/') ?>" aria-label="Kembali ke halaman depan">
        <svg viewBox="0 0 48 48" width="40" height="40" fill="#fff">
            <path d="M4 40 L20 8 L28 24 L20 24 Z"/>
            <path d="M24 40 L40 8 L44 16 L34 40 Z" opacity=".85"/>
        </svg>
    </a>

    <nav class="about__nav">
        <?php foreach ($menu as $m): ?>
           <a href="<?= site_url($m['id']) ?>"><?= esc($m['label']) ?></a>
        <?php endforeach; ?>
    </nav>

    <div class="about__grid">

        <!-- Judul + penjelasan (foto ada di sampingnya) -->
        <div class="about__intro">
        <h2 class="about__hi reveal">Hi, I’m <?= esc($sapaan) ?>.</h2>

        <p class="about__lead reveal">
            Fresh Graduate of Applied Bachelor Degree in <b>Informatics Management</b> from Politeknik Negeri Sriwijaya
            <span class="hl">(GPA 3.70/4.00)</span> with hands-on experience in <b>web application development</b>,
            data management, and administrative process digitalization. Skilled in <b>PHP, CodeIgniter 4, and MySQL</b>,
            with experience building <b>digital approval workflows, automated reporting, and data validation features</b>
            at Dinas Perindustrian Provinsi Sumatera Selatan. Experienced in
            <span class="hl">administrative support, data entry, and digital archive management</span>, and familiar with the
            <b>Waterfall</b> development model and the <b>Analytic Hierarchy Process (AHP)</b>. Eager to contribute as an
            <b>Administrative Staff</b> and <b>Information Systems Developer</b> through accuracy, analytical thinking, and
            efficient digital solutions.
        </p>
        </div>

        <!-- Education -->
        <article class="card card--edu reveal">
            <h3>Education</h3>
            <h4>Politeknik Negeri Sriwijaya</h4>
            <p class="sub">Applied Bachelor (D4) in Informatics Management</p>
            <div class="row"><span>GPA 3.70 / 4.00</span><span>2022 – 2026</span></div>

            <ul>
                <li>Systems Analysis &amp; Design, Web Development, Databases</li>
                <li>PHP &amp; MySQL projects</li>
                <li>CodeIgniter 4 framework (Web Engineering Practicum)</li>
            </ul>
        </article>

        <!-- Core Competencies -->
        <article class="card card--comp reveal">
            <h3>Core Competencies</h3>
            <ul>
                <li>Web Application Development</li>
                <li>System Analysis &amp; Design (Waterfall)</li>
                <li>MySQL Database Management</li>
                <li>Data Entry &amp; Validation</li>
                <li>Digital Approval Workflow</li>
                <li>Automated Reporting (PDF &amp; Excel)</li>
                <li>Analytic Hierarchy Process (AHP)</li>
                <li>Black Box System Testing</li>
                <li>Document &amp; Digital Archive Management</li>
                <li>Administrative Support &amp; Reporting</li>
            </ul>
        </article>

        <!-- Experience Highlights -->
        <article class="card card--exp reveal">
            <h3>Experience Highlights</h3>
            <h4>Systems Development (Hands-On)</h4>
            <ul>
                <li>Business-trip information system, Dinas Perindustrian Sumsel (2025 – 2026)</li>
                <li>Digital validation &amp; approval, automatic PDF/Excel reports</li>
                <li>AHP-based activity prioritization</li>
                <li>Black Box Testing on 13 system functions</li>
                <li>Operational activity submission app with account codes &amp; tax calculation</li>
            </ul>
            <h4>Administration (Support)</h4>
            <ul>
                <li>Data entry, filing &amp; document management, Division PKPS &amp; BSI (2025)</li>
                <li>Data &amp; document checking for accuracy and traceability</li>
            </ul>
        </article>

        <!-- Technical Software -->
        <article class="card card--soft reveal">
            <h3>Technical Software</h3>
            <div class="tiles">

                <!-- Web Development -->
                <div class="tiles__label">Web Development</div>
                <?php foreach ($webTools as $t): ?>
                <div class="tile">
                    <?php if ($t[0] === 'XAMPP'): ?>
                    <span class="ic ic--office"><?= xamppIcon() ?></span>
                    <?php else: ?>
                    <span class="ic"><img src="<?= esc($t[1], 'attr') ?>" alt="<?= esc($t[0], 'attr') ?>" loading="lazy"
                        data-f="<?= esc($t[2], 'attr') ?>" onerror="this.replaceWith(document.createTextNode(this.dataset.f))"></span>
                    <?php endif; ?>
                    <?= esc($t[0]) ?>
                </div>
                <?php endforeach; ?>

                <!-- Database -->
                <div class="tiles__label">Database</div>
                <?php foreach ($dbTools as $t): ?>
                <div class="tile">
                    <span class="ic"><img src="<?= esc($t[1], 'attr') ?>" alt="<?= esc($t[0], 'attr') ?>" loading="lazy"
                        data-f="<?= esc($t[2], 'attr') ?>" onerror="this.replaceWith(document.createTextNode(this.dataset.f))"></span>
                    <?= esc($t[0]) ?>
                </div>
                <?php endforeach; ?>

                <!-- Administration -->
                <div class="tiles__label">Administration</div>

                <?php foreach ($officeTools as $o): ?>
                <div class="tile">
                    <span class="ic ic--office"><?= officeIcon($o) ?></span><?= esc($o[0]) ?>
                </div>
                <?php endforeach; ?>

                <!-- Google Workspace -->
                <div class="tile">
                    <span class="ic"><img src="<?= esc($dv . 'google/google-original.svg', 'attr') ?>" alt="Google Workspace" loading="lazy"
                        data-f="G" onerror="this.replaceWith(document.createTextNode(this.dataset.f))"></span>Google Workspace
                </div>

                <!-- Google Drive -->
                <div class="tile">
                    <span class="ic ic--office">
                        <svg viewBox="0 0 48 48" role="img" aria-label="Google Drive">
                            <rect width="48" height="48" rx="10" fill="#fff"/>
                            <path d="M17 8h14l12 21H29z" fill="#ffba00"/>
                            <path d="M17 8L5 29l7 12 12-21z" fill="#0066da"/>
                            <path d="M12 41h24l7-12H19z" fill="#00ac47"/>
                        </svg>
                    </span>Google Drive
                </div>

                <!-- PDF -->
                <div class="tile">
                    <span class="ic ic--office">
                        <svg viewBox="0 0 48 48" role="img" aria-label="PDF">
                            <rect width="48" height="48" rx="10" fill="#e2231a"/>
                            <path d="M13 6h16l8 8v28H13z" fill="#fff"/>
                            <path d="M29 6l8 8h-8z" fill="#f4b5b1"/>
                            <path d="M17 32c4-1 8-6 8-11 0-2-2-2-2 0 0 5 5 10 9 10 2 0 2-2 0-2-4 0-10 1-15 3z" stroke="#e2231a" stroke-width="1.6" fill="none" stroke-linejoin="round"/>
                        </svg>
                    </span>PDF
                </div>

            </div>
        </article>

        <!-- Profil -->
        <article class="card card--prof reveal">
            <div class="prof__photo">
                <img src="<?= base_url($foto) ?>" alt="<?= esc($nama) ?>">
            </div>

            <div>
                <span class="prof__name"><?= esc(ucwords(strtolower($nama))) ?></span>
                <p class="prof__role">Information Systems Developer &amp; Administrative Staff</p>
            </div>

            <!-- Scan CV -->
            <div class="scan">
                <div class="scan__box <?= $punyaQr ? '' : 'scan__box--empty' ?>">
                    <?php if ($punyaQr): ?>
                        <img src="<?= base_url($qr) ?>" alt="QR Code CV">
                    <?php else: ?>QR CV<?php endif; ?>
                </div>
                <div class="scan__text">
                    <strong>Scan Curriculum Vitae</strong>
                </div>
            </div>

            <!-- Kontak -->
            <ul class="contact">
                <?php if ($email !== ''): ?>
                <li><a href="mailto:<?= esc($email, 'attr') ?>">
                    <i><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg></i>
                    <span><?= esc($email) ?></span>
                </a></li>
                <?php endif; ?>

                <?php if ($linkedin !== ''): ?>
                <li><a href="<?= esc($linkedinUrl, 'attr') ?>" target="_blank" rel="noopener">
                    <i><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></i>
                    <span><?= esc($linkedin) ?></span>
                </a></li>
                <?php endif; ?>

                <?php if ($instagram !== ''): ?>
                <li><a href="<?= esc($instagramUrl, 'attr') ?>" target="_blank" rel="noopener">
                    <i><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></i>
                    <span><?= esc($instagram) ?></span>
                </a></li>
                <?php endif; ?>
            </ul>
        </article>

    </div>
</section>

<script>
// Munculkan elemen saat masuk layar
(function () {
    var els = document.querySelectorAll('.about .reveal');
    if (!('IntersectionObserver' in window)) { els.forEach(function (e) { e.classList.add('in'); }); return; }
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); } });
    }, { threshold: .12 });
    els.forEach(function (e) { io.observe(e); });
})();
</script>

</body>
</html>