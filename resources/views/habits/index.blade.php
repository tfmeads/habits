<?
$actives = $actives->sortBy('period');
$archives = $archives->sortBy('period');

//todo show soft-deleted

?>
<x-homenav>
<x-slot:heading>Manage Habits</x-slot:heading>

@include('components.habitlist', ['title' => 'Active Habits', 'list' => $actives])

<button type="button"><a  href="/habits/create">Track New Habit</a></button>

@include('components.habitlist', ['title' => 'Archived Habits', 'list' => $archives])

</x-homenav>

