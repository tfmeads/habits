<?php
$created_date = Whitecube\LaravelTimezones\Facades\Timezone::date($event->created_at);
?>
<td ><u><strong>{{$event->logged_at->format('m/d/Y')}}</strong></u></td> <td >{{$created_date}}</td> <td>{{$event->note}}</td>