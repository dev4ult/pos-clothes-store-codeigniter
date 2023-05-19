<div class="w-full">
    <div class="mb-10 flex gap-5 justify-between items-center">
        <h1 class="font-semibold text-3xl">Transaksi</h1>
        <div class="form-control">
            <div class="input-group">
                <input type="text" placeholder="Search…" class="input input-bordered" />
                <button class="btn btn-primary btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th></th>
                    <th>Member</th>
                    <th>Kasir yang Mengurus</th>
                    <th>Total Pembelian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($transactions as $transaction) : ?>
                <?php $transaction_status = "";
                    if ($transaction->status == "berhasil") {
                        $transaction_status = "success";
                    } else if ($transaction->status == "gagal") {
                        $transaction_status = "error";
                    } else {
                        $transaction_status = "warning";
                    } ?>
                <tr>
                    <th><?= $i ?></th>
                    <td>
                        <?php if ($transaction->nama_member) : ?>
                        <span class="font-medium"><?= $transaction->nama_member ?></span>
                        <?php else : ?>
                        <span class="font-medium text-black/40">Tanpa Member</span>
                        <?php endif ?>
                    </td>
                    <td><?= $transaction->nama_kasir ?></td>
                    <?php $total_prices = 0;
                        foreach ($detail_prices as $price) {
                            if ($price->id_transaksi == $transaction->id_transaksi) {
                                $total_prices += (int) $price->harga * $price->jumlah_produk;
                            }
                        }
                        ?>
                    <td>Rp. <?= $total_prices ?></td>
                    <td>
                        <div class="badge badge-<?= $transaction_status ?> badge-lg">
                            <?= ucwords($transaction->status) ?></div>
                    </td>
                    <td>
                        <a href="/transaksi/detail/<?= $transaction->id_transaksi ?>"
                            class="btn btn-sm btn-accent btn-outline">detail</a>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach ?>
                <?php if (count($transactions) == 0) : ?>
                <tr>
                    <td colspan="6" class="text-center">- Data Transaksi Kosong -</td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>