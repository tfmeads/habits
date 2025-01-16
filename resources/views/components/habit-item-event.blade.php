<?
$form_id = "log-habit-event-$habit->id";

$created_at_deadline = $habit->get_deadline();


$valid_events = DB::table('habit_events')
                ->where('habit_id','=',$habit->id)
                ->whereDate('logged_at', '>=', $created_at_deadline)
                ->get();

$times_done = $valid_events->count();

$locked = $times_done >= $habit->frequency;
?>
<button style="background-color:{{$locked ? '#90EE90' : '#FFCCCB'}};" {{$locked ? 'disabled' : ''}}form={{$form_id}}><strong>{{$habit->name}}</strong> {{$times_done}}/{{$habit->frequency}} times</button>


<form id={{$form_id}} class="hidden" method="POST" action={{"/habits/$habit->id/logevent"}}>
    @csrf
    @method('POST')
</form>