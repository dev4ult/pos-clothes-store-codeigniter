const asideTransaction = document.getElementById('aside-transaction');
const asideTransactionBtn = document.getElementsByClassName('aside-transaction-btn');

for (let i = 0; i < 2; i++) {
  asideTransactionBtn[i].addEventListener('click', (e) => {
    asideTransaction.classList.toggle('-translate-x-full');
  });
}

const addToBasketBtn = document.getElementsByClassName('add-to-basket-btn');
// const minusProductBtn = document.getElementsByClassName('minus-product-btn');

const transactionDetailContainer = document.getElementById('transaction-detail-container');
const detailTransactionEl = (id, name, total, size, price) => {
  const tr = document.createElement('tr');
  const tdName = document.createElement('td');

  tdName.innerHTML = `${name} (${size})`;
  tr.appendChild(tdName);

  const tdSize = document.createElement('td');
  tdSize.innerHTML = total;
  tr.appendChild(tdSize);

  const tdPrice = document.createElement('td');
  tdPrice.innerHTML = `Rp. ${price * total}`;
  tr.appendChild(tdPrice);

  const btnAdd = document.createElement('button');
  btnAdd.setAttribute('type', 'button');
  btnAdd.setAttribute('id', `${id}-${size}-add-action`);
  btnAdd.setAttribute('class', 'add-action-btn btn btn-sm btn-square btn-info');
  btnAdd.innerHTML = '+';

  const btnMinus = document.createElement('button');
  btnMinus.setAttribute('type', 'button');
  btnMinus.setAttribute('id', `${id}-${size}-minus-action`);
  btnMinus.setAttribute('class', 'minus-action-btn btn btn-sm btn-square btn-error');
  btnMinus.innerHTML = '-';

  const tdActions = document.createElement('td');
  tdActions.setAttribute('class', 'flex gap-1');
  tdActions.innerHTML = '';
  tdActions.appendChild(btnAdd);
  tdActions.appendChild(btnMinus);

  tr.appendChild(tdActions);

  return tr;
};

const basket = [];

for (let i = 0; i < addToBasketBtn.length; i++) {
  addToBasketBtn[i].addEventListener('click', (e) => {
    const id = e.target.getAttribute('id').split('-')[0];
    const name = document.getElementById(`${id}-name`).value;
    const price = document.getElementById(`${id}-price`).value;
    const size = document.querySelector(`input[name="${id}-size"]:checked`);

    if (!size) {
      Swal.fire('Produk', 'Pilih ukuran terlebih dahulu', 'warning');
    } else {
      const found = basket.some((product) => product.id == id && product.size == size.value);
      if (!found) {
        basket.push({
          id,
          name,
          price,
          total: 1,
          size: size ? size.value : size,
        });

        if (basket.length == 1) {
          transactionDetailContainer.innerHTML = '';
        }

        transactionDetailContainer.appendChild(detailTransactionEl(id, name, 1, size.value, price));
        totalProductBasket.innerHTML = `${basket.length}`;
      } else {
        Swal.fire('Keranjang Produk', 'Produk tersebut sudah ada di keranjang', 'error');
      }
    }
  });
}

const totalProductBasket = document.getElementById('total-product-basket');

document.addEventListener('click', (e) => {
  const el = e.target;
  if (el.classList.contains('add-action-btn') || el.classList.contains('minus-action-btn')) {
    const data = el.getAttribute('id').split('-');
    const id = data[0];
    const size = data[1];
    const operation = data[2];

    for (let i = 0; i < basket.length; i++) {
      if (basket[i]['id'] == id && basket[i]['size'] == size) {
        if (operation == 'add') {
          basket[i]['total'] += 1;
        } else {
          basket[i]['total'] -= 1;
          if (basket[i]['total'] == 0) {
            basket.splice(i, 1);
          }
        }
      }
    }

    totalProductBasket.innerHTML = `${basket.length}`;

    transactionDetailContainer.innerHTML = '';
    basket.forEach((product) => {
      const { id, name, total, size, price } = product;
      transactionDetailContainer.appendChild(detailTransactionEl(id, name, total, size, price));
    });

    if (basket.length == 0) {
      const trEmpty = document.createElement('tr');
      const td = document.createElement('td');

      td.setAttribute('colspan', '4');
      td.setAttribute('class', 'text-center');

      td.innerHTML = '- Keranjang Kosong -';

      trEmpty.appendChild(td);
      transactionDetailContainer.appendChild(trEmpty);
    }
  }
});
