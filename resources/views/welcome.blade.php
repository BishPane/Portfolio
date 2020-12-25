<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="/css/all.css"></link>    

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
      
        <!-- Styles -->
        <script>
    window.AuthCheck = "{{ Auth::check() ? 1 : 0}}"
</script>
    </head>
    <body>
        <div id="app">
        
            <mainapp></mainapp>
           
        </div>
        
 


    </body>
   
    <script src= "{{ mix('/js/app.js')}}"></script>
</html>
