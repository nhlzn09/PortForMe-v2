<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $p->full_name }} | Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<style>
:root{--bg:#0e0d14;--ink:#f6f3ea;--mut:#a29fb3;--y:#ffd23f;--p:#ff4d8d;--v:#7c5cff}
*{box-sizing:border-box}html{overflow-x:hidden}
body{margin:0;background:var(--bg);color:var(--ink);font:17px/1.65 'Space Grotesk',system-ui,sans-serif;overflow-x:hidden;position:relative}
.shape{position:fixed;border-radius:50%;filter:blur(70px);opacity:.35;z-index:0;animation:float 14s ease-in-out infinite alternate;pointer-events:none}
.s1{width:420px;height:420px;background:var(--v);top:-120px;right:-100px}.s2{width:340px;height:340px;background:var(--p);bottom:-100px;left:-100px;animation-delay:-6s}
@keyframes float{to{transform:translate(50px,40px) scale(1.15)}}
.wrap{position:relative;z-index:1;max-width:1100px;margin:0 auto;padding:0 24px}
.top{display:grid;grid-template-columns:1.6fr 1fr;gap:40px;align-items:center;padding:90px 0 60px}
h1{font:800 clamp(3rem,10vw,7.5rem)/.92 Syne,sans-serif;text-transform:uppercase;margin:0;letter-spacing:-.03em;word-break:break-word;animation:rise .9s both}
h1 em{font-style:normal;color:transparent;-webkit-text-stroke:2px var(--y)}
.tag{margin:22px 0 0;font-size:1.25rem;color:var(--y);max-width:30em;animation:rise .9s .15s both}
.pic{justify-self:center;width:min(320px,70vw);aspect-ratio:1;border-radius:62% 38% 55% 45%/48% 58% 42% 52%;background:var(--p);padding:8px;transform:rotate(4deg);box-shadow:14px 14px 0 var(--y);animation:rise .9s .1s both,morph 9s ease-in-out infinite alternate}
.pic img{width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block}
.pic.empty{display:grid;place-items:center;font:800 6rem Syne,sans-serif;color:var(--bg)}
@keyframes morph{to{border-radius:40% 60% 45% 55%/58% 42% 58% 42%}}
@keyframes rise{from{opacity:0;transform:translateY(30px)}}
.band{background:var(--y);color:var(--bg);transform:rotate(-2deg);margin:20px -40px 70px;overflow:hidden;white-space:nowrap;font:800 1.5rem Syne,sans-serif;text-transform:uppercase;padding:14px 0}
.track{display:inline-block;animation:marq 30s linear infinite}.track span{margin:0 22px}.track i{font-style:normal;color:var(--p)}
@keyframes marq{to{transform:translateX(-50%)}}
.sec{display:grid;grid-template-columns:160px 1fr;gap:20px 40px;padding:40px 0;border-top:1px solid #ffffff1f}
.sec>h2{margin:0;font:700 .95rem 'Space Grotesk';letter-spacing:.18em;text-transform:uppercase;color:var(--p)}
.sec>h2 b{display:block;font:800 3.2rem/1 Syne,sans-serif;color:var(--y);letter-spacing:0;margin-bottom:6px}
.big{font-size:1.45rem;line-height:1.5;margin:0}
.row{display:grid;grid-template-columns:70px 1fr;gap:6px 20px;padding:16px 0;border-bottom:1px dashed #ffffff26;transition:padding .3s,color .3s}
.row:hover{padding-left:12px;color:var(--y)}.row .n{font:800 1.4rem Syne,sans-serif;color:var(--v)}
.row b{display:block;font-size:1.2rem}.row small{color:var(--mut)}.row p{margin:4px 0 0;color:var(--mut)}
.works{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:36px 28px}
.work{background:#1b1926;border-radius:18px;padding:12px 12px 20px;box-shadow:8px 8px 0 var(--v);transition:transform .35s}
.work:nth-child(odd){transform:rotate(-1.6deg)}.work:nth-child(even){transform:rotate(1.6deg);box-shadow:8px 8px 0 var(--p);margin-top:24px}
.work:hover{transform:rotate(0) scale(1.03)}
.work img{display:block;width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:10px}.work .ph{aspect-ratio:4/3;border-radius:10px;background:linear-gradient(135deg,var(--v),var(--p))}
.work b{display:block;margin:14px 6px 2px;font:700 1.25rem Syne,sans-serif}.work p{margin:0 6px;color:var(--mut);font-size:.95rem}
.mail{display:block;font:800 clamp(1.4rem,5vw,3rem)/1.1 Syne,sans-serif;color:var(--ink);text-decoration:none;word-break:break-all;transition:color .3s}.mail:hover{color:var(--y)}
.pills{display:flex;flex-wrap:wrap;gap:10px;margin-top:20px}
.pills a,.pills span{border:2px solid var(--ink);color:var(--ink);border-radius:99px;padding:8px 20px;text-decoration:none;font-weight:500;transition:.3s}.pills a:hover{background:var(--y);border-color:var(--y);color:var(--bg)}
footer{padding:40px 0 60px;color:var(--mut);font-size:.9rem}
@media(max-width:800px){.top{grid-template-columns:1fr;padding-top:60px}.pic{order:-1}.sec{grid-template-columns:1fr}.sec>h2 b{display:inline;margin-right:10px;font-size:1.6rem}.work:nth-child(even){margin-top:0}.band{margin:10px -24px 50px;font-size:1.1rem}.row{grid-template-columns:44px 1fr}}
@media(prefers-reduced-motion:reduce){*{animation:none!important}}
</style></head><body>
@if($preview)@include('partials.preview-bar')@endif
<i class="shape s1"></i><i class="shape s2"></i>
<div class="wrap">
<header class="top">
  <div>
    @php $parts = preg_split('/\s+/', trim($p->full_name)); $last = count($parts) > 1 ? array_pop($parts) : null; @endphp
    <h1>{{ implode(' ', $parts) }}@if($last) <em>{{ $last }}</em>@endif</h1>
    @if($p->headline)<p class="tag">{{ $p->headline }}</p>@endif
  </div>
  @if($p->photo)<div class="pic"><img src="{{ $p->photo }}" alt="{{ $p->full_name }}"></div>
  @else<div class="pic empty" aria-hidden="true">{{ strtoupper(substr($p->full_name, 0, 1)) }}</div>@endif
</header>
</div>
@if($p->skills->count())
@php $half = max(1, (int) ceil(30 / $p->skills->count())); @endphp
<div class="band" aria-label="Skills"><div class="track">@for($k = 0; $k < $half * 2; $k++)@foreach($p->skills as $s)<span>{{ $s->name }}</span><i>&#10022;</i>@endforeach @endfor</div></div>
@endif
<main class="wrap">
@if($p->about)<section class="sec"><h2><b>01</b>About</h2><p class="big">{!! nl2br(e($p->about)) !!}</p></section>@endif
@if($p->educations->count())<section class="sec"><h2><b>02</b>Education</h2><div>
  @foreach($p->educations as $i => $e)<div class="row"><span class="n">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span><div><b>{{ $e->school }}</b><small>{{ collect([$e->degree, $e->years])->filter()->implode(' · ') }}</small></div></div>@endforeach</div></section>@endif
@if($p->experiences->count())<section class="sec"><h2><b>03</b>Experience</h2><div>
  @foreach($p->experiences as $i => $x)<div class="row"><span class="n">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span><div><b>{{ $x->company }}</b><small>{{ collect([$x->role, $x->years])->filter()->implode(' · ') }}</small>@if($x->description)<p>{{ $x->description }}</p>@endif</div></div>@endforeach</div></section>@endif
@if($p->projects->count())<section class="sec"><h2><b>04</b>Projects</h2><div class="works">
  @foreach($p->projects as $pr)<article class="work">@if($pr->image)<img src="{{ $pr->image }}" alt="{{ $pr->title }}">@else<div class="ph"></div>@endif<b>{{ $pr->title }}</b>@if($pr->description)<p>{{ $pr->description }}</p>@endif</article>@endforeach</div></section>@endif
<section class="sec"><h2><b>05</b>Say hi</h2><div>
  <a class="mail" href="mailto:{{ $p->email }}">{{ $p->email }}</a>
  <div class="pills">@if($p->phone)<span>{{ $p->phone }}</span>@endif @if($p->address)<span>{{ $p->address }}</span>@endif
  @foreach($p->socialLinks as $l)<a href="{{ $l->url }}" target="_blank" rel="noopener">{{ $l->label }}</a>@endforeach</div></div></section>
<footer>Made by Group 7</footer>
</main></body></html>
