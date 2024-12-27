<?
$dailies = $habits->where('period',\App\Enums\Period::DAY);
$weeklies = $habits->where('period',\App\Enums\Period::WEEK);
$monthlies = $habits->where('period',\App\Enums\Period::MONTH);
$yearlies = $habits->where('period',\App\Enums\Period::YEAR);
?>
<x-homenav>
<x-slot:heading>Manage Habits</x-slot:heading>

@includeWhen(count($dailies) > 0,'components.habitlist', ['title' => 'Today', 'list' => $dailies])
@includeWhen(count($weeklies) > 0,'components.habitlist', ['title' => 'This Week', 'list' => $weeklies])
@includeWhen(count($monthlies) > 0,'components.habitlist', ['title' => 'This Month', 'list' => $monthlies])
@includeWhen(count($yearlies) > 0, 'components.habitlist', ['title' => 'This Year', 'list' => $yearlies])

</x-homenav>

<button type="button"><a  href="/habits/create">Track New Habit</a></button>
