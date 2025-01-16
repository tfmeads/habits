<?
$id =  $habit['id'] == 0 ? '' : $habit['id'];
$action = "/habits/$id";
$method = $id ? 'PATCH' : 'POST';
$submit_label = $id ? 'Save Habit' : 'Track Habit';
?>
<x-homenav>
<x-slot:heading>
{{ $id ? 'Edit Habit' : 'Track New Habit'}}
</x-slot:heading>

<br>

<form method="POST" action={{$action}}>
    <input type="hidden" name="_method" value={{$method}}>
    @csrf

    <input type="text" name="name" id="name" max=50 placeholder="New Habit" value="{{$habit['name']}}"></input>   
    @error('name')
        <p style="color:red"><i >{{$message}}</i></p>
    @enderror
<strong>    
<input required type="number" min="1" name="frequency" id="frequency" value="{{$habit['frequency']}}"></input>    
</strong> times a 
<u>
    <select id="period" name="period">

    @foreach(\App\Enums\Period::cases() as $period)
    <option value="{{ $period }}" {{ $habit['period'] == $period ? 'selected="selected"' : '' }}>{{$period}}</option>    
    @endforeach

    </select>
</u>
<br>

<p id="daily_max_section">
    Max
    <input id="daily_max_input" required type="number" min="0" name="daily_max" value="{{$habit['daily_max']}}"></input> times a day
</p>

    </select>
@error('frequency')
<p style="color:red"><i >{{$message}}</i></p>
@enderror
@error('period')
<p style="color:red"><i >{{$message}}</i></p>
@enderror
@error('daily_max')
<p style="color:red"><i >{{$message}}</i></p>
@enderror

<br><br>
<button type="submit">{{$submit_label}}</button>
<button form="delete-form" {{ isset($habit) ? '' : 'hidden'}}>Archive Habit</button>
</form>


<form id="delete-form" class="hidden" method="POST" action={{"/habits/$id"}}>
    @csrf
    @method('DELETE')
</form>

</x-homenav>

<script>
    var period = document.getElementById("period");
    var max = document.getElementById("daily_max_section");
    period.onchange = changeListener;

    hideMaxInput();
    
    function changeListener(){
        value = this.value
        hideMaxInput();
    }

    function hideMaxInput(){
      //hide and reset daily max when period is set to Day
      max.hidden = (period.value == '{{App\Enums\Period::DAY}}');
      if(max.hidden){
        document.getElementById("daily_max_input").value = 0;
      }
    }
  
  </script>
