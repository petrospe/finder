<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}"/>

        <!-- Vuetify -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
      <div style="position:absolute;top:50%;left:50%;margin-top:-50px;background:rgb(84, 110, 122);padding:5px;border-radius:10px;width:50%;">
        <img src="{{ asset('images/icons/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" >
      </div>
      <!-- Scripts -->
      <script type="text/javascript">
        let url = window.location;
        if(url.origin+'/' !== url.href){
          window.location = url.origin;
        }
      </script>
    </body>
</html>
