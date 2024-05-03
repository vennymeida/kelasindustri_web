<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LowonganPekerjaan;
use Carbon\Carbon;

class UpdateClosingStatus extends Command
{
    protected $signature = 'closingstatus:update';
    protected $description = 'Update closing status of items whose closing date is today';

    public function handle()
    {
        // Dapatkan item yang perlu diperbarui
        $itemsToUpdate = LowonganPekerjaan::whereDate('tgl_tutup', now()->toDateString())->get();

        // Perbarui status setiap item yang ditemukan
        foreach ($itemsToUpdate as $item) {
            $item->update(['status' => 'ditutup']);
        }

        // Menampilkan pesan ke konsol
        $this->info('Closing status updated for items whose closing date is today.');

        return 0; // Mengembalikan 0 menunjukkan bahwa perintah berhasil
    }
}
