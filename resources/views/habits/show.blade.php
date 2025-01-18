<?
$events = $habit->events()->get();
?>
<x-homenav>
<x-slot:heading>
Manage Habit
</x-slot:heading>
<link rel="stylesheet" href="{{asset('css/button.css')}}">


<h2>{{$habit['name']}}</h2> 
<strong>{{$habit['frequency']}}</strong> times a <u>{{$habit->period}}</u>


</x-homenav>

<button type="button"><a  href="/habits/{{$habit->id}}/edit">Edit Habit</a></button>

@include('components.habit-event-list', ['title' => 'History', 'events' => $events])


