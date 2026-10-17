<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $p->full_name }} | Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Source+Serif+4:wght@600&display=swap" rel="stylesheet">
<style>
:root{--ink:#1d1d1f;--mut:#6b6b73;--line:#e5e5e8;--acc:#2f5d8a}
*{box-sizing:border-box}body{margin:0;background:#fff;color:var(--ink);font:17px/1.7 Inter,system-ui,sans-serif}
.wrap{max-width:760px;margin:0 auto;padding:72px 24px 80px}
header{display:flex;gap:28px;align-items:center;padding-bottom:36px;border-bottom:1px solid var(--line)}
header img{width:132px;height:132px;border-radius:50%;object-fit:cover;flex:none}
h1{font:600 2.4rem/1.15 'Source Serif 4',Georgia,serif;margin:0}
.headline{color:var(--mut);margin:6px 0 0;font-size:1.1rem}
.contact{margin-top:14px;display:flex;flex-wrap:wrap;gap:6px 22px;font-size:.92rem;color:var(--mut)}
a{color:var(--acc)}
section{padding:34px 0;border-bottom:1px solid var(--line)}
h2{font:600 .78rem/1 Inter,sans-serif;letter-spacing:.16em;text-transform:uppercase;color:var(--mut);margin:0 0 20px}
.item{margin-bottom:18px}.item b{display:block}.item small{color:var(--mut)}.item p{margin:4px 0 0}
.skills{margin:0;padding:0;list-style:none;display:flex;flex-wrap:wrap;gap:8px 24px}
.skills li:not(:last-child):after{content:"\00b7";margin-left:24px;color:var(--mut)}
.proj{display:grid;grid-template-columns:210px 1fr;gap:22px;margin-bottom:26px}
.proj img{width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:6px}
.proj p{margin:4px 0 0;color:var(--mut)}
.links{display:flex;flex-wrap:wrap;gap:8px 22px}
footer{padding-top:28px;font-size:.85rem;color:var(--mut)}
@media(max-width:600px){.wrap{padding-top:40px}header{flex-direction:column;text-align:center}.contact{justify-content:center}.proj{grid-template-columns:1fr}.skills li:after{display:none}}
</style></head><body>
@if($preview)@include('partials.preview-bar')@endif
<main class="wrap">
<header>
  @if($p->photo)<img src="{{ $p->photo }}" alt="{{ $p->full_name }}">@endif
  <div><h1>{{ $p->full_name }}</h1>
    @if($p->headline)<p class="headline">{{ $p->headline }}</p>@endif
    <div class="contact">
      <a href="mailto:{{ $p->email }}">{{ $p->email }}</a>
      @if($p->phone)<span>{{ $p->phone }}</span>@endif
      @if($p->address)<span>{{ $p->address }}</span>@endif
    </div></div>
</header>
@if($p->about)<section><h2>About</h2><p style="margin:0">{!! nl2br(e($p->about)) !!}</p></section>@endif
@if($p->educations->count())<section><h2>Education</h2>
  @foreach($p->educations as $e)<div class="item"><b>{{ $e->school }}</b><small>{{ collect([$e->degree, $e->years])->filter()->implode(' · ') }}</small></div>@endforeach</section>@endif
@if($p->experiences->count())<section><h2>Experience</h2>
  @foreach($p->experiences as $x)<div class="item"><b>{{ $x->company }}</b><small>{{ collect([$x->role, $x->years])->filter()->implode(' · ') }}</small>@if($x->description)<p>{{ $x->description }}</p>@endif</div>@endforeach</section>@endif
@if($p->skills->count())<section><h2>Skills</h2><ul class="skills">@foreach($p->skills as $s)<li>{{ $s->name }}</li>@endforeach</ul></section>@endif
@if($p->projects->count())<section><h2>Projects</h2>
  @foreach($p->projects as $pr)<div class="proj">@if($pr->image)<img src="{{ $pr->image }}" alt="{{ $pr->title }}">@else<div></div>@endif
    <div><b>{{ $pr->title }}</b>@if($pr->description)<p>{{ $pr->description }}</p>@endif</div></div>@endforeach</section>@endif
@if($p->socialLinks->count())<section><h2>Links</h2><div class="links">@foreach($p->socialLinks as $l)<a href="{{ $l->url }}" target="_blank" rel="noopener">{{ $l->label }}</a>@endforeach</div></section>@endif
<footer>Made by Group 7</footer>
</main></body></html>
