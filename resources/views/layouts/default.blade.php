<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
   @include('includes.head')
</head>
<body>

   <header id="header" >
       @include('includes.header')
       @include('includes.alerts')
   </header>
           @yield('content')
           
 <footer class="footer-area section-gap">
       @include('includes.footer')
   </footer>
  @include('includes.footer-scripts')

</body>
</html>