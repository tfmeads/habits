<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Habits</title>

</head>
             
<body>


    <h1 style="text-align: center">
    {{ $heading }}
    </h1>

    <nav style="border-style: solid; display:flex; justify-content: space-around">
    <x-navlink href="/habits">Habits</x-navlink>
    <x-navlink href="/">Home</x-navlink>
    <x-navlink href="/about">About</x-navlink>
    </nav>

    <br><br>

   {{ $slot }} 
</body>
</html>
