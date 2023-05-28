<div class="w-full">
    <div class="flex justify-between gap-10 mb-10">
        <div class="flex gap-3">
            <a href="/produk" class="btn ">
                <img src="<?= base_url("./images/arrow_white.png") ?>" class="w-7" alt="back">
            </a>
            <label for="new-product-form-modal" class="btn btn-primary">tambah +</label>
        </div>
        <div class="form-control">
            <input type="text" placeholder="Cari Produk ..." name="search-key" id="produk-search-table" class="input input-bordered" />
        </div>
    </div>
    <?php include("../app/Views/flash.php") ?>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th></th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="item-container">
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
            </tbody>
        </table>
    </div>
</div>