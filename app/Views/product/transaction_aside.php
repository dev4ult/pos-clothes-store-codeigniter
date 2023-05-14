<div class="pl-5">
    <button class="aside-transaction-btn relative btn btn-square btn-ghost">
        <img src="./images/basket.png" class="w-7" alt="keranjang">
        <div id="total-product-basket" class="absolute -top-1 -right-2 badge badge-sm badge-error">0</div>
    </button>
</div>
<div id="aside-transaction" class="absolute top-0 bottom-0 left-full p-14 bg-white transition-all border-l-2">
    <button class="aside-transaction-btn relative btn btn-square btn-ghost mb-5">
        <img src="./images/arrow.png" class="w-7 rotate-180" alt="kembali">
    </button>
    <form action="">
        <h3 class="text-xl font-medium">Teruskan Transaksi</h3>
        <div class="flex flex-col gap-5 my-5">
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">ID Member (Opsional)</span>
                </label>
                <input type="number" placeholder="Ketikkan ID Member jika tersedia" class="input input-bordered min-w-[22rem]" />
            </div>
            <div class="overflow-x-auto">
                <h4 class="text-sm font-medium mb-2">Detail Keranjang</h4>
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
                        <!-- <tr>
                            <td colspan="3" class="font-semibold">HARGA TOTAL</td>
                            <td class="font-semibold">300000</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="transaction-btn btn btn-sm btn-primary">Bayar</button>
            <button type="submit" class="transaction-btn btn btn-sm btn-primary btn-outline">Simpan Transaksi</button>
        </div>
    </form>
</div>
<script src="./js/transactionBasket.js"></script>