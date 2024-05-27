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
                'nama_loker' => 'Wordpress Front End Developer',
                'persyaratan' => 'menguasai framework laravel, bisa slicing website, lulusan SMK jurusan rekayasa perangkat lunak',
                'deskripsi' => 'mengimplementasikan ui ke dalam frontend',
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
                'persyaratan' => 'menguasai bahasa pemrograman laravel, mampu merancang api',
                'deskripsi' => 'Pengalaman Kurang dari 1 tahun dan minimal SMA/SMK',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'laravel, mysql, api',
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
                'deskripsi' => 'mengelola basis data, mengelola api',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'spatie',
                'lokasi' => 'Kediri',
                'gaji_bawah' => '1000000',
                'gaji_atas' => '5000000',
                'kuota' => 7,
                'tgl_tutup' => Carbon::create('2025', '01', '01'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Mobile App Developer (Android)',
                'persyaratan' => 'Pengalaman minimal 2 tahun dengan Kotlin, pemahaman mendalam tentang Android SDK',
                'deskripsi' => 'Mengembangkan aplikasi Android yang inovatif dan berkinerja tinggi',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Kotlin, Android SDK, RESTful APIs',
                'lokasi' => 'Jakarta',
                'gaji_bawah' => 6000000,
                'gaji_atas' => 9000000,
                'kuota' => 4,
                'tgl_tutup' => Carbon::create('2024', '09', '15'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'UI/UX Designer',
                'persyaratan' => 'Portofolio yang kuat, pengalaman dengan Figma atau Adobe XD, pemahaman tentang prinsip desain',
                'deskripsi' => 'Merancang antarmuka pengguna yang menarik dan pengalaman pengguna yang intuitif',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Figma, Adobe XD, UI/UX Design',
                'lokasi' => 'Bandung',
                'gaji_bawah' => 5500000,
                'gaji_atas' => 8500000,
                'kuota' => 2,
                'tgl_tutup' => Carbon::create('2024', '10', '31'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Digital Marketing Specialist',
                'persyaratan' => 'Pengalaman di bidang pemasaran digital, pemahaman tentang SEO dan SEM',
                'deskripsi' => 'Mengelola kampanye pemasaran digital, menganalisis kinerja, dan meningkatkan ROI',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'SEO, SEM, Google Analytics',
                'lokasi' => 'Yogyakarta',
                'gaji_bawah' => 4500000,
                'gaji_atas' => 7000000,
                'kuota' => 3,
                'tgl_tutup' => Carbon::create('2024', '11', '20'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Business Analyst',
                'persyaratan' => 'Gelar Sarjana di bidang terkait, pengalaman menganalisis data dan membuat laporan',
                'deskripsi' => 'Mengidentifikasi peluang bisnis, menganalisis tren pasar, dan memberikan rekomendasi strategis',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Analisis Data, Laporan Bisnis, Strategi',
                'lokasi' => 'Denpasar',
                'gaji_bawah' => 5000000,
                'gaji_atas' => 8000000,
                'kuota' => 2,
                'tgl_tutup' => Carbon::create('2024', '12', '05'),
                'status' => 'Dibuka'
            ],
             [
                'perusahaan_id' => 1,
                'nama_loker' => 'Software Engineer',
                'persyaratan' => 'Gelar sarjana di ilmu komputer atau bidang terkait, pengalaman dengan Java atau Python',
                'deskripsi' => 'Merancang, mengembangkan, dan menguji perangkat lunak baru',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Java, Python, Git',
                'lokasi' => 'Surabaya',
                'gaji_bawah' => 7000000,
                'gaji_atas' => 10000000,
                'kuota' => 6,
                'tgl_tutup' => Carbon::create('2024', '09', '30'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Product Manager',
                'persyaratan' => 'Pengalaman minimal 3 tahun sebagai manajer produk, pemahaman mendalam tentang pengembangan produk',
                'deskripsi' => 'Mengelola siklus hidup produk, mengidentifikasi kebutuhan pelanggan, dan memimpin tim pengembangan',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'Manajemen Produk, Pengembangan Produk, Agile',
                'lokasi' => 'Jakarta',
                'gaji_bawah' => 9000000,
                'gaji_atas' => 13000000,
                'kuota' => 2,
                'tgl_tutup' => Carbon::create('2024', '10', '15'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'DevOps Engineer',
                'persyaratan' => 'Pengalaman dengan AWS atau Azure, pemahaman tentang CI/CD, scripting (Bash, Python)',
                'deskripsi' => 'Mengotomatiskan proses pengembangan dan deployment, mengelola infrastruktur cloud',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'AWS, Azure, CI/CD, Bash, Python',
                'lokasi' => 'Jakarta',
                'gaji_bawah' => 7500000,
                'gaji_atas' => 11000000,
                'kuota' => 3,
                'tgl_tutup' => Carbon::create('2024', '11', '10'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Data Analyst',
                'persyaratan' => 'Gelar Sarjana di bidang terkait, pengalaman dengan SQL dan alat visualisasi data',
                'deskripsi' => 'Mengumpulkan, menganalisis, dan menginterpretasikan data untuk mendukung pengambilan keputusan bisnis',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'SQL, Tableau, Power BI',
                'lokasi' => 'Bandung',
                'gaji_bawah' => 5000000,
                'gaji_atas' => 7500000,
                'kuota' => 4,
                'tgl_tutup' => Carbon::create('2024', '12', '20'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Project Manager',
                'persyaratan' => 'Sertifikasi PMP atau PRINCE2, pengalaman minimal 5 tahun dalam manajemen proyek',
                'deskripsi' => 'Memimpin tim proyek, merencanakan dan melaksanakan proyek sesuai jadwal dan anggaran',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'Manajemen Proyek, PMP, PRINCE2',
                'lokasi' => 'Surabaya',
                'gaji_bawah' => 8000000,
                'gaji_atas' => 12000000,
                'kuota' => 2,
                'tgl_tutup' => Carbon::create('2025', '01', '15'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Customer Service Representative',
                'persyaratan' => 'Komunikasi yang baik, kemampuan memecahkan masalah, sabar dan ramah',
                'deskripsi' => 'Menangani pertanyaan pelanggan, menyelesaikan keluhan, dan memberikan dukungan',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'Layanan Pelanggan, Komunikasi, Pemecahan Masalah',
                'lokasi' => 'Yogyakarta',
                'gaji_bawah' => 3500000,
                'gaji_atas' => 5500000,
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2024', '09', '05'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Data Scientist',
                'persyaratan' => 'Gelar Master dalam Ilmu Data atau bidang terkait, pengalaman dengan Python dan R',
                'deskripsi' => 'Mengembangkan model machine learning untuk analisis data',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'Python, R, Machine Learning',
                'lokasi' => 'Jakarta',
                'gaji_bawah' => 8000000,
                'gaji_atas' => 12000000,
                'kuota' => 3,
                'tgl_tutup' => Carbon::create('2024', '12', '31'),
                'status' => 'Dibuka'
            ]
        ]);
    }
}
