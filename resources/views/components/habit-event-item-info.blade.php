<?
$created_date = Whitecube\LaravelTimezones\Facades\Timezone::date($event->created_at);
?>
<td><strong>{{$event->logged_at}}</strong></td> <td>{{$created_date}}</td> <td>{{$event->note}}</td>