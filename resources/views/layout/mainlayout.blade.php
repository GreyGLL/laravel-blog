<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
  </head>

  <body style="background-color: #edeff0;">

 @include('layout.partials.nav')


 @yield('content')

 @include('layout.partials.footer')

 @include('layout.partials.footer-scripts')


  </body>
</html>