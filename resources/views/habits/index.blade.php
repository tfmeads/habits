<?
$actives = $actives->sortBy('period');
$archives = $archives->sortBy('period');

session(['previous-url' => request()->url()]);
//todo show soft-deleted

?>
<x-homenav>
<x-slot:heading>Manage Habits</x-slot:heading>
<div style="display: flex; flex-direction: column; align-items: center;">
    
    <button style="background-color: #90EE90;" type="button"><a  href="/habits/create">Track New Habit</a></button>

    @include('components.habitlist', ['title' => 'Active Habits', 'list' => $actives])
        
    @include('components.habitlist', ['title' => 'Archived Habits', 'list' => $archives])
</div>

</x-homenav>

