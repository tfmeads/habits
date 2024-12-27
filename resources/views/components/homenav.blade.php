<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Habits</title>

</head>
             
<body>


    <h1>
    {{ $heading }}
    </h1>

    <nav>
    <x-navlink href="/">Home</x-navlink>
    <x-navlink href="/habits">Habits</x-navlink>
    <x-navlink href="/about">About</x-navlink>
    </nav>


   {{ $slot }} 
</body>
</html>
