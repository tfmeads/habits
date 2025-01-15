<?
$form_id = "log-habit-event-$habit->id";
$now = \Carbon\Carbon::now();

//dd($now->startOfDay());

switch($habit->period){
    case \App\Enums\Period::DAY:
        $created_at_deadline = $now->startOfDay();
        break;
    case \App\Enums\Period::WEEK:
        $created_at_deadline = $now->startOfWeek(\Carbon\Carbon::MONDAY);
        break;
    case \App\Enums\Period::MONTH:
        $created_at_deadline = $now->startOfMonth();
        break;
    case \App\Enums\Period::YEAR:
        $created_at_deadline = $now->startOfYear();
        break;
}


$valid_events = DB::table('habit_events')
                ->where('habit_id','=',$habit->id)
                ->whereDate('created_at', '>=', $created_at_deadline)
                ->get();

$times_done = $valid_events->count();

$locked = $times_done >= $habit->frequency;
?>
<button style="background-color:{{$locked ? '#90EE90' : '#FFCCCB'}};" {{$locked ? 'disabled' : ''}}form={{$form_id}}><strong>{{$habit->name}}</strong> {{$times_done}}/{{$habit->frequency}} times</button>


<form id={{$form_id}} class="hidden" method="POST" action={{"/habits/$habit->id/logevent"}}>
    @csrf
    @method('POST')
</form>