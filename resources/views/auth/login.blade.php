@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body login-card-body">
            @guest

                <p class="login-box-msg"></p>

                <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input-group mb-3">
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                {{ __('Recordarme') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Ingresar') }}</button>

                    </div>
                    <div class="col-12">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Perdí mi clave') }}
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-link">{{ __('Registrarme') }}</a>
                        @endif
                    </div>
                    <!-- /.col -->
                </div>
                </form>
            @else
                Usted ya está logueado como {{ Auth::user()->name }}
                <div class="list-group">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ __('Logout') }}</h6>
                        </div>
                    </a>
                </div>
            @endguest
        </div>
    </div>




@endsection

<!-- /.login-box -->

