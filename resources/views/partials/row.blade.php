{{-- One repeatable row. $g = group, $i = index (or __I__ for the JS template), $row = values, $p = portfolio --}}
@if($g === 'educations')
<div class="row-item">
  <input name="educations[{{ $i }}][school]" placeholder="School / University" aria-label="School" maxlength="120" value="{{ $row['school'] ?? '' }}">
  <input name="educations[{{ $i }}][degree]" placeholder="Degree / Course" aria-label="Degree" maxlength="120" value="{{ $row['degree'] ?? '' }}">
  <input name="educations[{{ $i }}][years]" placeholder="Years (e.g. 2022 - 2026)" aria-label="Years" maxlength="40" value="{{ $row['years'] ?? '' }}">
  <button type="button" class="btn sm ghost rm">Remove</button>
</div>
@elseif($g === 'experiences')
<div class="row-item">
  <input name="experiences[{{ $i }}][company]" placeholder="Company / Organization" aria-label="Company" maxlength="120" value="{{ $row['company'] ?? '' }}">
  <input name="experiences[{{ $i }}][role]" placeholder="Role / Position" aria-label="Role" maxlength="120" value="{{ $row['role'] ?? '' }}">
  <input name="experiences[{{ $i }}][years]" placeholder="Years (e.g. 2024 - Present)" aria-label="Years" maxlength="40" value="{{ $row['years'] ?? '' }}">
  <button type="button" class="btn sm ghost rm">Remove</button>
  <textarea class="full" name="experiences[{{ $i }}][description]" rows="2" placeholder="What did you do there?" aria-label="Description" maxlength="600">{{ $row['description'] ?? '' }}</textarea>
</div>
@elseif($g === 'projects')
@php $cur = isset($row['id']) ? $p->projects->firstWhere('id', (int) $row['id']) : null; @endphp
<div class="row-item">
  <input name="projects[{{ $i }}][title]" placeholder="Project title" aria-label="Project title" maxlength="100" value="{{ $row['title'] ?? '' }}">
  <input type="hidden" name="projects[{{ $i }}][id]" value="{{ $row['id'] ?? '' }}">
  <label class="file">Project picture<input type="file" name="projects[{{ $i }}][photo]" accept="image/*" data-preview></label>
  <button type="button" class="btn sm ghost rm">Remove</button>
  <textarea class="full" name="projects[{{ $i }}][description]" rows="2" placeholder="What is this project about?" aria-label="Project description" maxlength="600">{{ $row['description'] ?? '' }}</textarea>
  <img class="thumb" alt="" @if($cur && $cur->image) src="{{ $cur->image }}" @else hidden @endif>
</div>
@elseif($g === 'links')
<div class="row-item">
  <input name="links[{{ $i }}][label]" placeholder="Label (Facebook, GitHub, Website...)" aria-label="Link label" maxlength="40" value="{{ $row['label'] ?? '' }}">
  <input name="links[{{ $i }}][url]" type="url" placeholder="https://..." aria-label="Link address" maxlength="255" value="{{ $row['url'] ?? '' }}">
  <button type="button" class="btn sm ghost rm">Remove</button>
</div>
@endif
