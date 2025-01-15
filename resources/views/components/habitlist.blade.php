<?
if(!isset($type)){ $type = 'info';}
?>
<h3>{{ $title }}</h3>
<ul>
    @foreach ($list as $habit)
        <li>@include('components.habit-item-'.$type, ['habit' => $habit])
        </li>
    @endforeach
</ul>