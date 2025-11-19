<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rocket Jobs</title>
  @vite(['resources/js/app.js'])


</head>
<body>
  <div>
    
  <nav>

    <div>
<a href="">
  <img src="{{ Vite::asset('resources/images/logo.svg')}}" alt="logo">
</a>
    </div>

    <div>
      
<a href=""> Jobs link</a>

<a href=""> Careers link </a>

<a href=""> Slaries link</a>

    </div>

    <div>
    <a href=""> Post a Job</a>
    </div>


  </nav>
  
  <main>
    {{ $slot }}
  </main>
  </div>

</body>
</html>