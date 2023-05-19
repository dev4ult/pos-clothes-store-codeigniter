<div class="pl-5">
    <button class="aside-transaction-btn relative btn btn-square btn-ghost">
        <img src="./images/basket.png" class="w-7" alt="keranjang">
        <div id="total-product-basket" class="absolute -top-1 -right-2 badge badge-sm badge-accent">0</div>
    </button>
</div>
<div id="aside-transaction" class="fixed top-0 bottom-0 left-full p-14 bg-white transition-all border-l-2">
    <button class="aside-transaction-btn relative btn btn-square btn-ghost mb-5">
        <img src="./images/arrow.png" class="w-7 rotate-180" alt="kembali">
    </button>
    <form method="post">
        <h3 class="text-xl font-medium">Teruskan Transaksi</h3>
        <div class="flex flex-col gap-5 my-5">
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">ID Member (Opsional)</span>
                </label>
                <input type="text" name="member-id" placeholder="Ketikkan ID Member jika tersedia" class="input input-bordered min-w-[22rem]" />
            </div>
            <div class="overflow-x-auto">
                <h4 class="text-sm font-medium mb-2">Detail Keranjang</h4>
                <input type="number" id="total-product-saved" name="total-product-saved" class="hidden">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Baju</th>
                            <th>Jumlah</th>
                            <th>Estimasi Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="transaction-detail-container">
                        <tr>
                            <td colspan="4" class="text-center">- Keranjang Kosong -</td>
                        </tr>
                        <tr id="transaction-total" class="hidden">
                            <td colspan="3" class="font-semibold">HARGA TOTAL</td>
                            <td class="font-semibold">300000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex gap-2">
            <button type="submit" id="finish-transaction-btn" formaction="/transaksi/bayar_transaksi" class="hidden transaction-btn btn btn-sm btn-primary">Bayar</button>
            <button type="submit" id="save-transaction-btn" formaction="/transaksi/save_transaksi" class="hidden transaction-btn btn btn-sm btn-primary btn-outline">Simpan
                Transaksi</button>
        </div>
    </form>
</div>
<script src="<?= base_url('./js/transactionBasket.js') ?>"></script>