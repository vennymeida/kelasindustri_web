<?php

namespace App\Imports;

use App\Models\Kota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Throwable;

class KotaImport implements ToModel, WithHeadingRow, WithUpserts, SkipsOnError
{
    use Importable, SkipsErrors;

    public function model(array $row)
    {
        if (isset($row['kota'])) {
            return new Kota([
                'kota' => $row['kota'],
            ]);
        }
        throw new \Exception("Kolom kota tidak ditemukan dalam file.");
    }

    public function uniqueBy()
    {
        return 'kotas';
    }
}
