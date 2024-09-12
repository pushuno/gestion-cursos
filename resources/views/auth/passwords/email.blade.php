@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reinicio de Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="row">
                            <div class="col-7"></div>
                            <div class="col-5">
                                <button type="submit" class="btn btn-primary btn-block ">
                                    {{ __('Enviar Link') }}
                                </button>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('login') }}" class="btn btn-link">{{ __('Login') }}</a>
                            </div>
                            <!-- /.col -->
                        </div>










                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
