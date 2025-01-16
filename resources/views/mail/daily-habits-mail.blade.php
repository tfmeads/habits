<?
$dailies = $habits->where('period',\App\Enums\Period::DAY);
$name = Auth::user()->name;
?>
<x-mail::message>
# {{$title}}

Good morning, {{$name}}!

Here is your personalized daily schedule:

<u>
    <h2>Today's Tasks</h2>
</u>
@include('components.habitlist', ['title' => '', 'list' => $tasks, 'type' => 'event', 'show_form' => false])

<u>
    <h2>Daily Habits</h2>
</u>
@include('components.habitlist', ['title' => '', 'list' => $dailies, 'type' => 'info'])

<x-mail::button url="habits.test/habits">
View Habits
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
