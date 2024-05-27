<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lokers')->insert([
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Wordpress Developer',
                'persyaratan' => 'Setidaknya memiliki 2 tahun pengalaman di bidang frontend web. Kemahiran dalam HTML, CSS, dan JavaScript, dengan pemahaman yang mendalam tentang prinsip-prinsip desain yang responsif.
                Keakraban dengan kerangka kerja dan pustaka front-end, dan kemampuan untuk memilih alat yang tepat untuk tugas yang sedang dikerjakan.
                Pengetahuan tentang kompatibilitas lintas browser dan standar aksesibilitas.
                Pengalaman dengan sistem kontrol versi, seperti Git.',
                'deskripsi' => 'Berkolaborasi dengan desainer dan pengembang back-end untuk menghidupkan antarmuka pengguna yang menawan.
                Menerapkan desain yang responsif dan ramah seluler untuk memastikan pengalaman pengguna yang optimal di seluruh perangkat.
                Menulis kode yang bersih dan terstruktur dengan baik menggunakan teknologi mutakhir seperti HTML5, CSS3, JavaScript, dan kerangka kerja / pustaka modern (misalnya, React, Angular, Vue.js).',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'CMS, WordPress Development, Web Development',
                'lokasi' => 'Malang',
                'gaji_bawah' => '3.400.000',
                'gaji_atas' => '3.700.000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2024', '08', '24'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Web Developer',
                'persyaratan' => '1. Menguasai bahasa pemrogaman ASP (NET/MVC/Classic ASP).
                2. Menguasai MS SQL Server.
                3. Menguasai HTML (AJAX, JSON, XML) dan JavaScript/jQuery.
                4. Menguasai Bahasa Inggris baik lisan maupun tulisan.
                5. Bertempat tinggal di Malang atau bersedia tinggal di Malang.
                6. Pendidikan minimal SMK Rekayasa Perangkat Lunak (RPL).',
                'deskripsi' => 'Pengalaman Kurang dari 1 tahun dan minimal SMA/SMK',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Javascript, Jquery, Bahasa Inggris, SQL, ASP.NET, XML, Microsoft SQL Server, JSON, HTML5, Ajax',
                'lokasi' => 'Surabaya',
                'gaji_bawah' => '3.900.000',
                'gaji_atas' => '4.000.000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2024', '08', '10'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Web Admin',
                'persyaratan' => 'menguasai bahasa pemrograman laravel, mampu merancang api',
                'deskripsi' => 'Mengelola web Bantu Guru Belajar Lagi',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'Menguasai bahasa pemrograman web berbasis java atau PHP serta bahasa pemrograman web lain pendukungnya seperti html, xml, javascript, css, json. Diutamakan yang menguasai konsep MVC menggunakan Play Framework, Codelgniter Framework atau Laravel Framework',
                'lokasi' => 'Jakarta',
                'gaji_bawah' => '2.000.000',
                'gaji_atas' => '3.500.000',
                'kuota' => 2,
                'tgl_tutup' => Carbon::create('2025', '01', '01'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Desain Grafis',
                'persyaratan' => 'Mampu menguasai perangkat lunak yang digunakan untuk desain seperti Adobe Photoshop, Illustrator, Memiliki kemampuan untuk menghasilkan ide-ide kreatif dan solusi desain yang unik',
                'deskripsi' => 'Membantu mempersiapkan konten-konten informatif untuk di media sosial, Membantu membuatkan poster atau media campaign lainnya',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Kerja Tim, Manajemen Waktu, Sikap Positif',
                'lokasi' => 'Jakarta',
                'gaji_bawah' => '2.000.000',
                'gaji_atas' => '3.500.000',
                'kuota' => 2,
                'tgl_tutup' => Carbon::create('2024', '09', '15'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Fullstck Developer',
                'persyaratan' => 'Berkolaborasi dengan tim untuk membuat konsep dan mengimplementasikan peningkatan sistem yang inovatif.
                Keahlian yang kuat dalam teknologi front-end (HTML, CSS, JavaScript); bahasa back-end (Python, PHP-laravel adalah suatu keharusan); kerangka kerja JavaScript (JS, JQuery, React); dan teknologi basis data (MySQL, Oracle, MongoDB).',
                'deskripsi' => 'Kami sedang mencari Full Stack Developer yang mahir yang akan berperan penting dalam pengembangan dan pemeliharaan sistem back office kami. Peran ini melibatkan pengelolaan aspek front-end dan back-end dari kantor dan dasbor pengguna kami, serta membawa ide-ide inovatif untuk meningkatkan sistem dan mesin kami secara keseluruhan.',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Pengembangan Aplikasi, Software Development, Web Development',
                'lokasi' => 'Jakarta',
                'gaji_bawah' => '5.000.000',
                'gaji_atas' => '7.000.000',
                'kuota' => 3,
                'tgl_tutup' => Carbon::create('2024', '06', '01'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 2,
                'nama_loker' => 'Staff IT',
                'persyaratan' => 'Menguasai HTML, CSS, Bootstrap, Tailwind (nilai plus), Framework Laravel & Livewire.
                Familiar dengan Database SQL, konsep relasi database, konsep API, GIT.
                Menguasai proses parsing data.
                Memiliki logika kuat untuk memecahkan masalah.
                Jujur, disiplin, rajin, memiliki loyalitas tinggi.',
                'deskripsi' => 'Bekerja dalam bidang pengelolaan web di perusahaan pada bagian frontend web saja.',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'Spring Framework, Pengembangan API, Kerja Tim, Bootstrap, SQL, GIT, Keterampilan Pemecahan Masalah, Manajemen Waktu, CSS3, Sikap Positif, TailwindCSS, HTML5',
                'lokasi' => 'Bandung',
                'gaji_bawah' => '4.000.000',
                'gaji_atas' => '7.000.000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2024', '07', '11'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 2,
                'nama_loker' => 'Frontend Web Developer',
                'persyaratan' => '1 tahun pengalaman dalam pengembangan aplikasi web mulai dari perencanaan hingga eksekusi.
                Pengetahuan tentang Electron adalah nilai tambah.
                Kemampuan dengan React.js, Javascript, CSS, Bootstrap, HTML5.
                Pengetahuan tentang React JS Workflow, Rest API, JSON, React Hook, Axios.
                Pengalaman dalam mengimplementasikan UI.
                Keinginan untuk bekerja dengan kode yang bersih dan mudah dipelihara.
                Pengetahuan tentang Git, Git Workflow, dan cara menggunakannya.',
                'deskripsi' => 'Mengidentifikasi peluang bisnis, menganalisis tren pasar, dan memberikan rekomendasi strategis',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'MySQL, React.js, Basis Data Relasional',
                'lokasi' => 'Bandung',
                'gaji_bawah' => '3.500.000',
                'gaji_atas' => '5.000.000',
                'kuota' => 2,
                'tgl_tutup' => Carbon::create('2024', '06', '11'),
                'status' => 'Dibuka'
            ],
             [
                'perusahaan_id' => 2,
                'nama_loker' => 'PHP Web Developer',
                'persyaratan' => 'Pengalaman kerja min 1 tahun. Lulusan baru dipersilahkan.
                Memiliki pengetahuan dan pengalaman yang kuat dengan PHP/MySQL.
                Pengalaman kerja minimal 1 tahun dalam menggunakan Laravel & Codeigniter Framework.
                Pengetahuan yang kuat dengan teknologi front-end (HTML/CSS/Javascript).
                Harus memiliki pengetahuan tentang hal-hal berikut ini: API, JSON, HTTP dan layanan web RESTful.
                Pengetahuan tentang NodeJS merupakan nilai tambah.
                Pengalaman Pengembangan Perangkat Seluler merupakan nilai tambah (Android / iOS).',
                'deskripsi' => 'Kami sedang mencari seorang Web Developer, Anda bertanggung jawab untuk mengembangkan dan menyesuaikan kode dari basis kode kami untuk mengembangkan modul yang diminta oleh klien, manajer proyek',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'MySQL, Microsoft SQL Server, Laravel, PHP',
                'lokasi' => 'Jakarta',
                'gaji_bawah' => '4.000.000',
                'gaji_atas' => '5.500.000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2024', '07', '19'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 2,
                'nama_loker' => 'Game Developer',
                'persyaratan' => 'Memiliki pengalaman menggunakan unity sebelumnya, lulusan baru, atau mereka yang ingin berkarir sebagai programmer game. Pengetahuan dan kemampuan untuk mengubah konsep menjadi kode yang dapat digunakan.',
                'deskripsi' => 'Membuat kode C# yang bersih dan efisien yang terdokumentasi dengan baik, mudah dipelihara, dan menambah kekuatan mesin game. (Pengetahuan tentang GDScript atau Python akan sangat membantu). Berhasil menggunakan Git untuk melacak perubahan, berkolaborasi dengan anggota tim, dan memelihara riwayat kode yang bersih',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'Manajemen Produk, Pengembangan Produk, Agile',
                'lokasi' => 'Malang',
                'gaji_bawah' => '4.000.000',
                'gaji_atas' => '7.000.000',
                'kuota' => 3,
                'tgl_tutup' => Carbon::create('2024', '08', '17'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 2,
                'nama_loker' => 'Graphic Design',
                'persyaratan' => 'Keterampilan desain grafis yang dapat dibuktikan dengan portofolio yang kuat..
                Mata yang kuat untuk komposisi visual.
                Mata yang sangat baik untuk detail.
                Pengetahuan tentang tata letak, dasar-dasar grafis, tipografi, cetak, dan web.',
                'deskripsi' => 'Bekerja dalam bidang merancang desain dalam perusahaan',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'Perhatian terhadap detail, design thinking, adobe photoshop',
                'lokasi' => 'Malang',
                'gaji_bawah' => '4.000.000',
                'gaji_atas' => '7.000.000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2024', '06', '29'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 3,
                'nama_loker' => 'UI UX Designer',
                'persyaratan' => 'Mampu bekerja dalam tim maupun individu.
                Mengetahui cara pembuatan wireframing.
                Memahami alur dan pembuatan prototyping selama proses pembuatan design UI/UX.',
                'deskripsi' => 'Membuat desain interface.
                Membuat design asset seperti icon, ilustrasi, font, dan warna.
                Kolaborasi dengan tim desain.
                Membuat desain mockup/wireframe aplikasi sesuai kebutuhan client.
                Melakukan iterasi pada desain aplikasi dan/atau situs yang telah dibuat dengan mengakomodasi masukan dari klien.
                Memaksimalkan pengalaman pengguna pada desain interface produk digital.',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Figma, Pengeditan Gambar, Adobe Photoshop',
                'lokasi' => 'Malang',
                'gaji_bawah' => '2.500.000',
                'gaji_atas' => '3.500.000',
                'kuota' => 3,
                'tgl_tutup' => Carbon::create('2024', '06', '03'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 3,
                'nama_loker' => 'Software Engineer',
                'persyaratan' => 'Pemahaman yang sangat baik terhadap setidaknya salah satu bahasa berikut: Javascript, Ruby, atau Python, Beberapa pemahaman tentang Git, mudah untuk belajar & beradaptasi dengan konsep/teknologi baruk',
                'deskripsi' => 'Peran dan tanggung jawab Software Engineer termasuk berkontribusi pada pengembangan aplikasi berbasis web, sambil memberikan keahlian dalam siklus pengembangan perangkat lunak lengkap, mulai dari konsep dan desain hingga pengujian.',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'Node.js, GIT, Ruby on Rails, HTML5',
                'lokasi' => 'Surabaya',
                'gaji_bawah' => '5.500.000',
                'gaji_atas' => '9.000.000',
                'kuota' => 2,
                'tgl_tutup' => Carbon::create('2025', '05', '30'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 3,
                'nama_loker' => 'Backend Developer',
                'persyaratan' => 'Komunikasi yang baik, kemampuan memecahkan masalah, sabar dan ramah',
                'deskripsi' => 'Menangani pertanyaan pelanggan, menyelesaikan keluhan, dan memberikan dukungan',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'MySQL, Apache, Python, Manajemen Proyek, Penyebaran Sistem, Pengembangan Web, Nginx, Software Development, Laravel, PHP',
                'lokasi' => 'Surabaya',
                'gaji_bawah' => '5.000.000',
                'gaji_atas' => '9.000.000',
                'kuota' => 3,
                'tgl_tutup' => Carbon::create('2024', '06', '07'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 3,
                'nama_loker' => 'Web Programmer',
                'persyaratan' => 'Pengalaman dengan setidaknya satu CMS (WordPress, WIX) atau Situs Perdagangan (WooCommerce, Shopify), Kemahiran dengan mesin basis data seperti MySQL atau MariaDB, Pengetahuan yang kuat tentang teknologi web front-end (HTML, CSS, jQuery) dan back-end (PHP, JavaScript)',
                'deskripsi' => 'Apakah Anda seorang Web Programmer yang berbakat? Agensi digital kami yang sangat sukses di Surabaya sedang mencari individu yang terampil dengan hasrat untuk berinovasi dan memiliki motivasi diri.',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Manajemen Situs Web, Pengembangan Wordpress, Web Development',
                'lokasi' => 'Surabaya',
                'gaji_bawah' => '4.000.000',
                'gaji_atas' => '5.000.000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2024', '06', '25'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 3,
                'nama_loker' => 'Android Developer',
                'persyaratan' => '1. Berpengalaman dalam pengembangan aplikasi Web dan Android.
                2. Kemahiran dalam bahasa pemrograman (HTML, PHP, CSS, JavaScript, Java/Kotlin, dll).
                3. Pemahaman yang kuat tentang desain antarmuka pengguna (UI/UX).
                4. Kemampuan komunikasi yang baik dan kemampuan pemecahan masalah yang kreatif.
                5. Pengalaman dengan teknologi mutakhir (XAMPP, LAMP, WAMP, dll).
                6. Pengetahuan tentang manajemen basis data (MySQL, PostgreSQL, MongoDB, dll) adalah nilai tambah.
                7. Pengalaman mengembangkan aplikasi serupa (Sumber Daya Manusia) merupakan nilai tambah.',
                'deskripsi' => '1. Kami mencari Web & Mobile Android Developer yang berpengalaman untuk membantu kami mengembangkan Sistem Informasi Sumber Daya Manusia (HRIS) yang inovatif.
                2. Anda akan bekerja dalam tim yang dinamis dan berkolaborasi dengan departemen SDM untuk menciptakan solusi yang memenuhi kebutuhan bisnis kami.',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'Software Development, Bahasa Pemrograman, Web Development',
                'lokasi' => 'Banyuwangi',
                'gaji_bawah' => '4.000.000',
                'gaji_atas' => '7.000.000',
                'kuota' => 3,
                'tgl_tutup' => Carbon::create('2024', '05', '31'),
                'status' => 'Dibuka'
            ]
        ]);
    }
}
