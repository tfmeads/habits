<?
$dailies = $habits->where('period',\App\Enums\Period::DAY);
$weeklies = $habits->where('period',\App\Enums\Period::WEEK);
$monthlies = $habits->where('period',\App\Enums\Period::MONTH);
$yearlies = $habits->where('period',\App\Enums\Period::YEAR);

$now = \Carbon\Carbon::now();
$day = "Today ({$now->format('m/d')})";
$week = $now->startOfWeek()->format('m/d')." → ".$now->endOfWeek()->format('m/d');
?>
<x-homenav>
<x-slot:heading>Manage Habits</x-slot:heading>

@includeWhen(count($dailies) > 0,'components.habitlist', ['title' => $day, 'list' => $dailies])
@includeWhen(count($weeklies) > 0,'components.habitlist', ['title' => $week, 'list' => $weeklies])
@includeWhen(count($monthlies) > 0,'components.habitlist', ['title' => date('F'), 'list' => $monthlies])
@includeWhen(count($yearlies) > 0, 'components.habitlist', ['title' => date('Y'), 'list' => $yearlies])

</x-homenav>

<button type="button"><a  href="/habits/create">Track New Habit</a></button>
