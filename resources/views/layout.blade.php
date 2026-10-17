<!doctype html><html lang="en"><head><meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1"><title>@yield('title', 'PortForMe')</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}"></head><body>
<div class="blobs"><i></i><i></i><i></i></div><div class="glow" id="glow"></div>
<header class="nav glass"><a class="logo" href="{{ route('home') }}">PortForMe</a><nav>
@auth
  <a class="btn sm ghost" href="{{ route('dashboard') }}">Manage</a>
  <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn sm">Log out</button></form>
@else
  <a class="btn sm ghost" href="{{ route('login') }}">Log in</a>
  <a class="btn sm" href="{{ route('register') }}">Sign up</a>
@endauth
</nav></header>
@if(session('status'))<div class="flash" role="status">{{ session('status') }}</div>@endif
@yield('content')
<footer class="site-foot">Made by Group 7</footer>
<script src="{{ asset('js/motion.js') }}"></script>@stack('scripts')
</body></html>
