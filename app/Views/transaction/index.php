<div class="w-full">
    <div class="mb-10 flex gap-5 justify-between items-center">
        <h1 class="font-semibold text-3xl">Histori Transaksi</h1>
        <div class="flex items-center gap-3">
            <a href="/dashboard" class="btn btn-square">
                <img src="<?= base_url('./images/dashboard.png') ?>" class="w-7" alt="dashboard">
            </a>
            <a href="/transaksi/print_histori" class="btn btn-outline btn-primary">
                Print Histori
            </a>
            <div class="form-control">
                <input type="text" placeholder="Cari Transaksi..." id="transaksi-search" name="search-key" id="transaction-search-key" class="input input-bordered" />
            </div>
        </div>
    </div>
    <?php include("../app/Views/flash.php") ?>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th></th>
                    <th>Nama Member</th>
                    <th>Kasir yang Mengurus</th>
                    <th>Total Pembelian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="item-container">
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
                                <span class="font-medium text-black/40">Tanpa Kartu Member</span>
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
                            <div class="badge badge-<?= $transaction_status ?> badge-outline badge-lg">
                                <?= ucwords($transaction->status) ?></div>
                        </td>
                        <td>
                            <a href="/transaksi/detail/<?= $transaction->id_transaksi ?>" class="btn btn-sm btn-accent">detail</a>
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