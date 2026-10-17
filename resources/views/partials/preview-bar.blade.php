<style>
html{scroll-padding-top:64px}body{padding-top:56px!important}
.pfm-bar{position:fixed;z-index:9999;top:0;left:0;right:0;height:56px;display:flex;align-items:center;gap:10px;padding:0 14px;background:#14121f;color:#fff;font:500 14px/1 Inter,system-ui,sans-serif;box-shadow:0 2px 16px #0006;overflow-x:auto;white-space:nowrap}
.pfm-bar *{box-sizing:border-box}.pfm-bar span{opacity:.75}.pfm-bar b{font-weight:600}.pfm-bar .sp{flex:1}
.pfm-bar a,.pfm-bar button{display:inline-block;font:600 13px/1 Inter,system-ui,sans-serif;text-decoration:none;color:#fff;background:#ffffff1f;border:1px solid #ffffff33;border-radius:99px;padding:9px 14px;cursor:pointer}
.pfm-bar button.go{background:#fff;color:#14121f;border-color:#fff}.pfm-bar form{margin:0}
</style>
<div class="pfm-bar" role="navigation" aria-label="Preview toolbar">
  <span>Preview:</span> <b>{{ ucfirst($t) }} template</b>
  @if($t !== $saved)
    <form method="POST" action="{{ route('portfolio.choose') }}">@csrf<input type="hidden" name="template" value="{{ $t }}"><button class="go">Use this template</button></form>
  @else <span>(your current template)</span> @endif
  <i class="sp"></i>
  <a href="{{ route('portfolio.template') }}">Change template</a>
  <a href="{{ route('portfolio.edit') }}">Edit info</a>
  <a href="{{ route('dashboard') }}">Manage</a>
  <a href="{{ route('portfolio.show', auth()->user()->username) }}" target="_blank" rel="noopener">Open public page</a>
</div>
