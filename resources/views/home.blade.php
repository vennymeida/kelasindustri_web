@extends('layouts.app2')
@section('title', 'JobKelasIndustri - Dashboard')
@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h1>Selamat Datang</h1>
                </div>
                <div class="col-md-12">
                    <h6>Sedang Melakukan Apa Hari ini ?</h6>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-statistic-1" style="border-radius: 15px;">
                            <div class="card-icon bg-primary" style="border-radius: 50%;">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Lulusan</h4>
                                </div>
                                <div class="card-body">
                                    {{ App\Models\Lulusan::count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-statistic-1" style="border-radius: 15px;">
                            <div class="card-icon bg-success" style="border-radius: 50%;">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Perusahaan</h4>
                                </div>
                                <div class="card-body">
                                    {{ App\Models\Perusahaan::count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-statistic-1" style="border-radius: 15px;">
                            <div class="card-icon bg-warning" style="border-radius: 50%;">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Lowongan Pekerjaan</h4>
                                </div>
                                <div class="card-body">
                                    {{ App\Models\LowonganPekerjaan::where('status', 'dibuka')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-statistic-1" style="border-radius: 15px;">
                            <div class="card-icon bg-danger" style="border-radius: 50%;">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Lamaran</h4>
                                </div>
                                <div class="card-body">
                                    {{ App\Models\Lamar::count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-header">
                                <h4>Perusahaan dengan Pelamar Terbanyak</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" height="158"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-header">
                                <h4>Capaian Lulusan</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="myChartLine" height="158"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-header">
                        <h4>Pelamar Kerja Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($dashboard as $lamar)
                                <li class="media">
                                    @if ($lamar->foto)
                                        <img src="{{ asset('storage/' . $lamar->foto) }}" alt="Foto"
                                            class="mr-3 rounded-circle" style="width: 50px; height: 50px;">
                                    @else
                                        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                            class="mr-3 rounded-circle" style="width: 50px; height: 50px;">
                                    @endif
                                    <div class="media-body">
                                        <div class="media-title">{{ $lamar->nama_loker }}</div>
                                        <span class="text-small text-muted">{{ $lamar->nama_perusahaan }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        const grafikData = @json($grafik);
        const monthNames = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        ];

        const perusahaanData = {};
        grafikData.forEach(item => {
            if (!perusahaanData[item.nama_perusahaan]) {
                perusahaanData[item.nama_perusahaan] = Array(12).fill(0);
            }
            perusahaanData[item.nama_perusahaan][parseInt(item.month) - 1] = item.jumlah_lamars;
        });

        const colors = [
            'rgba(75, 192, 192, 0.8)',
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 206, 86, 0.8)',
            'rgba(153, 102, 255, 0.8)',
            'rgba(255, 159, 64, 0.8)',
        ];

        const datasets = [];
        let colorIndex = 0;
        for (const [perusahaan, data] of Object.entries(perusahaanData)) {
            datasets.push({
                label: perusahaan,
                data: data,
                backgroundColor: colors[colorIndex++ % colors.length],
                borderWidth: 1,
            });
        }

        const myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthNames.slice(1),
                datasets: datasets,
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString("id-ID"); // Format angka dalam format Indonesia
                            },
                        },
                    },
                },
            },
        });
    </script>
@endpush

@push('customScript')
    <script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>

    <script>
        var ctx = document.getElementById("myChartLine").getContext('2d');
        const lamarData = @json($lamar); // Pastikan data pelamar diterima/ditolak dikirim dari backend

        const monthNames = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        ];

        const acceptedData = Array(12).fill(0);
        const rejectedData = Array(12).fill(0);

        lamarData.forEach(item => {
            const month = parseInt(item.created_at.split("-")[1]) - 1; // Mengambil bulan dari created_at
            if (item.status === "diterima") {
                acceptedData[month] += 1;
            } else if (item.status === "ditolak") {
                rejectedData[month] += 1;
            }
        });

        const myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthNames.slice(1),
                datasets: [
                    {
                        label: "Diterima",
                        data: acceptedData,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        tension: 0.4,
                    },
                    {
                        label: "Ditolak",
                        data: rejectedData,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 2,
                        tension: 0.4,
                    }
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString("id-ID");
                            },
                        },
                    },
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            },
        });
    </script>
@endpush
