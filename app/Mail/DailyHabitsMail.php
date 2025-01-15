<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\Habit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyHabitsMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $title;
    protected $habits;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $now = \Carbon\Carbon::now();
        $this->title = 'Daily Schedule '."({$now->format('m/d/Y')})";
        $this->habits = Habit::where('user_id',Auth::user()->id)->get();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        
        return new Envelope(
            subject: $this->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.daily-habits-mail',
            with: [
                'title' => $this->title,
                'habits' => $this->habits,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
