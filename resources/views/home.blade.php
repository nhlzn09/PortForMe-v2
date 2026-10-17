@extends('layout')
@section('content')
<section class="hero"><p class="eyebrow">PortForMe</p>
<h1 id="hero">Your work deserves a page that moves.</h1>
<p class="sub">Create an online portfolio in minutes. Enter your information, pick one of three templates, and share your own page.</p>
<a class="btn" href="{{ route('portfolio.create') }}">Create Portfolio</a></section>
<section class="steps">
  <div class="glass"><b>1</b><h3>Enter information</h3><p>Your details, education, skills, projects and experience.</p></div>
  <div class="glass"><b>2</b><h3>Save online</h3><p>Everything is stored in an online database.</p></div>
  <div class="glass"><b>3</b><h3>Pick a template</h3><p>Simple, Modern or Creative.</p></div>
  <div class="glass"><b>4</b><h3>Preview</h3><p>See your generated portfolio and share its link.</p></div>
  <div class="glass"><b>5</b><h3>Edit or delete</h3><p>Change anything later, or remove it.</p></div>
</section>
@endsection
