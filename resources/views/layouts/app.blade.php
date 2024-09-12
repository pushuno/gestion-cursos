<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Capacitación Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- Font Awesome -->
 <script src="https://kit.fontawesome.com/ff1c19d5e6.js" crossorigin="anonymous"></script>
 @yield('cabecera')
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('css/panel/icheck-bootstrap.min.css') }}">
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 <!-- Theme style -->
 <link rel="stylesheet" href="{{ asset('css/panel/style.css') }}">
 <!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!--<p><b>DAS</b>Cecadi</p>-->
    <img src="{{ asset('images/logo.png') }}" style="width:150px" title="DAS CeCaDI"/>
  </div>

  @yield('content')

</div>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{ asset('js/panel/main.js') }}"></script>
<script src="{{ asset('js/panel/scripts.js') }}"></script>

</body>
</html>
