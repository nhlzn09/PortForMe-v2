@extends('layout')
@section('title', 'Manage Portfolio')
@section('content')
<section class="page"><h2 class="ptitle">Manage Portfolio</h2>
@if(!$p)
  <div class="glass box center"><h3>You have no portfolio yet</h3><p class="sub">Create one in a few minutes.</p>
  <a class="btn" href="{{ route('portfolio.create') }}">Create Portfolio</a></div>
@else
  <div class="glass box manage">
    <div class="who">
      @if($p->photo)<img class="avatar" src="{{ $p->photo }}" alt="Profile picture">@else<div class="avatar ph">{{ strtoupper(substr($p->full_name, 0, 1)) }}</div>@endif
      <div><h3>{{ $p->full_name }}</h3><p class="sub left">{{ $p->headline ?: $p->email }}</p></div>
    </div>
    <ul class="stats">
      <li><b>{{ $p->educations->count() }}</b> education</li><li><b>{{ $p->skills->count() }}</b> skills</li>
      <li><b>{{ $p->projects->count() }}</b> projects</li><li><b>{{ $p->experiences->count() }}</b> experience</li>
      <li><b>{{ $p->socialLinks->count() }}</b> links</li>
    </ul>
    <p class="meta">Template: <b>{{ $templates[$p->template][0] ?? 'Simple' }}</b> &middot; Last saved {{ $p->updated_at->diffForHumans() }}</p>
    <p class="meta">Public link: <a href="{{ route('portfolio.show', auth()->user()->username) }}" target="_blank" rel="noopener">{{ route('portfolio.show', auth()->user()->username) }}</a></p>
    <div class="actions">
      <a class="btn" href="{{ route('portfolio.preview') }}">View portfolio</a>
      <a class="btn ghost" href="{{ route('portfolio.edit') }}">Edit information</a>
      <a class="btn ghost" href="{{ route('portfolio.template') }}">Change template</a>
      <form method="POST" action="{{ route('portfolio.destroy') }}" onsubmit="return confirm('Delete your portfolio? This removes it from the database and cannot be undone.')">@csrf @method('DELETE')
        <button class="btn danger">Delete</button></form>
    </div>
  </div>
@endif
</section>
@endsection
