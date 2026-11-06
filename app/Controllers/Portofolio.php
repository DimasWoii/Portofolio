<?php

namespace App\Controllers;

class Portofolio extends BaseController
{
    /**
     * Menu dipakai bersama oleh semua halaman supaya tidak ditulis berulang.
     */
    private function menu(): array
    {
        return [
            ['label' => 'About Me',                'id' => 'about'],
            ['label' => 'Professional Experience', 'id' => 'experience'],
            ['label' => 'Selected Project',        'id' => 'project'],
            ['label' => 'Technical Skills',        'id' => 'skills'],
            ['label' => 'Education',               'id' => 'education'],
            ['label' => 'Certifications',          'id' => 'certifications'],
        ];
    }

    // ===================== Halaman depan (/) =====================
    public function index()
    {
        $data = [
            'title'    => 'Portofolio',
            'nama'     => 'DIMAS KURNIA PUTRA',
            'jurusan'  => 'Fresh Graduate D4 Manajemen Informatika',
            'kampus'   => 'Politeknik Negeri Sriwijaya',

            // Foto (taruh di public/assets/img/, ubah nama file di sini bila beda)
            'foto'     => 'assets/foto.png',
            'bg'       => 'assets/bg.jpg',

            // Pojok kiri bawah
            'ready'     => 'Ready to',
            'ready_sub' => 'contribute as Administrative Staff and Information Systems Developer',

            // Pojok kanan bawah (sesuai CV)
            'tagline'  => 'Pengembang Sistem Informasi | PHP & CodeIgniter 4 | Otomatisasi Proses dan Pengelolaan Data',

            'aktif'    => '',
            'menu'     => $this->menu(),
        ];

        return view('portofolio/home', $data);
    }

    // ===================== Halaman About Me (/about) =====================
    public function about()
    {
        $data = [
            'title'     => 'About Me',
            'nama'      => 'DIMAS KURNIA PUTRA',
            'sapaan'    => 'Dimas',
            'email'     => 'dimaskurniap22@gmail.com',
            'telepon'   => '+62 896 2027 8130',
            'linkedin'  => 'linkedin.com/in/dimas-kurnia-putra-980586272',
            'instagram' => 'https://instagram.com/kurnitra',   // GANTI dengan username IG Anda

            // Pakai lokasi foto yang sama dengan halaman depan
            'foto'      => 'assets/profil.png',
            'qr'        => 'assets/qr.png',                    // QR menuju CV (opsional)

            'aktif'     => 'about',
            'menu'      => $this->menu(),
        ];

        return view('portofolio/about', $data);
    }

    // ===================== Halaman Professional Experience (/experience) =====================
    public function experience()
    {
        $data = [
            'title' => 'Professional Experience',
            'nama'  => 'DIMAS KURNIA PUTRA',
            'aktif' => 'experience',   // menu yang berwarna kuning
            'menu'  => $this->menu(),
'daftarPengalaman' => [

            // ===== 1. MAGANG =====
            [
                'tab'              => 'Internship',
                'judul'            => 'Internship Experience',
                'logo'             => 'assets/pengalaman/logo.png',
                'perusahaan'       => 'Dinas Perindustrian Provinsi Sumatera Selatan',
                'posisi'           => 'Web Developer Intern',
                'divisi'           => 'Small and Medium - Sized Enterprises',
                'periode'          => 'Feb – Jun 2025',
                'foto'             => ['assets/pengalaman/foto1.png', 'assets/pengalaman/foto2.png', 'assets/pengalaman/foto3.png'],
                'poin'             => [
                    [
                        'label' => 'Key Responsibilities',
                        'isi'   => 'Analyzed the manual SME (IKM) registration process at the South Sumatra Provincial Industry Office through observation and interviews, then designed and developed a website-based online registration application using the CodeIgniter framework and MySQL database, following the Waterfall method (requirements analysis, system design, implementation, testing, and maintenance) and modeling the system with UML and ERD.',
                    ],
                    [
                        'label' => 'Value/Impact',
                        'isi'   => 'Delivered a working prototype featuring online registration and SME data management, validated through black box testing, which supports faster, more accurate, and better-integrated data handling and advances the digitalization of public services in the industrial sector.',
                    ],
                ],
                'sertifikat_judul' => 'Internship Certificate',
                'sertifikat'       => 'assets/pengalaman/sertifikat.png',
            ],

            // ===== 2. PROFESSIONAL EXPERIENCE =====
            [
                'tab'              => 'Experience 2',
                'judul'            => 'Professional Experience',
                'logo'             => 'assets/pengalaman/logo.png',
                'perusahaan'       => 'DINAS PERINDUSTRIAN PROVINSI SUMATERA SELATAN',
                'posisi'           => 'MBKM Independent Research Program',
                'divisi'           => 'Finance Division',
                'periode'          => 'September 2025  - January 2026',
                'foto'             => ['assets/pengalaman1/foto1.png', 'assets/pengalaman1/foto2.png', 'assets/pengalaman1/foto3.png'],
                'poin'             => [
                    ['label' => 'Key Responsibilities', 'isi' => 'Analyzed the existing business trip transaction process and developed a website-based system to manage employee data, travel transactions, digital validation, and reporting in a structured manner.'],
                    ['label' => 'Value/Impact',         'isi' => 'Improved administrative efficiency, data accuracy, transparency, and accountability by reducing recording errors, centralizing transaction records, and enabling faster validation and report generation.'],
                ],
            ],

            // ===== 3 =====
            [
                'tab'              => 'Experience 3',
                'judul'            => 'Professional Experience',
                'logo'             => 'assets/pengalaman/logo.png',
                'perusahaan'       => 'DINAS PERINDUSTRIAN PROVINSI SUMATERA SELATAN',
                'posisi'           => 'Web Developer Final Project',
                'divisi'           => 'Finance Division',
                'periode'          => 'February - June 2026',
                'foto'             => ['assets/pengalaman2/foto1.png', 'assets/pengalaman2/foto2.png', 'assets/pengalaman2/foto3.png'],
                'poin'             => [
                    ['label' => 'Key Responsibilities', 'isi' => 'Analyzed operational budget management processes and developed a web-based decision support system using the AHP method to manage budget realization data, evaluate criteria, and determine activity priorities.'],
                    ['label' => 'Value/Impact',         'isi' => 'Improved the objectivity, efficiency, transparency, and accuracy of operational budget decision-making by providing structured priority rankings and integrated data management.'],
                ],
        
            ],

            // ===== 4 =====
            [
                'tab'              => 'Experience 4',
                'judul'            => 'Professional Experience',
                'logo'             => 'assets/pengalaman3/logo.png',
                'perusahaan'       => 'Port Hospital (IHC Group)',
                'posisi'           => 'Final Project',
                'periode'          => 'February - May 2025',
                'foto'             => ['assets/pengalaman3/foto1.png', 'assets/pengalaman3/foto2.png', 'assets/pengalaman3/foto3.png'],
                'poin'             => [
                    ['label' => 'Key Responsibilities', 'isi' => 'Analyzed the manual patient registration process and developed a web-based online booking system for outpatient clinics, including patient registration, doctor schedules, queue slots, booking, data management, and booking confirmation.'],
                    ['label' => 'Value/Impact',         'isi' => 'Improved registration efficiency, reduced queues and waiting time, centralized patient and booking data, and enabled patients, administrators, and doctors to manage registration and schedules more effectively.'],
                ],
            ],

            // ===== 5 =====
            [
                'tab'              => 'Experience 5',
                'judul'            => 'Professional Experience',
                'logo'             => 'assets/pengalaman4/logo.png',
                'perusahaan'       => 'South Sumatra Regional Police',
                'posisi'           => 'Final Project',
                'divisi'           => 'Information and Communication Technology Division, Tekkom Subdivision',
                'periode'          => 'February - May 2025',
                'foto'             => ['assets/pengalaman4/foto1.png', 'assets/pengalaman4/foto2.png', 'assets/pengalaman4/foto3.png'],
                'poin'             => [
                    ['label' => 'Key Responsibilities', 'isi' => 'Analyzed the manual process of numbering and archiving telecommunication service billing letters, then developed a web-based e-Archive system to automate document numbering, manage digital archives, approval workflows, service data, and reporting.'],
                    ['label' => 'Value/Impact',         'isi' => 'Improved archive management efficiency and document numbering accuracy, reduced recording errors, accelerated document search and tracking, and enabled structured digital archiving with role-based access and PDF reporting.'],
                ],
                     ],

           
        ],
    ];

    return view('portofolio/experience', $data);
}

public function project()
{
    $projects = [

        // ===================== PROJECT 1 =====================
        [
            'tab'     => 'Final Project',   // teks di tombol tab
            'judul'   => 'Final Project - Dinas Perindustrian Provinsi Sumatera Selatan',
            'periode' => 'February - June 2026',
            'topik'   => 'Determining Operational Budget Realization Priorities Using the Analytical Hierarchy Process (AHP) - A Web-Based Decision Support System',

            'scope' => [
                'judul' => 'Scope of Work',
                'poin'  => [
                    [
                        'label' => 'Analyzed the current budget evaluation process',
                        'isi'   => 'at the South Sumatra Provincial Industry Office through observation and interviews, identifying that prioritization still relied on Microsoft Excel and subjective judgment.',
                    ],
                    [
                        'label' => 'Designed the AHP decision model,',
                        'isi'   => 'including criteria hierarchy, Saaty-scale pairwise comparison matrix, sub-criteria scoring, weight calculation, and consistency testing (CI & CR).',
                    ],
                    [
                        'label' => 'Developed an end-to-end web-based Decision Support System',
                        'isi'   => 'using the Waterfall method (analysis, design, implementation, testing) with role-based access for Employee, Admin, and Leadership, then validated it through Black Box Testing.',
                    ],
                ],
            ],

            'dataset' => [
                'judul' => 'Datasets Sources',
                'grup'  => [
                    [
                        'judul' => 'Primary Data',
                        'poin'  => ['Direct observation and interviews with the finance division to understand the running business process and the problems faced.'],
                    ],
                    [
                        'judul' => 'Secondary Data',
                        'poin'  => ['Work Plan & Budget (RKA GU 1 Detail) and 2025 operational spending realization data of the South Sumatra Provincial Industry Office, plus literature references for the AHP pairwise comparison.'],
                    ],
                ],
            ],

            'instrumen' => [
                'judul' => 'Tools & Technologies',
                'poin'  => [
                    'PHP with CodeIgniter 4 Framework',
                    'MySQL Database (phpMyAdmin)',
                    'XAMPP Local Server & Visual Studio Code',
                    'draw.io (Flowchart & UML Design)',
                ],
            ],

            'pengolahan' => [
                'judul' => 'Data Processing & Documentation',
                'item'  => [
                    ['logo' => 'assets/logo/codeigniter.png', 'alt' => 'CodeIgniter 4'],
                    ['logo' => 'assets/logo/mysql.png',       'alt' => 'MySQL'],
                    ['logo' => 'assets/logo/excel.png',       'alt' => 'Excel'],
                    ['logo' => 'assets/logo/word.png',        'alt' => 'Microsoft Word'],
                ],
            ],

            'hasil' => [
                'judul' => 'Result and Impact',
                'kolom' => [
                    [
                        'label'  => 'Defined 5 weighted criteria',
                        'isi'    => 'from RKA GU 1 data: Operational Description (0.30), Budget (0.25), Transaction Description (0.20), Recipient (0.15), and Work Program (0.10), with a Consistency Ratio of 0.000 (valid, CR ≤ 0.1).',
                        'gambar' => 'assets/pengalaman2/hasil1.png',
                        'alt'    => 'Grafik bobot kriteria AHP',
                    ],
                    [
                        'label'  => 'Produced an objective activity ranking',
                        'isi'    => 'on 5 sample transactions, where Field Technical Verification of Business Permits ranked first (0.289) and Office Supplies Purchase ranked last (0.149).',
                        'gambar' => 'assets/pengalaman2/hasil2.png',
                        'alt'    => 'Grafik hasil perankingan AHP',
                    ],
                ],
                'rekomendasi' => [
                    'label' => 'System Outcome:',
                    'isi'   => 'Delivered a web-based DSS in which employees submit activities, admins manage data, and leadership verifies and sets priorities. All main functions passed Black Box Testing. Future work: automatic notifications, analytic dashboards, and integration with other government platforms.',
                ],
            ],

            'dokumentasi' => [
                'judul' => 'Documentation',
                'foto'  => [
                    ['src' => 'assets/pengalaman2/foto1.png', ],
                    ['src' => 'assets/pengalaman2/foto2.png',],
                    ['src' => 'assets/pengalaman2/foto3.png', ],
                ],
            ],
        ],

        // ===================== PROJECT 2 =====================
[
    'tab'     => 'Hospital Booking',
    'judul'   => 'Final Project - Rumah Sakit Pelabuhan Palembang',
    'periode' => 'February - May 2025',
    'topik'   => 'Online Booking Application for Specialty Clinic Patient Registration - A Website-Based System at Pelabuhan Hospital Palembang',

    'scope' => [
        'judul' => 'Scope of Work',
        'poin'  => [
            [
                'label' => 'Analyzed the current patient registration process',
                'isi'   => 'at Pelabuhan Hospital Palembang through observation and interviews, identifying manual registration at the counter, physical-document verification, non-digital archives, and no online access to clinic and doctor schedules.',
            ],
            [
                'label' => 'Designed the system model using UML,',
                'isi'   => 'including use case, class, activity, and sequence diagrams, plus a data dictionary of 9 tables (booking, doctor, doctor_poli, schedule, doctor_schedule, patient, registration, poli, and user).',
            ],
            [
                'label' => 'Developed an end-to-end web-based booking application',
                'isi'   => 'using the Waterfall method (requirement, design, implementation, verification, maintenance) with role-based access for Patient, Admin, and Doctor, then validated it through Black Box Testing.',
            ],
        ],
    ],

    'dataset' => [
        'judul' => 'Datasets Sources',
        'grup'  => [
            [
                'judul' => 'Primary Data',
                'poin'  => ['Direct observation of the patient registration flow and interviews with registration staff, doctors, and hospital management to understand the running process and the need for an online booking application.'],
            ],
            [
                'judul' => 'Secondary Data',
                'poin'  => ['Specialty clinic registration data and doctor schedules of Pelabuhan Hospital Palembang, plus literature references (books, journals, and websites) supporting the system design.'],
            ],
        ],
    ],

    'instrumen' => [
        'judul' => 'Tools & Technologies',
        'poin'  => [
            'PHP & MySQL Database (phpMyAdmin)',
            'XAMPP v8.3.0 Local Server & Visual Studio Code',
            'draw.io (UML Design)',
            'figma (Website Design Mockup)',
        ],
    ],

    // Ganti logo sesuai file yang kamu punya di public/assets/logo/
    'pengolahan' => [
        'judul' => 'Data Processing & Documentation',
        'item'  => [
            ['logo' => 'assets/logo/php.png',    'alt' => 'PHP'],
            ['logo' => 'assets/logo/mysql.png',  'alt' => 'MySQL'],
            ['logo' => 'assets/logo/drawio.png',  'alt' => 'drawio'],
            ['logo' => 'assets/logo/figma.png', 'alt' => 'figma'],
        ],
    ],

    // Ganti gambar dengan hasil kamu di public/assets/project2/
    'hasil' => [
        'judul' => 'Result and Impact',
        'kolom' => [
            [
                'label'  => 'Mapped the existing workflow and its problems',
                'isi'    => 'from observation and interviews: manual queue numbers, manual data verification, paper-based records, and no online registration or schedule access, then translated them into patient, admin, and doctor features.',
                'gambar' => 'assets/pengalaman3/hasil1.png',
                'alt'    => 'Use case diagram sistem booking online',
            ],
            [
                'label'  => 'Passed Black Box Testing on all modules',
                'isi'    => 'covering login, dashboard, clinic and schedule management, patient data, booking verification, booking history, and printing of booking proof, all with the expected result (OK).',
                'gambar' => 'assets/pengalaman3/hasil2.png',
                'alt'    => 'Tabel hasil pengujian black box',
            ],
        ],
        'rekomendasi' => [
            'label' => 'System Outcome:',
            'isi'   => 'Delivered a web-based booking application in which patients register, choose a clinic schedule, and print a queue number, while admins manage clinic, schedule, and patient data and doctors view bookings. The system has not yet been tested in real hospital operations. Future work: EMR integration, real-time queue monitoring, two-factor authentication, and staff training.',
        ],
    ],

    // Ganti foto dengan screenshot aplikasi kamu
    'dokumentasi' => [
        'judul' => 'Documentation',
        'foto'  => [
            ['src' => 'assets/pengalaman3/foto1.png', ],
            ['src' => 'assets/pengalaman3/foto2.png',],
            ['src' => 'assets/pengalaman3/foto3.png', ],
        ],
    ],
],

               // ===================== PROJECT 3 =====================
        [
            'tab'     => 'Letter Archiving',
            'judul'   => 'Final Project - Kepolisian Daerah Sumatera Selatan (Subbid TIK)',
            'periode' => 'February - May 2025',
            'topik'   => 'Telecommunication Billing Letter Numbering and Archiving Application (e-Arsip Tekkom) - A Web-Based System at the South Sumatra Regional Police',

            'scope' => [
                'judul' => 'Scope of Work',
                'poin'  => [
                    [
                        'label' => 'Analyzed the current letter numbering and archiving process',
                        'isi'   => 'at the Communication Technology Subdivision (Subbid Tekkom), ICT Division of the South Sumatra Regional Police through observation and interviews, identifying manual recording in an archive book, risk of recording errors, slow document search, and risk of physical document loss or damage.',
                    ],
                    [
                        'label' => 'Designed the system model using UML,',
                        'isi'   => 'including use case, activity, sequence, and class diagrams, a data dictionary and table design of 5 tables (users, surat, kategori_surat, layanan, and grafik), plus a UI/UX prototype in Figma.',
                    ],
                    [
                        'label' => 'Developed an end-to-end web-based archiving application',
                        'isi'   => 'using the Waterfall method (requirement analysis, design, implementation, testing, maintenance) with role-based access for Admin Tekkom and Head of Division, then validated it through Black Box Testing.',
                    ],
                ],
            ],

            'dataset' => [
                'judul' => 'Datasets Sources',
                'grup'  => [
                    [
                        'judul' => 'Primary Data',
                        'poin'  => ['Direct observation and interviews with Subbid Tekkom staff to understand the running letter recording, numbering, approval, and archiving process and the problems faced.'],
                    ],
                    [
                        'judul' => 'Secondary Data',
                        'poin'  => ['Organization profile and structure of the ICT Division, letter types (Nota Dinas, BA Coklit, BAPP, and BASTP), letter categories, telecommunication service data (service type, bill amount, and usage period), plus literature references (journals and books) supporting the system design.'],
                    ],
                ],
            ],

            'instrumen' => [
                'judul' => 'Tools & Technologies',
                'poin'  => [
                    'PHP with CodeIgniter 4 Framework',
                    'MySQL Database & XAMPP Local Server',
                    'Visual Studio Code & Google Chrome',
                    'draw.io (UML & Flowchart Design) and Figma (UI/UX Prototype)',
                ],
            ],

            'pengolahan' => [
                'judul' => 'Data Processing & Documentation',
                'item'  => [
                    ['logo' => 'assets/logo/codeigniter.png', 'alt' => 'CodeIgniter 4'],
                    ['logo' => 'assets/logo/mysql.png',       'alt' => 'MySQL'],
                    ['logo' => 'assets/logo/drawio.png',      'alt' => 'draw.io'],
                    ['logo' => 'assets/logo/figma.png',       'alt' => 'Figma'],
                ],
            ],

            'hasil' => [
                'judul' => 'Result and Impact',
                'kolom' => [
                    [
                        'label'  => 'Mapped the manual workflow and its problems',
                        'isi'    => 'from observation and interviews: handwritten archive book, manual letter numbering, difficult document search, and risk of lost or damaged paper files, then translated them into functional requirements for Admin Tekkom and Head of Division.',
                        'gambar' => 'assets/pengalaman4/hasil1.png',
                        'alt'    => 'Use case diagram e-Arsip Tekkom',
                    ],
                    [
                        'label'  => 'Passed Black Box Testing on both user roles',
                        'isi'    => 'covering login, user, service, and category management, letter input with automatic numbering, letter approval, monthly telecommunication usage graph, filtered archive report, and PDF report download.',
                        'gambar' => 'assets/pengalaman4/hasil2.png',
                        'alt'    => 'Tabel hasil pengujian black box',
                    ],
                ],
                'rekomendasi' => [
                    'label' => 'System Outcome:',
                    'isi'   => 'Delivered a web-based e-Arsip in which admins input letters and get automatic archive numbers, submit Nota Dinas for approval, and record monthly service usage, while the Head of Division approves letters, monitors usage graphs, and downloads PDF reports. The system was assessed as technically, operationally, and economically feasible. Future work: UI refinement, automatic backup and offline mode, and approval notifications.',
                ],
            ],

            'dokumentasi' => [
                'judul' => 'Documentation',
                'foto'  => [
                    ['src' => 'assets/pengalaman4/foto1.png'],
                    ['src' => 'assets/pengalaman4/foto2.png'],
                    ['src' => 'assets/pengalaman4/foto3.png'],
                ],
            ],
        ],
    ];

    $data = [
        'title'    => 'Selected Project',
        'nama'     => 'DIMAS KURNIA PUTRA',
        'aktif'    => 'project',
        'menu'     => $this->menu(),
        'projects' => array_slice($projects, 0, 3),   // maksimal 3
    ];

    return view('portofolio/project', $data);
}
 
public function skills()
{
    $data = [
        'title'     => 'Technical Skills',
        'nama'      => 'DIMAS KURNIA PUTRA',
        'aktif'     => 'skills',
        'menu'      => $this->menu(),
        'judul'     => 'Technical Skills',
        'subjudul'  => 'Summary',
        'ringkasan' => 'Information Systems graduate experienced in analyzing business processes, designing system models, and building web-based applications and decision support systems for government and healthcare institutions.',

        // Kartu besar (kolom kiri)
        'kelompok' => [
            [
                'judul' => 'Web Development',
                'poin'  => [
                    [
                        'label' => 'PHP & CodeIgniter 4',
                        'isi'   => 'Built end-to-end web applications with MVC structure, role-based access, and CRUD modules, including a Decision Support System, a hospital online booking application, and a letter archiving application.',
                    ],
                    [
                        'label' => 'MySQL Database',
                        'isi'   => 'Designed relational databases and data dictionaries, and managed data through phpMyAdmin on a local XAMPP server.',
                    ],
                    [
                        'label' => 'UI/UX Prototyping',
                        'isi'   => 'Designed website mockups and application interfaces in Figma before implementation.',
                    ],
                ],
            ],
            [
                'judul' => 'System Analysis & Design',
                'poin'  => [
                    [
                        'label' => 'Business Process Analysis',
                        'isi'   => 'Conducted observation and interviews to map running processes, identify problems, and translate them into functional and non-functional requirements.',
                    ],
                    [
                        'label' => 'UML Modeling',
                        'isi'   => 'Produced use case, activity, sequence, and class diagrams, plus flowcharts and data dictionaries using draw.io.',
                    ],
                    [
                        'label' => 'Waterfall Methodology',
                        'isi'   => 'Applied the Waterfall method from requirement analysis, design, and implementation to testing across three final projects.',
                    ],
                ],
            ],
            [
                'judul' => 'Decision Support & Testing',
                'poin'  => [
                    [
                        'label' => 'Analytical Hierarchy Process (AHP)',
                        'isi'   => 'Built decision models with Saaty-scale pairwise comparison, weight calculation, and consistency testing (CI & CR) to produce objective rankings.',
                    ],
                    [
                        'label' => 'Black Box Testing',
                        'isi'   => 'Validated system functions per user role through structured test scenarios and expected results.',
                    ],
                ],
            ],
        ],

        // Kartu kecil (kolom kanan)
        'samping' => [
            [
                'judul' => 'Programming & Database',
                'poin'  => ['PHP', 'CodeIgniter 4', 'MySQL'],
            ],
            [
                'judul' => 'Tools',
                'poin'  => [
                    'Visual Studio Code',
                    'XAMPP & phpMyAdmin',
                    'draw.io',
                    'Figma',
                ],
            ],
            [
                'judul' => 'Documentation',
                'poin'  => [
                    'Microsoft Word',
                    'Microsoft Excel',
                ],
            ],
        ],

        // Tag kecil di bawah
        'chips' => [
            'PHP',
            'CodeIgniter 4',
            'MySQL',
            'AHP',
            'UML',
            'Waterfall',
            'Black Box Testing',
            'Figma',
            'draw.io',
        ],
    ];

    return view('portofolio/skills', $data);
}

public function education()
{
    $data = [
        'title'     => 'Education',
        'nama'      => 'DIMAS KURNIA PUTRA',
        'aktif'     => 'education',
        'menu'      => $this->menu(),
        'judul'     => 'Education',
        'subjudul'  => 'Summary',
        'ringkasan' => 'Applied Bachelor\'s graduate (S.Tr.) in Informatics Management with a 3.70 / 4.00 GPA, experienced in building web-based information systems with PHP, CodeIgniter 4, and MySQL to digitalize administrative processes in government institutions.',

        // Kartu besar (kolom kiri)
        'pendidikan' => [
            [
                'institusi' => 'Politeknik Negeri Sriwijaya',
                'jurusan'   => 'Applied Bachelor\'s Degree (D-IV) in Informatics Management - Sarjana Terapan (S.Tr.)',
                'periode'   => 'September 2022 - July 2026',
                'lokasi'    => 'Palembang, Indonesia',
                'ipk'       => 'GPA: 3.70 / 4.00',
                'poin'      => [
                    [
                        'label' => 'Final Project',
                        'isi'   => 'Determining Operational Budget Realization Priorities Using the Analytical Hierarchy Process (AHP) - A Web-Based Decision Support System at the South Sumatra Provincial Industry Office (February - June 2026).',
                    ],
                    [
                        'label' => 'MBKM Independent Research Program',
                        'isi'   => 'Developed a web-based official travel information system at the South Sumatra Provincial Industry Office to replace Excel-based recording (September 2025 - January 2026).',
                    ],
                    [
                        'label' => 'Administrative Internship',
                        'isi'   => 'Handled data entry, document archiving, and a web-based activity submission application at the South Sumatra Provincial Industry Office (February - June 2025).',
                    ],
                ],
            ],
        ],

        // Kartu kecil (kolom kanan)
        'samping' => [
            [
                'judul' => 'Certifications & Training',
                'poin'  => [
                    'Digital Fraud Education Webinar - White Swindler (2026)',
                    'AI for Generation Z Webinar - AI For Everyone (2025)',
                    'Data Analyst Bootcamp - Karirnex, PT Ebiz Prima Nusa (2024)',
                    'Learn the Basics of SQL - Dicoding (2024)',
                    'Learn the Basics of Data Science - Dicoding (2024)',
                    'Learn the Basics of Artificial Intelligence - Dicoding (2024)',
                    'Learn the Basics of Project Management - Dicoding (2024)',
                    'Learn Personal Development Strategies - Dicoding (2024)',
                ],
            ],
        ],
    ];

    return view('portofolio/education', $data);
}

public function certifications()
{
    // 'file' = path relatif dari folder public/
    $sertifikat = [
        [
            'judul'    => 'Digital Fraud Education Webinar',
            'penerbit' => 'White Swindler',
            'tahun'    => '2026',
            'id'       => '022/UMUM/RTIKSUB/XI/2026',
            'file'     => 'assets/pdf/Sertifikat Webinar Edukasi Penipuan Digital .pdf',
        ],
        [
            'judul'    => 'AI for Generation Z Webinar',
            'penerbit' => 'AI For Everyone',
            'tahun'    => '2025',
            'id'       => 'AIFE-GZ-191225-764381',
            'file'     => 'assets/pdf/Sertifikat webinar Ai For Gen Z DIMAS KURNIA PUTRA.pdf',
        ],
        [
            'judul'    => 'Data Analyst Bootcamp',
            'penerbit' => 'Karirnex - PT Ebiz Prima Nusa',
            'tahun'    => '2024',
            'id'       => '033/B-2/KBT.DATA-ANALYST.1/KRX/IV/2024',
            'file'     => 'assets/pdf/Sertifikat Bootcamp Data Analyst Karirnex - Dimas Kurnia Putra.pdf',
        ],
        [
            'judul'    => 'Learn the Basics of Structured Query Language (SQL)',
            'penerbit' => 'Dicoding',
            'tahun'    => '2024',
            'id'       => '6RPN1J059X2M',
            'file'     => 'assets/pdf/Sertifikat Belajar Dasar Structured Query Language (SQL).pdf',
        ],
        [
            'judul'    => 'Learn the Basics of Data Science',
            'penerbit' => 'Dicoding',
            'tahun'    => '2024',
            'id'       => '1OP8WEMO8XQK',
            'file'     => 'assets/pdf/Sertifikat Belajar Dasar Data Science.pdf',
        ],
        [
            'judul'    => 'Learn the Basics of Artificial Intelligence',
            'penerbit' => 'Dicoding',
            'tahun'    => '2024',
            'id'       => '1OP8WEM42XQK',
            'file'     => 'assets/pdf/Sertifikat Belajar Dasar AI.pdf',
        ],
        [
            'judul'    => 'Learn the Basics of Project Management',
            'penerbit' => 'Dicoding',
            'tahun'    => '2024',
            'id'       => 'N9ZOMJL06PG5',
            'file'     => 'assets/pdf/Sertifikat Belajar Dasar Manajemen Proyek.pdf',
        ],
        [
            'judul'    => 'Learn Personal Development Strategies',
            'penerbit' => 'Dicoding',
            'tahun'    => '2024',
            'id'       => '0LZ06EE10Z65',
            'file'     => 'assets/pdf/Sertifikat Belajar Strategi Pengembangan Diri.pdf',
        ],
    ];

    $data = [
        'title'      => 'Certifications',
        'nama'       => 'DIMAS KURNIA PUTRA',
        'aktif'      => 'certifications',
        'menu'       => $this->menu(),
        'judul'      => 'Certifications',
        'subjudul'   => 'Summary',
        'ringkasan'  => 'Webinars, a data analyst bootcamp, and online courses covering SQL, data science, artificial intelligence, project management, and personal development.',
        'sertifikat' => $sertifikat,
    ];

    return view('portofolio/certifications', $data);
}
}