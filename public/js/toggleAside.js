const aside = document.getElementById('aside');
const asideBtn = document.getElementsByClassName('aside-btn');

for (let i = 0; i < 2; i++) {
  asideBtn[i].addEventListener('click', (e) => {
    aside.classList.toggle('translate-x-full');
  });
}
