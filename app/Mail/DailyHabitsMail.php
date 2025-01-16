<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Enums\Period;
use App\Models\Habit;
use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
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
        $results = [];

        $now = Timezone::date(Carbon::now());
        $eow = Timezone::date(Carbon::now()->endOfWeek(Carbon::SUNDAY));
        $eom = Timezone::date(Carbon::now()->endOfMonth());

        $individual_tasks = [];

        $weeklies = $this->habits->where('period',Period::WEEK);
        $monthlies = $this->habits->where('period',Period::MONTH);


        foreach($weeklies as $habit){

            $created_at_deadline = $habit->get_deadline();

            $done_already = DB::table('habit_events')
            ->where('habit_id','=',$habit->id)
            ->whereDate('logged_at', '>=', $created_at_deadline)
            ->get();

            $times_left = $habit->frequency - $done_already->count();

            $times_left = min($times_left, $habit->get_allowed_logs_left());

            for($i = 0; $i < $times_left; $i++){
                $individual_tasks[] = $habit;
            }
        }

        $days_til_eow = intval(ceil($now->diffInDays($eow))); 
        $tasks_per_day = intval(ceil(count($individual_tasks) / $days_til_eow));
        
        // echo $now." -> ".$now->endOfWeek();
        // dd($days_til_eow);

        $results = array_merge($results,Arr::random($individual_tasks,$tasks_per_day));

        echo $tasks_per_day." / ".count($individual_tasks)." weeklies<br>";

        $individual_tasks = [];

        foreach($monthlies as $habit){

            $created_at_deadline = $habit->get_deadline();

            $done_already = DB::table('habit_events')
            ->where('habit_id','=',$habit->id)
            ->whereDate('logged_at', '>=', $created_at_deadline)
            ->get();

            $times_left = $habit->frequency - $done_already->count();
            $times_left = min($times_left, $habit->get_allowed_logs_left());

            for($i = 0; $i < $times_left; $i++){
                $individual_tasks[] = $habit;
            }
        }



        $days_til_eom = intval(ceil($now->diffInDays($eom))); 
        $tasks_per_day = intval(ceil(count($individual_tasks) / $days_til_eom));
        
        $results = array_merge($results,Arr::random($individual_tasks,$tasks_per_day));

        echo $tasks_per_day." / ".count($individual_tasks)." monthlies<br>";

        print_r($results);

        return $results;

    }
}
