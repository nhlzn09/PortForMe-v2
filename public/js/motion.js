const h = document.getElementById('hero');
if (h) h.innerHTML = h.textContent.trim().split(' ').map((w, i) => `<span style="animation-delay:${i * .12}s">${w}</span>`).join('');
addEventListener('pointermove', e => {
  const g = document.getElementById('glow');
  if (g) g.style.transform = `translate(${e.clientX}px,${e.clientY}px)`;
});
