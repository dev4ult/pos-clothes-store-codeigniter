<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            font-family: 'Poppins', sans-serif;
        }

        .container {
            padding: 3rem;
            border-radius: 2rem;
            border: 2px gray solid;
        }

        .text-xl {
            font-size: 1.25rem;
            margin-block: 0px;
            line-height: 0.5;
        }

        .badge {
            text-decoration: underline;
            font-weight: 400;
            font-size: 1rem;
        }


        .text-gray {
            color: gray;
        }


        .status-success {
            color: lightgreen;
        }

        .status-error {
            color: red;
        }

        .status-warning {
            color: orange;
        }

        td,
        th {
            padding: 1rem;
            font-size: 1rem;
            border: 1px black solid;
        }

        .font-semibold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Transaksi</h1>
        <div>
            <p class="badge">Member</p>
            <?php if (!empty($transaction->nama_member)) : ?>
                <h3 class="text-xl"><?= $transaction->nama_member ?></h3>
            <?php else : ?>
                <h3 class="text-xl text-gray">Tanpa Kartu Member</h3>
            <?php endif ?>
        </div>
        <div>
            <p class="badge">Status</p>
            <?php $transaction_status = "";
            if ($transaction->status == "berhasil") {
                $transaction_status = "success";
            } else if ($transaction->status == "gagal") {
                $transaction_status = "error";
            } else {
                $transaction_status = "warning";
            } ?>
            <div class="text-xl status-<?= $transaction_status ?>">
                <?= ucwords($transaction->status) ?>
            </div>
        </div>
        <div>
            <p class="badge">Kasir yang Mengurus</p>
            <h3 class="text-xl"><?= $transaction->nama_kasir ?></h3>
        </div>
        <div>
            <p class="badge">Detail Order</p>
            <table class="table">
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
</body>

</html>