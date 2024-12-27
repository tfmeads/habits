<x-homenav>
<x-slot:heading>
    Manage Habits
</x-slot:heading>

<ul>
@foreach ($habits as $habit)
    <li><a href="/habits/{{$habit->id}}"><strong>{{$habit->name}}</strong></a> {{$habit->frequency}} times a {{$habit->period}}</li>
@endforeach
</ul>
</x-homenav>

<button type="button"><a  href="/habits/create">Track New Habit</a></button>
