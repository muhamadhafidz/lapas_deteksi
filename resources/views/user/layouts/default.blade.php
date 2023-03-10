<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Yayasan Yatim Al-Ihsan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="">
    <!--     Fonts and icons     -->
    <!-- CSS Files -->
    @stack('before-style')
    @include('user.includes.style')
    @stack('after-style')

</head>

<body>
    
  @include('user.includes.navbar')

  <!-- Content Wrapper. Contains page content -->
  <main>
    
    @yield('content')
  </main>

</body>
@stack('before-script')
@include('user.includes.script')
@stack('after-script')
@include('sweetalert::alert')

</html>
