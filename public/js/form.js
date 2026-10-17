document.querySelectorAll('[data-add]').forEach(btn => btn.addEventListener('click', () => {
  const g = btn.dataset.add;
  const html = document.getElementById('tpl-' + g).innerHTML.replaceAll('__I__', Date.now() + Math.floor(Math.random() * 1000));
  document.getElementById('rows-' + g).insertAdjacentHTML('beforeend', html);
}));
document.addEventListener('click', e => {
  const b = e.target.closest('.rm');
  if (b) b.closest('.row-item').remove();
});
document.addEventListener('change', e => {
  const input = e.target;
  if (!input.matches('input[type=file]') || !input.files[0]) return;
  const img = input.dataset.previewId ? document.getElementById(input.dataset.previewId)
    : input.closest('.row-item')?.querySelector('.thumb');
  if (!img) return;
  const reader = new FileReader();
  reader.onload = () => { img.src = reader.result; img.hidden = false; };
  reader.readAsDataURL(input.files[0]);
});
