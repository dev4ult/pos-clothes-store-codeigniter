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
        <td colspan="6" class="text-center">- Tidak ada Transaksi dengan keyword tersebut -</td>
    </tr>
<?php endif ?>