<x-mail::message>
# {{$title}}

Good morning!

Here is your daily schedule:

@include('components.habitlist', ['title' => '', 'list' => $habits, 'type' => 'event']);

<x-mail::button url="habits.test/habits">
View Habits
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
