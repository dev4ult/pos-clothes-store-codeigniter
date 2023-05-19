const asideTransaction = document.getElementById('aside-transaction');
const asideTransactionBtn = document.getElementsByClassName('aside-transaction-btn');

for (let i = 0; i < 2; i++) {
  asideTransactionBtn[i].addEventListener('click', (e) => {
    asideTransaction.classList.toggle('-translate-x-full');
  });
}

const addToBasketBtn = document.getElementsByClassName('add-to-basket-btn');
const totalProductSaved = document.getElementById('total-product-saved');

const finishTransactionBtn = document.getElementById('finish-transaction-btn');
const saveTransactionBtn = document.getElementById('save-transaction-btn');

const transactionDetailContainer = document.getElementById('transaction-detail-container');
const detailTransactionEl = (index, productId, stockId, stockAvailable, name, total, size, price) => {
  const tr = document.createElement('tr');
  const tdName = document.createElement('td');
  const inputStockId = document.createElement('input');
  const inputMaxStock = document.createElement('input');
  const inputStockNeededToBuy = document.createElement('input');

  tdName.innerHTML = `${name} (${size})`;
  tr.appendChild(tdName);

  // provide stock id for where condition
  inputStockId.setAttribute('name', `${index}-stock-id`);
  inputStockId.classList.add('hidden');
  inputStockId.value = stockId;
  tr.appendChild(inputStockId);

  // provide how much stock that customer want to buy
  inputStockNeededToBuy.setAttribute('name', `${index}-stock-needed-to-buy`);
  inputStockNeededToBuy.classList.add('hidden');
  inputStockNeededToBuy.value = total;
  tr.appendChild(inputStockNeededToBuy);

  // provide how max stock available in the table stock to
  // determine the query command
  // (it is just update or delete if the stock is empty after transaction)
  inputMaxStock.setAttribute('name', `${index}-max-stock`);
  inputMaxStock.classList.add('hidden');
  inputMaxStock.value = stockAvailable;
  tr.appendChild(inputMaxStock);

  const tdSize = document.createElement('td');
  tdSize.innerHTML = total;
  tr.appendChild(tdSize);

  const tdPrice = document.createElement('td');
  tdPrice.innerHTML = `Rp. ${price * total}`;
  tr.appendChild(tdPrice);

  const btnAdd = document.createElement('button');
  btnAdd.setAttribute('type', 'button');
  btnAdd.setAttribute('id', `${productId}-${size}-add-action`);
  btnAdd.setAttribute('class', 'add-action-btn btn btn-sm btn-square btn-info');
  btnAdd.innerHTML = '+';

  const btnMinus = document.createElement('button');
  btnMinus.setAttribute('type', 'button');
  btnMinus.setAttribute('id', `${productId}-${size}-minus-action`);
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
    const productId = e.target.getAttribute('id').split('-')[0];
    const name = document.getElementById(`${productId}-name`).value;
    const price = document.getElementById(`${productId}-price`).value;
    const size = document.querySelector(`input[name="${productId}-size"]:checked`);

    if (!size) {
      Swal.fire('Produk', 'Pilih ukuran terlebih dahulu', 'warning');
    } else {
      const found = basket.some((product) => product.product_id == productId && product.size == size.value);
      if (!found) {
        const stockId = size.getAttribute('id');
        const stockAvailable = document.getElementById(`${stockId}-stock-available`).value;

        basket.push({
          product_id: productId,
          stock_id: stockId,
          stock_available: stockAvailable,
          name,
          price,
          total: 1,
          size: size ? size.value : size,
        });

        if (basket.length == 1) {
          transactionDetailContainer.innerHTML = '';
          totalProductBasket.classList.remove('badge-accent');
          totalProductBasket.classList.add('badge-error');

          finishTransactionBtn.classList.remove('hidden');
          saveTransactionBtn.classList.remove('hidden');
        }

        totalProductSaved.value = basket.length;

        transactionDetailContainer.appendChild(detailTransactionEl(basket.length, productId, stockId, stockAvailable, name, 1, size.value, price));
        totalProductBasket.innerHTML = `${basket.length}`;
        Swal.fire('Keranjang Produk', 'Produk berhasil ditambahkan', 'success');
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
    const productId = data[0];
    const size = data[1];
    const operation = data[2];

    for (let i = 0; i < basket.length; i++) {
      if (basket[i]['product_id'] == productId && basket[i]['size'] == size) {
        if (operation == 'add') {
          if (basket[i]['stock_available'] > basket[i]['total']) {
            basket[i]['total'] += 1;
          } else {
            Swal.fire('Keranjang Produk', 'Produk tersebut sudah mencapai batas stock', 'error');
          }
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
    for (let i = 1; i <= basket.length; i++) {
      const { product_id, stock_id, stock_available, name, total, size, price } = basket[i - 1];

      transactionDetailContainer.appendChild(detailTransactionEl(i, product_id, stock_id, stock_available, name, total, size, price));
    }

    if (basket.length == 0) {
      const trEmpty = document.createElement('tr');
      const td = document.createElement('td');

      td.setAttribute('colspan', '4');
      td.setAttribute('class', 'text-center');

      td.innerHTML = '- Keranjang Kosong -';

      trEmpty.appendChild(td);
      transactionDetailContainer.appendChild(trEmpty);

      totalProductBasket.classList.add('badge-accent');
      totalProductBasket.classList.remove('badge-error');

      finishTransactionBtn.classList.add('hidden');
      saveTransactionBtn.classList.add('hidden');
    }
  }
});
