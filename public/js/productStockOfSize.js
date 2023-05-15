const productStock = document.getElementsByClassName('.product-stock');

const trHead = document.getElementById('tr-head');
const tbodyData = document.getElementById('tbody-data');
const trData = document.getElementsByClassName('tr-data');
const thAction = document.getElementById('th-action');

const editStockBtn = document.getElementById('edit-stock-btn');
const saveStockBtn = document.getElementById('save-stock-btn');
const closeStockBtn = document.getElementById('close-stock-btn');
const tdAction = document.getElementsByClassName('td-action');
const formNewSizeStock = document.getElementById('form-new-size-stock');

editStockBtn.addEventListener('click', (e) => {
  thAction.classList.remove('hidden');
  for (let i = 0; i < tdAction.length; i++) {
    tdAction[i].classList.remove('hidden');
    tdAction[i].classList.add('flex');
  }

  editStockBtn.classList.add('hidden');
  saveStockBtn.classList.remove('hidden');
  closeStockBtn.classList.remove('hidden');
  formNewSizeStock.classList.remove('hidden');
  formNewSizeStock.classList.add('flex');
});

document.addEventListener('click', (e) => {
  const clicked = e.target;
  if (clicked.classList.contains('add-stock-btn') || clicked.classList.contains('minus-stock-btn')) {
    const stockDataBtn = clicked.getAttribute('id').split('-');
    const stockId = stockDataBtn[0];
    const operation = stockDataBtn[1];

    const stockTotalInput = document.getElementById(`${stockId}-stock`);
    let stockTotal = parseInt(stockTotalInput.value);
    const stockTd = document.getElementById(`${stockId}-stock-total`);

    if (operation == 'add') {
      stockTotal += 1;
    } else {
      stockTotal -= 1;
    }

    stockTd.innerHTML = stockTotal;
    stockTotalInput.setAttribute('value', stockTotal);
    console.log(stockTotalInput.value);
  }
});

closeStockBtn.addEventListener('click', (e) => {
  thAction.classList.add('hidden');
  for (let i = 0; i < tdAction.length; i++) {
    tdAction[i].classList.add('hidden');
    tdAction[i].classList.remove('flex');
  }

  editStockBtn.classList.remove('hidden');
  saveStockBtn.classList.add('hidden');
  closeStockBtn.classList.add('hidden');
  formNewSizeStock.classList.add('hidden');
  formNewSizeStock.classList.remove('flex');
});

const productId = document.querySelector('input[name="product-id"]');
const productName = document.querySelector('input[name="product-name"]');
const productCategory = document.querySelector('textarea[name="product-category"]');
const productPrice = document.querySelector('input[name="product-price"]');
const productDesc = document.querySelector('textarea[name="product-desc"]');

const editFormTag = document.getElementById('edit-form-tag');

editFormTag.addEventListener('submit', (e) => {
  e.preventDefault();

  const formattedFormData = new FormData();

  postEditData(formattedFormData);
});

async function postEditData(formattedFormData) {
  await axios({
    method: 'post',
    url: '/produk/save_produk',
    data: formattedFormData,
    headers: { 'Content-Type': 'multipart/form-data' },
  });
}
