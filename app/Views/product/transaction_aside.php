<div class="pl-5">
    <button class="aside-transaction-btn relative btn btn-square btn-ghost">
        <img src="<?= base_url('./images/basket.png') ?>" class="w-7" alt="keranjang">
        <div id="total-product-basket" class="absolute -top-1 -right-2 badge badge-sm badge-accent">0</div>
    </button>
</div>
<?php foreach ($transaction_details as $detail) : ?>
    <input type="number" id="<?= $detail->id_stok ?>-max-stock-db" value="<?= $detail->jumlah_produk + $detail->stok ?>" class="max-stock-history hidden">
<?php endforeach ?>
<div id="aside-transaction" class="fixed top-0 bottom-0 left-full p-14 bg-white transition-all border-l-2">
    <button class="aside-transaction-btn relative btn btn-square btn-ghost mb-5">
        <img src="<?= base_url('./images/arrow.png') ?>" class="w-7 rotate-180" alt="kembali">
    </button>
    <form method="post">
        <h3 class="text-xl font-medium">Teruskan Transaksi</h3>
        <div class="flex flex-col gap-5 my-5">
            <?php if (!empty($transaction)) : ?>
                <input type="number" name="transaction-id" value="<?= $transaction['id_transaksi'] ?>" class="hidden" />
            <?php endif ?>
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">ID Member (Opsional)</span>
                </label>
                <input type="text" name="member-id" placeholder="Ketikkan ID Member jika tersedia" class="input input-bordered min-w-[22rem]" <?= !empty($transaction) ? 'value="' . $transaction['id_member'] . '"' : "" ?> />
            </div>
            <div class="overflow-x-auto">
                <h4 class="text-sm font-medium mb-2">Detail Keranjang</h4>
                <input type="number" id="total-product-saved" name="total-product-saved" <?= !empty($transaction) ? 'value="' . count($transaction_details) . '"' : "" ?> class="hidden">
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

                        <?php if (count($transaction_details) != 0) : ?>
                            <?php $index = 1 ?>
                            <?php foreach ($transaction_details as $detail) : ?>
                                <tr>
                                    <input type="number" name="<?= $index ?>-product-id" value="<?= $detail->id_produk ?>" class="hidden">
                                    <input type="number" name="<?= $index ?>-stock-id" value="<?= $detail->id_stok ?>" class="hidden">
                                    <input type="number" name="<?= $index ?>-stock-needed-to-buy" value="<?= $detail->jumlah_produk ?>" class="hidden">
                                    <input type="number" name="<?= $index ?>-max-stock" value="<?= $detail->stok + $detail->jumlah_produk ?>" class="hidden">
                                    <input type="text" name="<?= $index ?>-product-name" value="<?= $detail->nama_baju ?>" class="hidden">
                                    <input type="number" name="<?= $index ?>-product-price" value="<?= $detail->harga ?>" class="hidden">
                                    <input type="text" name="<?= $index ?>-size" value="<?= $detail->ukuran ?>" class="hidden" />

                                    <td><?= $detail->nama_baju ?> (<?= $detail->ukuran ?>)</td>
                                    <td><?= $detail->jumlah_produk ?></td>
                                    <td>Rp. <?= $detail->jumlah_produk * $detail->harga ?></td>
                                    <td class="flex gap-1">
                                        <button type="button" id="<?= $detail->id_produk ?>-<?= $detail->ukuran ?>-add-action" class="add-action-btn btn btn-error btn-sm btn-square">+</button>
                                        <button type="button" id="<?= $detail->id_produk ?>-<?= $detail->ukuran ?>-minus-action" class="minus-action-btn btn btn-info btn-sm btn-square">-</button>
                                    </td>
                                </tr>
                                <?php $index++ ?>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">- Keranjang Kosong -</td>
                            </tr>
                        <?php endif ?>

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