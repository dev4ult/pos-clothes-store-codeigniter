<?php $i = 1 ?>
<?php foreach ($products as $product) : ?>
    <?php
    $total_stock = 0;
    foreach ($product_stock as $stock) {
        if ($stock->id_produk == $product->id_produk) {
            $total_stock += $stock->stok;
        }
    }
    ?>
    <tr>
        <th><?= $i ?></th>
        <td><?= $product->nama_baju ?></td>
        <td><?= $product->nama_kategori ?></td>
        <td class="font-semibold">Rp. <?= $product->harga ?></td>
        <td>
            <?php if ($total_stock != 0) : ?>
                <div class="badge badge-lg"><?= $total_stock ?></div>
            <?php else : ?>
                <div class="badge badge-outline badge-lg">Kosong</div>
            <?php endif ?>
        </td>
        <td class="flex gap-2">
            <a href="/produk/detail/<?= $product->id_produk ?>" class="btn btn-sm btn-accent">detail</a>
            <label for="delete-product-form-modal" type="button" class="btn btn-sm btn-error btn-outline">hapus</label>
            <?php include('../app/Views/modals/delete_product_form.php') ?>
        </td>
    </tr>
    <?php $i++ ?>
<?php endforeach ?>
<?php if (count($products) == 0) : ?>
    <tr>
        <td colspan="6" class="text-center">
            - Tidak ada Produk dengan keyword tersebut -
        </td>
    </tr>
<?php endif ?>