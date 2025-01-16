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
use Whitecube\LaravelTimezones\Facades\Timezone;

class DailyHabitsMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $title;
    protected $habits;
    protected $random_task_list;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $now = Timezone::date(Carbon::now());

        $this->title = 'Daily Schedule '."({$now->format('m/d/Y')})";
        $this->habits = Habit::where('user_id',Auth::user()->id)->get();

        $this->random_task_list = $this->generate_random_daily_tasks();
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
                'tasks' => $this->random_task_list
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

    protected function generate_random_daily_tasks(){
        return $this->habits->where('period',\App\Enums\Period::WEEK);

    }
}
