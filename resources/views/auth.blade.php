@extends('layout')
@section('title', $mode === 'login' ? 'Log in' : 'Sign up')
@section('content')
<section class="hero"><form class="glass card-form" method="POST" action="{{ route($mode . '.post') }}">@csrf
<h2>{{ $mode === 'login' ? 'Welcome back' : 'Create your account' }}</h2>
@if($mode === 'login')
  <label>Username or email<input name="login" value="{{ old('login') }}" required autofocus></label>
@else
  <label>Username<input name="username" value="{{ old('username') }}" required autofocus></label>
  <label>Email<input type="email" name="email" value="{{ old('email') }}" required></label>
@endif
<label>Password<input type="password" name="password" required minlength="6"></label>
@if($mode === 'login')<label class="chk"><input type="checkbox" name="remember"> Keep me logged in</label>@endif
@foreach($errors->all() as $e)<p class="err">{{ $e }}</p>@endforeach
<button class="btn">{{ $mode === 'login' ? 'Log in' : 'Create account' }}</button>
<a class="link" href="{{ route($mode === 'login' ? 'register' : 'login') }}">{{ $mode === 'login' ? 'New here? Sign up' : 'Have an account? Log in' }}</a>
</form></section>
@endsection
