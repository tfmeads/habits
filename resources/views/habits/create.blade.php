<x-homenav>
<x-slot:heading>
{{ isset($selected_id) ? 'Edit Habit' : 'Track New Habit'}}
</x-slot:heading>

<br>

<form method="POST" action={{ isset($selected_id) ? "/habits/$selected_id" : '/habits'}}>
    <input type="hidden" name="_method" value={{ isset($selected_id) ? 'PATCH' : 'POST'}}>
    @csrf

    <input type="text" name="name" id="name" max=50 placeholder="New Habit" value="{{$habit['name']}}"></input>   
    @error('name')
        <p style="color:red"><i >{{$message}}</i></p>
    @enderror
<strong>    
<input required type="number" min="1" max="99" name="frequency" id="frequency" value="{{$habit['frequency']}}"></input>    
</strong> times a 
<u>
    <select name="period">

    @foreach(\App\Enums\Period::cases() as $period)
    <option value="{{ $period }}" {{ $habit['period'] == $period ? 'selected="selected"' : '' }}>{{$period}}</option>    
    @endforeach

    </select>
</u>
@error('frequency')
<p style="color:red"><i >{{$message}}</i></p>
@enderror
@error('period')
<p style="color:red"><i >{{$message}}</i></p>
@enderror
<br><br>
<button type="submit">{{ isset($selected_id) ? 'Save Habit' : 'Track Habit'}}</button>
</form>

{{-- 
<br><br>

@if($errors->any())
<ul>
    @foreach($errors->all() as $error)
        <li style="color:red">{{$error}}</li>
    @endforeach
</ul>
@endif --}}

</x-homenav>
