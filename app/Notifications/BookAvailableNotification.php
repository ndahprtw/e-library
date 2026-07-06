<?php

namespace App\Notifications;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookAvailableNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Book $book)
    {
        //
    }

    // public Book $book;
    // public function __construct(Book $book)
    // {
    //     $this->book = $book;
    // }

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
            ->subject('Buku Tersedia')
            ->greeting('Halo '.$notifiable->name)
            ->line("Buku '{$this->book->judul}' yang Anda tunggu sekarang sudah tersedia.")
            ->action('Lihat Buku', route('buku.show', $this->book))
            ->line('Terima kasih telah menggunakan E-Perpus.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Buku Tersedia',
            'message' => "Buku '{$this->book->judul}' kini tersedia.",
            'book_id' => $this->book->id,
        ];
    }
}
