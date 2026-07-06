<?php

namespace App\Notifications;

use App\Models\Borrowing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OverdueReturnNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Borrowing $borrowing)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [
            'database',
            'mail',
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Keterlambatan Pengembalian Buku')
            ->greeting('Halo '.$notifiable->name)
            ->line("PERHATIAN: Buku '{$this->borrowing->book->judul}' telah terlambat dikembalikan sejak {$this->borrowing->tanggal_jatuh_tempo->format('d M Y')}.")
            ->line('Segera lakukan pengembalian untuk menghindari sanksi keterlambatan.')
            ->action('Lihat Buku', route('peminjaman.index'))
            ->line('Terima kasih telah menggunakan E-Perpus.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Keterlambatan Pengembalian',
            'message' => "'{$this->borrowing->book->judul}' terlambat dikembalikan.",
            'book_id' => $this->borrowing->book->id,
        ];
    }
}
