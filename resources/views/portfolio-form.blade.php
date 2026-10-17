@extends('layout')
@section('title', $p->exists ? 'Edit portfolio' : 'Create portfolio')
@section('content')
@php
  $rows = fn ($key, $rel) => old($key, $p->exists ? $p->{$rel}->toArray() : []) ?: [[]];
  $edu = $rows('educations', 'educations'); $exp = $rows('experiences', 'experiences');
  $proj = $rows('projects', 'projects'); $links = $rows('links', 'socialLinks');
  $skills = old('skills', $p->exists ? $p->skills->pluck('name')->implode(', ') : '');
@endphp
<section class="page"><form class="glass card-form wide" method="POST" action="{{ route('portfolio.save') }}" enctype="multipart/form-data">@csrf
<h2>{{ $p->exists ? 'Edit your portfolio' : 'Create your portfolio' }}</h2>
<p class="sub left">Step 1 of 3: enter your information. Fields marked * are required.</p>
@if($errors->any())<div class="errbox">@foreach($errors->all() as $e)<p class="err">{{ $e }}</p>@endforeach</div>@endif

<fieldset><legend>Personal information</legend>
  <div class="photo-row">
    @if($p->photo)<img class="avatar" id="pimg" src="{{ $p->photo }}" alt="Current profile picture">@else<img class="avatar" id="pimg" alt="" hidden>@endif
    <div><label class="file">Profile picture<input type="file" name="photo" accept="image/*" data-preview-id="pimg"></label>
    @if($p->photo)<label class="chk"><input type="checkbox" name="remove_photo" value="1"> Remove current picture</label>@endif</div>
  </div>
  <div class="grid2">
    <label>Full name *<input name="full_name" required maxlength="100" value="{{ old('full_name', $p->full_name) }}"></label>
    <label>Headline<input name="headline" maxlength="140" placeholder="Web developer based in Cebu" value="{{ old('headline', $p->headline) }}"></label>
    <label>Email *<input type="email" name="email" required maxlength="120" value="{{ old('email', $p->email) }}"></label>
    <label>Contact number<input name="phone" maxlength="30" value="{{ old('phone', $p->phone) }}"></label>
  </div>
  <label>Address<input name="address" maxlength="200" value="{{ old('address', $p->address) }}"></label>
  <label>About me<textarea name="about" rows="5" maxlength="3000">{{ old('about', $p->about) }}</textarea></label>
</fieldset>

<fieldset><legend>Educational background</legend>
  <div id="rows-educations">@foreach($edu as $i => $row)@include('partials.row', ['g' => 'educations', 'i' => $i, 'row' => $row])@endforeach</div>
  <button type="button" class="btn sm ghost" data-add="educations">+ Add education</button>
</fieldset>

<fieldset><legend>Skills</legend>
  <label>Separate skills with commas<input name="skills" maxlength="900" placeholder="HTML, CSS, Laravel, Photoshop" value="{{ $skills }}"></label>
</fieldset>

<fieldset><legend>Projects</legend>
  <div id="rows-projects">@foreach($proj as $i => $row)@include('partials.row', ['g' => 'projects', 'i' => $i, 'row' => $row])@endforeach</div>
  <button type="button" class="btn sm ghost" data-add="projects">+ Add project</button>
</fieldset>

<fieldset><legend>Work experience</legend>
  <div id="rows-experiences">@foreach($exp as $i => $row)@include('partials.row', ['g' => 'experiences', 'i' => $i, 'row' => $row])@endforeach</div>
  <button type="button" class="btn sm ghost" data-add="experiences">+ Add experience</button>
</fieldset>

<fieldset><legend>Social media / website links</legend>
  <div id="rows-links">@foreach($links as $i => $row)@include('partials.row', ['g' => 'links', 'i' => $i, 'row' => $row])@endforeach</div>
  <button type="button" class="btn sm ghost" data-add="links">+ Add link</button>
</fieldset>

<div class="actions"><button class="btn">Save and choose a template</button>
<a class="btn ghost" href="{{ $p->exists ? route('dashboard') : route('home') }}">Cancel</a></div>
</form></section>
@foreach(['educations', 'experiences', 'projects', 'links'] as $g)
<template id="tpl-{{ $g }}">@include('partials.row', ['g' => $g, 'i' => '__I__', 'row' => []])</template>
@endforeach
@endsection
@push('scripts')<script src="{{ asset('js/form.js') }}"></script>@endpush
