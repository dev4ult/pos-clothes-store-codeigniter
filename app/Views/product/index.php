<?php
function returnId($k) {
    return $k->id_produk;
}

$product_stock_pid = array_map("returnId", $product_stock);

?>
<div class="flex-grow">
    <div class="flex gap-10 justify-between mb-10 w-full">
        <div class="flex gap-3">
            <a href="/dashboard" class="btn btn-square">
                <img src="<?= base_url('./images/dashboard.png') ?>" class="w-7" alt="dashboard">
            </a>
            <?php if (session()->get('role') != "cashier") : ?>
                <a href="/produk/list_tabel" for="product-form-modal" class="btn btn-outline btn-primary">Lihat Tabel /
                    Edit</a>
            <?php endif ?>
            <div class="form-control">
                <select class="select select-bordered" name="select-category">
                    <option value="empty" disabled selected>Pilih kategori</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->nama_kategori ?>"><?= $category->nama_kategori ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="form-control">
            <input type="text" placeholder="Cari Produk..." name="search-key" id="produk-search" class="input input-bordered" />
        </div>
    </div>
    <?php include("../app/Views/flash.php") ?>
    <div id="item-container" class="flex flex-wrap gap-5">
        <?php foreach ($products as $product) : ?>
            <?php $product_id = $product->id_produk; ?>
            <div class="card w-64 z-0 bg-white/50 border-2 transition-all hover:shadow-md">
                <figure><img src="data:image/jpg;base64,<?= base64_encode($product->gambar_baju) ?>" class="h-40 w-full object-cover" alt="<?= $product->nama_baju ?>" /></figure>
                <div class="card-body p-6">
                    <div class="badge badge-outline justify-end"><?= $product->nama_kategori ?></div>
                    <h2 class="card-title text-base ">
                        <?= $product->nama_baju ?>
                    </h2>
                    <div class="card-actions">
                        <h3 class="text-xl font-bold">Rp.<?= $product->harga ?></h3>
                    </div>
                    <div class="card-actions justify-end mb-3">
                        <?php foreach ($product_stock as $stock) : ?>
                            <?php if ($product_id == $stock->id_produk) : ?>
                                <?php if (session()->get('role') != "admin") : ?>
                                    <div>
                                        <input type="number" id="<?= $stock->id_stok ?>-stock-available" value="<?= $stock->stok ?>" class="hidden" />
                                        <input type="radio" id="<?= $stock->id_stok ?>" name="<?= $product_id ?>-size" class="peer hidden" value="<?= $stock->jenis_ukuran ?>">
                                        <label for="<?= $stock->id_stok ?>" class="btn btn-xs peer-checked:btn-accent">
                                            <?= $stock->jenis_ukuran ?>
                                        </label>
                                    </div>
                                <?php else : ?>
                                    <div>
                                        <label for="<?= $stock->id_stok ?>" class="badge">
                                            <?= $stock->jenis_ukuran ?>
                                        </label>
                                    </div>
                                <?php endif ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                    <div class="card-actions justify-end mt-auto">
                        <div class="hidden">
                            <input type="text" id="<?= $product_id ?>-name" value="<?= $product->nama_baju ?>">
                            <input type="number" id="<?= $product_id ?>-price" value="<?= $product->harga ?>">
                        </div>
                        <?php if (session()->get('role') != "admin") : ?>
                            <?php if (in_array($product_id, $product_stock_pid)) : ?>
                                <button id="<?= $product_id ?>-add" type="button" class="add-to-basket-btn btn btn-sm btn-primary btn-outline">Keranjang
                                    +</button>
                            <?php else : ?>
                                <h4 class="text-error font-semibold">STOK KOSONG</h4>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        <?php if (count($products) == 0) : ?>
            <h2 class="">Produk Kosong</h2>
        <?php endif ?>
    </div>
</div>
<script src="<?= base_url('./js/selectCategory.js') ?>"></script>