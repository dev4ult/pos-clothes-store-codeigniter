document.addEventListener('click', (e) => {
  if (e.target.getAttribute('id') == 'close-flash') {
    const flash = document.getElementById('flash');

    flash.classList.add('hidden');
  }
});
