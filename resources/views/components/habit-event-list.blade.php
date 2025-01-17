<?
?>
<div style="display: flex; flex-direction: column; align-items : flex-start;">
    <h3>{{ $title }}</h3>
    <table>
        <tr>
            <th >Log Date</th>
            <th >Created At</th>
            <th>Note</th>
        </tr>
        @foreach ($events as $event)
            <tr >@include('components.habit-event-item-info', ['event' => $event])
            </tr>
        @endforeach
        </table>
</div>