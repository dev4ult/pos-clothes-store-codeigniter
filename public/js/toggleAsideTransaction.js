const asideTransaction = document.getElementById('aside-transaction');
const asideTransactionBtn = document.getElementsByClassName('aside-transaction-btn');

for (let i = 0; i < 2; i++) {
  asideTransactionBtn[i].addEventListener('click', (e) => {
    asideTransaction.classList.toggle('-translate-x-full');
  });
}
