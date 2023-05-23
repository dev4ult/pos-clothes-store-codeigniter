<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Transaksi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
    * {
        font-family: 'Poppins', sans-serif;

    }

    h1 {
        margin-bottom: 1rem;
    }

    td,
    th {
        padding: 1rem;
        font-size: 1.5rem;
        border: 1px solid;

    }

    thead tr th {
        background-color: gray;
    }

    .success {
        color: green;
    }

    .warning {
        color: yellow;
    }

    .error {
        color: red;
    }
    </style>
</head>

<body>
    <h1>Histori Transaksi</h1>
    <table class="table w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Member</th>
                <th>Kasir yang Mengurus</th>
                <th>Total Pembelian</th>
                <th>Status</th>
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
                    <div class="<?= $transaction_status ?>">
                        <?= ucwords($transaction->status) ?></div>
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
</body>

</html>