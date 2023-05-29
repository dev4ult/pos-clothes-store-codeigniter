<div class="w-full">
    <div class="flex gap-10 items-center justify-between mb-10">
        <h1 class="font-semibold text-3xl">Detail Transaksi</h1>
        <div class="flex gap-3">
            <a href="/transaksi" class="btn ">
                <img src="<?= base_url("./images/arrow_white.png") ?>" class="w-7" alt="back">
            </a>
            <a href="/transaksi/print_transaksi/<?= $transaction->id_transaksi ?>" class="btn btn-outline btn-primary ">
                Print Transaksi
            </a>
        </div>
    </div>
    <div class="flex flex-col gap-4 border-2 rounded-2xl p-8 w-full">
        <div class="flex gap-5 justify-between">
            <div>
                <h3 class="badge badge-outline font-semibold mb-2">Member</h3>
                <?php if (!empty($transaction->nama_member)) : ?>
                    <h5 class="text-xl"><?= $transaction->nama_member ?></h5>
                <?php else : ?>
                    <h5 class="text-xl text-black/40 font-medium">Tanpa Kartu Member</h5>
                <?php endif ?>
            </div>
            <div class="text-right">
                <h3 class="badge badge-outline font-semibold mb-2">Status</h3>
                <?php $transaction_status = "";
                if ($transaction->status == "berhasil") {
                    $transaction_status = "success";
                } else if ($transaction->status == "gagal") {
                    $transaction_status = "error";
                } else {
                    $transaction_status = "warning";
                } ?>
                <div class="block badge badge-lg badge-outline badge-<?= $transaction_status ?>">
                    <?= ucwords($transaction->status) ?>
                </div>
            </div>
        </div>
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Kasir yang Mengurus</h3>
            <h5 class="text-xl"><?= $transaction->nama_kasir ?></h5>
        </div>
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Detail Order</h3>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama Produk</th>
                            <th>Jumlah Produk</th>
                            <th>Harga X Jumlah Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_prices = 0 ?>
                        <?php $i = 1 ?>
                        <?php foreach ($transaction_details as $detail) : ?>
                            <?php $total_prices += $detail->jumlah_produk * $detail->harga ?>
                            <tr>
                                <th><?= $i ?></th>
                                <td><?= $detail->nama_baju ?></td>
                                <td><?= $detail->jumlah_produk ?></td>
                                <td>Rp. <?= $detail->jumlah_produk * $detail->harga ?></td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach ?>
                        <tr class="active">
                            <td></td>
                            <td colspan="2" class="font-semibold">Total Harga</td>
                            <td class="font-semibold">Rp. <?= $total_prices ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-right mt-4">
        <?php if ($transaction->status == "gagal" || $transaction->status == "berhasil") : ?>
            <button class="btn btn-accent btn-disabled">status tidak bisa diubah</button>
        <?php else : ?>
            <div class="flex justify-end gap-3">
                <a href="/produk/ubah_transaksi/<?= $transaction->id_transaksi ?>" class="btn btn-accent btn-outline">ubah
                    orderan</a>
                <label for="edit-transaction-status-form-modal" class="btn btn-accent">ubah status</label>
            </div>
        <?php endif ?>
    </div>
</div>