<?php
$events = $habit->events()->get();
?>
<x-homenav>
<x-slot:heading>
Manage Habit
</x-slot:heading>

</x-homenav>

<link rel="stylesheet" href="{{asset('css/habits-show.css')}}">
<link rel="stylesheet" href="{{asset('css/button.css')}}">

<div id="main-wrapper">
    
    <h2>{{$habit['name']}}</h2>
    <p><strong>{{$habit['frequency']}}</strong> {{$habit['frequency'] == 1 ? 'time' : 'times'}} a <u>{{$habit->period}}</u></p>
    
    
    <button class="btn-create" type="button"><a  href="/habits/{{$habit->id}}/edit">Edit Habit</a></button>

    <br><br>
    <hr style="width:100%; color: black">
    
    @include('components.habit-event-list', ['title' => 'History', 'events' => $events])
</div>


