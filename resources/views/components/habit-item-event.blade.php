<?
$form_id = "log-habit-event-$habit->id";

if(!isset($target_date)){
    $target_date =  Whitecube\LaravelTimezones\Facades\Timezone::date(Carbon\Carbon::now());
}
if(!isset($show_form)){
    $show_form = true;
}

$valid_events = $habit->get_events_for_deadline($target_date->clone());
$todays_events = $habit->get_events_for_day($target_date->clone());
$times_done = $valid_events->count();

$completed = $times_done >= $habit->frequency;
$locked = $habit->period != App\Enums\Period::DAY && $habit->get_allowed_logs_left($target_date) <= 0;

if($completed){
    $color = '#90EE90';
}
else if($times_done == 0){
    $color = '#FFCCCB';
}
else{
    $color = $locked ? '#ADD8E6' : '#FFFFC5';
}

$checked = $todays_events->count();

$title = $habit->name;
?>

<button style="background-color:{{$color}}; width: 100%;" {{$completed ? 'disabled' : ''}}form={{$form_id}}><strong>{{$title}}</strong> {{$times_done}}/{{$habit->frequency}} times <br> @if(!$checked) <br> @endif
    @foreach($todays_events as $event)
    ✓
    @endforeach
</button> 

@if($show_form)
<input hidden class="hidden" class="display: none;" form={{$form_id}} name="date" value={{$target_date}} />
@endif


<form id={{$form_id}} class="hidden" method="POST" action={{"/habits/$habit->id/logevent"}}>
    @csrf
    @method('POST')

</form>
