<?
$form_id = "log-habit-event-$habit->id";

$valid_events = $habit->get_events_for_deadline($target_date->clone());

$times_done = $valid_events->count();

$completed = $times_done >= $habit->frequency;
$locked = $habit->period != App\Enums\Period::DAY && $habit->get_allowed_logs_left($target_date) <= 0;

if($completed){
    $color = '#90EE90';
}
else{
    $color = $locked ? '#FFFFC5' : '#FFCCCB';
}

$title = $habit->name;
?>

<button style="background-color:{{$color}};" {{$completed ? 'disabled' : ''}}form={{$form_id}}><strong>{{$title}}</strong> {{$times_done}}/{{$habit->frequency}} times</button>
<input hidden form={{$form_id}} name="date" value={{$target_date}} />


<form id={{$form_id}} class="hidden" method="POST" action={{"/habits/$habit->id/logevent"}}>
    @csrf
    @method('POST')
</form>