<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $p->full_name }} | Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--bg:#f3f5fb;--card:#fff;--ink:#1f2340;--mut:#5f6585;--a:#4f46e5;--b:#06b6d4}
*{box-sizing:border-box}body{margin:0;background:var(--bg);color:var(--ink);font:16px/1.65 Poppins,system-ui,sans-serif}
.hero{background:linear-gradient(135deg,var(--a),var(--b));color:#fff;padding:64px 24px 120px;text-align:center}
.hero img{width:150px;height:150px;border-radius:50%;object-fit:cover;border:5px solid #fff;box-shadow:0 10px 30px #0003;animation:pop .7s both}
.hero h1{margin:18px 0 4px;font-size:clamp(2rem,6vw,3.2rem);line-height:1.1;font-weight:700}
.hero p{margin:0 auto;max-width:620px;opacity:.92;font-size:1.1rem}
.chips{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-top:22px}
.chips a,.chips span{background:#ffffff26;border:1px solid #ffffff55;color:#fff;border-radius:99px;padding:8px 16px;font-size:.9rem;text-decoration:none;backdrop-filter:blur(6px)}
.grid{max-width:1080px;margin:-70px auto 0;padding:0 20px 60px;display:grid;grid-template-columns:repeat(2,1fr);gap:22px}
.card{background:var(--card);border-radius:20px;padding:28px;box-shadow:0 10px 34px #2a2f6a14;animation:up .7s both}
.card.full{grid-column:1/-1}
.card h2{margin:0 0 18px;font-size:1.15rem;display:flex;align-items:center;gap:10px}
.card h2:before{content:"";width:6px;height:22px;border-radius:4px;background:linear-gradient(var(--a),var(--b))}
.entry{padding:12px 0;border-top:1px solid #eceefa}.entry:first-of-type{border-top:0;padding-top:0}
.entry b{display:block}.entry small{color:var(--mut)}.entry p{margin:4px 0 0;color:var(--mut);font-size:.95rem}
.tags{display:flex;flex-wrap:wrap;gap:10px}
.tags span{background:#eef0ff;color:var(--a);padding:7px 16px;border-radius:99px;font-weight:500;font-size:.92rem}
.tags span:nth-child(3n+2){background:#e3f8fc;color:#0891b2}.tags span:nth-child(3n){background:#fdeaf3;color:#be185d}
.projects{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px}
.pcard{border-radius:16px;overflow:hidden;border:1px solid #eceefa;transition:transform .3s,box-shadow .3s;background:#fff}
.pcard:hover{transform:translateY(-6px);box-shadow:0 16px 34px #2a2f6a22}
.pcard img{display:block;width:100%;aspect-ratio:16/10;object-fit:cover}
.pcard .ph{aspect-ratio:16/10;background:linear-gradient(135deg,#dfe3ff,#d7f6fb)}
.pcard div.t{padding:16px 18px}.pcard b{display:block}.pcard p{margin:4px 0 0;color:var(--mut);font-size:.92rem}
.links{display:flex;flex-wrap:wrap;gap:10px}
.links a{background:var(--ink);color:#fff;padding:9px 18px;border-radius:99px;text-decoration:none;font-size:.9rem;transition:background .3s}.links a:hover{background:var(--a)}
footer{text-align:center;color:var(--mut);padding:0 0 40px;font-size:.85rem}
@keyframes up{from{opacity:0;transform:translateY(24px)}}@keyframes pop{from{opacity:0;transform:scale(.8)}}
@media(max-width:760px){.grid{grid-template-columns:1fr;margin-top:-60px}.card{padding:22px}}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}}
</style></head><body>
@if($preview)@include('partials.preview-bar')@endif
<header class="hero">
  @if($p->photo)<img src="{{ $p->photo }}" alt="{{ $p->full_name }}">@endif
  <h1>{{ $p->full_name }}</h1>
  @if($p->headline)<p>{{ $p->headline }}</p>@endif
  <div class="chips"><a href="mailto:{{ $p->email }}">{{ $p->email }}</a>@if($p->phone)<span>{{ $p->phone }}</span>@endif @if($p->address)<span>{{ $p->address }}</span>@endif</div>
</header>
<main class="grid">
@if($p->about)<section class="card full"><h2>About me</h2><p style="margin:0">{!! nl2br(e($p->about)) !!}</p></section>@endif
@if($p->educations->count())<section class="card"><h2>Education</h2>
  @foreach($p->educations as $e)<div class="entry"><b>{{ $e->school }}</b><small>{{ collect([$e->degree, $e->years])->filter()->implode(' · ') }}</small></div>@endforeach</section>@endif
@if($p->experiences->count())<section class="card"><h2>Experience</h2>
  @foreach($p->experiences as $x)<div class="entry"><b>{{ $x->company }}</b><small>{{ collect([$x->role, $x->years])->filter()->implode(' · ') }}</small>@if($x->description)<p>{{ $x->description }}</p>@endif</div>@endforeach</section>@endif
@if($p->skills->count())<section class="card full"><h2>Skills</h2><div class="tags">@foreach($p->skills as $s)<span>{{ $s->name }}</span>@endforeach</div></section>@endif
@if($p->projects->count())<section class="card full"><h2>Projects</h2><div class="projects">
  @foreach($p->projects as $pr)<article class="pcard">@if($pr->image)<img src="{{ $pr->image }}" alt="{{ $pr->title }}">@else<div class="ph"></div>@endif
    <div class="t"><b>{{ $pr->title }}</b>@if($pr->description)<p>{{ $pr->description }}</p>@endif</div></article>@endforeach</div></section>@endif
@if($p->socialLinks->count())<section class="card full"><h2>Find me online</h2><div class="links">@foreach($p->socialLinks as $l)<a href="{{ $l->url }}" target="_blank" rel="noopener">{{ $l->label }}</a>@endforeach</div></section>@endif
</main>
<footer>Made by Group 7</footer>
</body></html>
