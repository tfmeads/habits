<?
$dailies = $habits->where('period',\App\Enums\Period::DAY);
$weeklies = $habits->where('period',\App\Enums\Period::WEEK);
$monthlies = $habits->where('period',\App\Enums\Period::MONTH);
$yearlies = $habits->where('period',\App\Enums\Period::YEAR);

$now = \Carbon\Carbon::now()->setTime(0,0);
$target = \Carbon\Carbon::parse($target_date->clone());

$diff_string = $target->diffForHumans($now, [
    'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW,
    'skip' => 'week',
    'join' => ', '
],false,3); 

if($diff_string == '0 seconds ago'){
    $diff_string = 'Today';
}
if($diff_string == '1 day ago'){
    $diff_string = 'Yesterday';
}
if($diff_string == '1 day from now'){
    $diff_string = 'Tomorrow';
}

if($diff_string == '2 days from now'){
    $diff_string = 'Day after Tomorrow';
}

$day_label = "$diff_string ({$target_date->format('m/d')})";

$day = $target_date->clone()->subDay();
$prev = $day->format('m-d-Y');
$prev_label = $day->format('m-d');

$day = $target_date->clone()->addDay();
$next = $day->format('m-d-Y');
$next_label = $day->format('m-d');


$week = $target_date->clone()->startOfWeek(\Carbon\Carbon::MONDAY)->format('m/d')." → ".$target_date->clone()->endOfWeek(\Carbon\Carbon::SUNDAY)->format('m/d');
//Display month/year as whatever active month/year was on 1st day of week
$month = $target_date->clone()->startOfWeek(\Carbon\Carbon::MONDAY)->format('F');
$year = $target_date->clone()->startOfWeek(\Carbon\Carbon::MONDAY)->format('Y');

session(['previous-url' => request()->url()]);
?>
<x-homenav>
<x-slot:heading>Home</x-slot:heading>

<div style="margin: auto; width: 60%; display: flex; flex-direction: column; align-items:center">
    <div style="margin: auto; display: flex; flex-direction: row; align-items: baseline ">
        <button><a href={{"/home/$prev"}}><strong>{{$prev_label}}</strong></a></button>
        @includeWhen(count($dailies) > 0,'components.habitlist', ['title' => $day_label, 'list' => $dailies, 'type' => 'event'])
        <button><a href={{"/home/$next"}}><strong>{{$next_label}}</strong></a></button>
    </div>
        <div >
            @includeWhen(count($weeklies) > 0,'components.habitlist', ['title' => $week, 'list' => $weeklies, 'type' => 'event'])
        </div>
        <div>
            @includeWhen(count($monthlies) > 0,'components.habitlist', ['title' => $month, 'list' => $monthlies, 'type' => 'event'])
        </div>
        <div>
            @includeWhen(count($yearlies) > 0, 'components.habitlist', ['title' => $year, 'list' => $yearlies, 'type' => 'event'])
        </div>
</div>

</x-homenav>
