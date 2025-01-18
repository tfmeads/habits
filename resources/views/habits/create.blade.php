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
<link rel="stylesheet" href="{{asset('css/habits-edit.css')}}">
<link rel="stylesheet" href="{{asset('css/button.css')}}">

<br>

<form method="POST" action={{$action}}>
    <input type="hidden" name="_method" value={{$method}}>
    @csrf

<strong> 
       <div id="main-wrapper">


            <div>
                <input type="text" name="name" id="name" max=50 placeholder="New Habit" value="{{$habit['name']}}"></input>
                @error('name')
                    <p style="color:red"><i >{{$message}}</i></p>
                @enderror
            </div>
           <div>

            <br>
               
               <input required type="number" min="1" max="99" name="frequency" id="frequency" value="{{$habit['frequency']}}"></input>
               </strong> times a
               <u>
                   <select id="period" name="period">
               
                   @foreach(\App\Enums\Period::cases() as $period)
                   <option value="{{ $period }}" {{ $habit['period'] == $period ? 'selected="selected"' : '' }}>{{$period}}</option>
                   @endforeach
               
                   </select>
               </u>
           </div>
           <br>
           
           <p id="daily_max_section">
               Max
               <input id="daily_max_input" required type="number" min="0" max="99" name="daily_max" value="{{$habit['daily_max']}}"></input> times a day
           </p>
           
               </select>


<div class="btn-container">
    <button class="btn-create" type="submit">{{$submit_label}}</button>
    <button class="btn-delete" form="delete-form" {{ isset($habit) ? '' : 'hidden'}}>Archive Habit</button>
</div>
<div>
    @error('frequency')
    <p style="color:red"><i >{{$message}}</i></p>
    @enderror
    @error('period')
    <p style="color:red"><i >{{$message}}</i></p>
    @enderror
    @error('daily_max')
    <p style="color:red"><i >{{$message}}</i></p>
    @enderror
</div>

<br><br>
</form>

</div>



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
