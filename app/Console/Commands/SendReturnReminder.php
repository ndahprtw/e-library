<?php

namespace App\Console\Commands;

use App\Models\Borrowing;
use App\Notifications\ReturnReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendReturnReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-return-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim email pengingat h-1 pengembalian buku';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->whereDate('tanggal_jatuh_tempo', Carbon::tomorrow())
            ->where('status', 'dipinjam')
            ->get();

        foreach ($borrowings as $borrowing) {
            $borrowing->user->notify(
                new ReturnReminderNotification($borrowing)
            );
        }

        $this->info("{$borrowings->count()} reminder berhasil dikirim.");

        return self::SUCCESS;
    }
}
