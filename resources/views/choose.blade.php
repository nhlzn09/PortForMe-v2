@extends('layout')
@section('title', 'Choose a template')
@section('content')
<section class="page wide-page"><h2 class="ptitle">Choose a template</h2>
<p class="sub">Step 2 of 3: these are live previews of your own information. Pick the one you like.</p>
<div class="tpl-grid">
@foreach($templates as $key => [$name, $desc])
  <div class="glass tpl-card {{ $p->template === $key ? 'current' : '' }}">
    <div class="frame"><iframe src="{{ route('portfolio.preview', ['t' => $key, 'embed' => 1]) }}" title="{{ $name }} template preview" loading="lazy" tabindex="-1"></iframe></div>
    <h3>{{ $name }} @if($p->template === $key)<span class="badge">Current</span>@endif</h3>
    <p>{{ $desc }}</p>
    <div class="actions">
      <a class="btn sm ghost" href="{{ route('portfolio.preview', ['t' => $key]) }}">Preview</a>
      <form method="POST" action="{{ route('portfolio.choose') }}">@csrf<input type="hidden" name="template" value="{{ $key }}"><button class="btn sm">Use {{ $name }}</button></form>
    </div>
  </div>
@endforeach
</div>
<p class="center"><a class="link" href="{{ route('portfolio.edit') }}">Back to edit information</a></p>
</section>
@endsection
@push('scripts')
<script>
document.querySelectorAll('.frame').forEach(f => {
  const fit = () => f.style.setProperty('--s', f.clientWidth / 1200);
  fit(); addEventListener('resize', fit);
});
</script>
@endpush
