<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cursos > Panel | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/ff1c19d5e6.js" crossorigin="anonymous"></script>

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/panel/style.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- datepiker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />

  <!--<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>-->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  @yield('cabecera')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    @section('navbar-left')

        <!--<ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href=" {{ route('panel.index') }} " class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
        </ul>

        <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" id="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
            </div>
        </div>
        </form>-->
    @show


    @section('navbar-right')
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

                <form action="{{ route('logout') }}" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="dropdown-item">Cerrar Sesion</button>
                </form>
            </a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
            </a>
        </li>-->
        </ul>
    @show
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="." class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="CeCaDI" style="opacity: .8;width:100%">
      <!--<span class="brand-text font-weight-light">Cursos</span>-->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--<img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ ucwords(strtolower(Auth::user()->name.' '.Auth::user()->lastname)) }}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
                <a href=" {{ route('panel.index') }} " class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Home</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('calendarios.index') }}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                    Calendario
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('inscripciones.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-university"></i>
                    <p>
                    Inscripciones
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('presentes.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-child"></i>
                    <p>
                    Presentismo
                    </p>
                </a>
            </li>
            @yield('menu')
                <li class="nav-item has-treeview menu-open"> <!--menu-open-->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Configuración
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview" >
                    <li class="nav-item">
                        <a href="{{ route('capacitadores.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Capacitadores</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cursantes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Cursantes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cursos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Cursos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('catedras.vigentes') }}" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Cátedras</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('feriados.index') }}" class="nav-link">
                        <i class="nav-icon far fa-calendar-times"></i>
                        <p>Feriados</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('conocimientos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-hammer"></i>
                        <p>Conocimientos Previos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ejes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Ejes</p>
                        </a>
                    </li>
                    </ul>
                </li>
            @show
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('seccion')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('panel.index') }} ">Home</a></li>
              <li class="breadcrumb-item active">@yield('seccion')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    Desarrollo <strong>Lucas Febbroni</strong>.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!--
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
--><script src="{{ asset('js/panel/main.js') }}"></script>
<script src="{{ asset('js/panel/scripts.js') }}"></script>
@yield('scripts')
</body>
</html>
