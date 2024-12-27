<h3>{{ $title }}</h3>
<ul>
    @foreach ($list as $habit)
        <li><a href="/habits/{{$habit->id}}"><strong>{{$habit->name}}</strong></a> {{$habit->frequency}} times a {{$habit->period}}</li>
    @endforeach
</ul>