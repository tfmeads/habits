<?
if(!isset($type)){ $type = 'info';}
?>
<div style="display: flex; flex-direction: column; align-items : center;">
    <h3 style="width: max-content; padding: 20px;">{{ $title }}</h3>
    <ul>
        @foreach ($list as $habit)
            <li style="">@include('components.habit-item-'.$type, ['habit' => $habit])
            </li>
        @endforeach
    </ul>
</div>