<?php

namespace App\Console\Commands;

use App\Models\Borrowing;
use App\Notifications\OverdueReturnNotification;
use Illuminate\Console\Command;

class SendOverdueNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-overdue-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim pengingat keterlambatan pengembalian buku';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->where('tanggal_jatuh_tempo', '<', now())
            ->where('status', 'dipinjam')
            ->get();

        foreach ($borrowings as $borrowing) {
            $borrowing->user->notify(
                new OverdueReturnNotification($borrowing)
            );
        }

        $this->info("{$borrowings->count()} reminder berhasil dikirim.");

        return self::SUCCESS;
    }
}
