@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="/css/styles_loginv1.css" />
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif


@section('auth_body')

<div id="logo"> 
    <img src="/img/logo_senado/logo_senado_login.png">
</div> 



<section class="stark-login">
 <form action="{{ $login_url }}" method="post">
        {{ csrf_field() }}
         
            {{-- Email field --}}     
    <div id="fade-box">
      <input type="email" name="email" class="form-control {{ $errors->has
           ('email') ? 'is-invalid' : '' }}" 
             value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
             
             @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
            </div>
             
             {{-- Password field --}}
    <div id="fade-box">
        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.password') }}">
                   
                   @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
     </div>
     <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>

      </form>
            </section>