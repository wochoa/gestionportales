@extends('layouts.loginhtml2')

@section('content')
<div class="content-body">
  <div class="auth-wrapper auth-v2">
      <div class="auth-inner row m-0">
          <!-- Brand logo-->
          {{-- <a class="brand-logo" href="javascript:void(0);">
              <img src="dist/img/logo.png" alt="GoreHco" width="200">
              <h2 class="brand-text text-primary ml-1">GoreDigital</h2>
          </a> --}}
          <!-- /Brand logo-->
          <!-- Left Text-->
          <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
              <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="dist/img/logodiseno.png" alt="Login V2" /></div>
          </div>
          <!-- /Left Text-->
          <!-- Login-->
          <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
              <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                  <h2 class="card-title font-weight-bold mb-1 text-white">Ingrese con el usuario de SGD y su clave</h2>
                  <p class="card-text mb-2">Iniciar sesión</p>
                  <form class="form mt-2" method="POST" action="{{ route('login') }}">
                    @csrf
                      <div class="form-group">
                          <label class="form-label text-white" for="login-email">Usuario:</label>
                          <input class="form-control {{ $errors->has('adm_email')|| $errors->has('adm_email') ? 'is-invalid':''}}" id="adm_email" type="text" name="adm_email" placeholder="Usuario..." aria-describedby="login-email" autofocus="" tabindex="1" value="{{ old('adm_email')?:old('adm_email') }}" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>
                          {{-- @error('adm_email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror --}}

                          @if($errors->has('adm_email')|| $errors->has('adm_email'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('adm_email')?: $errors->first('adm_email') }}</strong>
                              </span>
                          @endif

                      </div>
                      <div class="form-group">
                          <div class="d-flex justify-content-between">
                              <label for="login-password" class="text-white">Contrtaseña:</label>
                              {{-- <a href="page-auth-forgot-password-v2.html"><small>Olvidaste tu contraseña?</small></a> --}}
                          </div>
                          <div class="input-group input-group-merge form-password-toggle">
                              <input class="form-control form-control-merge @error('password') is-invalid @enderror" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                              <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                          </div>
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                      <div class="form-group">
                          <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" name="remember" id="remember" type="checkbox" tabindex="3" {{ old('remember') ? 'checked' : '' }}/>
                              <label class="custom-control-label text-white" for="remember-me"> Recordarme</label>
                          </div>
                      </div>
                      <button class="btn btn-info btn-block" tabindex="4" type="submit"> Ingresar</button>
                  </form>
                  {{-- <p class="text-center mt-2"><span>New on our platform?</span><a href="page-auth-register-v2.html"><span>&nbsp;Create an account</span></a></p> --}}
                  <div class="divider my-2">
                      <div class="divider-text">or</div>
                  </div>
                  <div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook" href="javascript:void(0)"><i data-feather="facebook"></i></a><a class="btn btn-twitter white" href="javascript:void(0)"><i data-feather="twitter"></i></a><a class="btn btn-google" href="javascript:void(0)"><i data-feather="mail"></i></a><a class="btn btn-github" href="javascript:void(0)"><i data-feather="github"></i></a></div>
              </div>
          </div>
          <!-- /Login-->
      </div>
  </div>
</div>
@endsection

