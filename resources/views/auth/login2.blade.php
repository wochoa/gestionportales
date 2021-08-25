@extends('plantillas.login')

@section('titulopagina')
	Admin|Ingresar
@endsection

@section('contelogin')
<div class="card">
    <div class="card-body login-card-body">
        
    

@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/main') }}" class="btn btn-sm btn-danger">Regresar</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
        @else
            {{-- <a href="{{ route('login') }}">Login</a> --}}
            <p class="login-box-msg">Regístrese para iniciar su sesión</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
                  <input id="login" type="text" class="form-control {{ $errors->has('adm_email')|| $errors->has('adm_email') ? 'is-invalid':''}}" id="adm_email" type="text" name="adm_email" placeholder="Usuario..." required  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                  @if($errors->has('adm_email')|| $errors->has('adm_email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('adm_email')?: $errors->first('adm_email') }}</strong>
                    </span>
                @endif
                </div>
                <div class="input-group mb-3">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Conttraseña">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                   @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                      <input input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label for="remember">
                        Recordarme
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>                           
                  </div>
                  <!-- /.col -->
                </div>

                 <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                     @if (Route::has('password.request'))
                            <a class="btn btn-block btn-primary" href="{{ route('password.request') }}">
                                {{ __('Olvidé mi contraseña?') }}
                            </a>
                    @endif

                  </div>  

            </form>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif
    </div>
</div>
@endsection


