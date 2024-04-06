<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>JobKelasIndustri</title>
</head>

<body>
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align ="center">
                <table width="600" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px; text-align: center;">
                            <h1 style="color: #333;">
                                Terimakasih Kepada {{ $getUserId->name }}
                            </h1>
                            <p style="font-size: 16px; color: #555;">
                                Telah mengirimkan lamaran ke {{ $getPerusahaan->nama_perusahaan }}
                            </p>

                            <!-- Formulir dengan metode GET -->
                            @if ($lamar->status == 'Diterima')
                                <h1 style="color: #555;">Selamat kamu telah</h1>
                                <h2 style="font-size: 24px; color: #00ff08; font-weight: bold;">DITERIMA</h2>
                                <p style="font-size: 16px; color: #555;"> Di {{ $getPerusahaan->nama_perusahaan }}</p>
                                <p style="font-size: 16px; color: #555;"> Untuk Posisi {{ $getPerusahaanId->nama_loker }}</p>
                            @elseif ($lamar->status == 'Ditolak')
                                <h1 style="color: #555;">Maaf, lamaran kamu telah</h1>
                                <h2 style="font-size: 24px; color: #ff0000; font-weight: bold;">DITOLAK</h2>
                                <p style="font-size: 16px; color: #555;"> Oleh {{ $getPerusahaan->nama_perusahaan }}</p>
                                <p style="font-size: 16px; color: #555;"> Untuk Posisi {{ $getPerusahaanId->nama_loker }}</p>
                                <p style="font-size: 16px; color: #555;">
                                    Jangan berkecil hati. Teruslah berusaha dan perbaiki diri. Peluang selalu ada di
                                    masa depan!
                                </p>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
