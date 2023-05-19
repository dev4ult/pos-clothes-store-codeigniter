<?php
function mapSizeStock($v) {
    return $v->id_ukuran;
}

$sizeStock = array_map("mapSizeStock", $product_stock);
?>
<div class="py-1.5 w-full">
    <h1 class="font-semibold text-3xl mb-10">Detail Produk</h1>
    <div class="flex flex-col gap-3 border-2 rounded-2xl p-8 w-full">
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Gambar</h3>
            <img src="data:image/jpg;base64,<?= base64_encode($product->gambar_baju) ?>" class="h-56 w-52 object-cover rounded-xl" alt="product">
        </div>
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Nama Produk</h3>
            <h5 class=" text-xl  "><?= $product->nama_baju ?></h5>
        </div>
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Kategori</h3>
            <h5 class=" text-xl  "><?= $product->nama_kategori ?></h5>
        </div>
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Harga</h3>
            <h5 class=" text-xl  ">Rp. <?= $product->harga ?></h5>
        </div>
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Deskripsi</h3>
            <h5 class=" text-xl  "><?= $product->deskripsi ?></h5>
        </div>
        <div>

            <div class="overflow-x-auto w-fit">
                <form action="/produk/save_stok_produk" method="post">
                    <div class="flex gap-2 items-center mb-2">
                        <h3 class="badge badge-outline font-semibold">Stok</h3>
                        <button type="button" id="edit-stock-btn" class="btn btn-sm btn-accent">edit</button>
                        <button type="submit" id="save-stock-btn" class="btn btn-sm btn-primary hidden">simpan</button>
                        <button type="button" id="close-stock-btn" class="btn btn-sm btn-primary btn-square btn-outline hidden">X</button>
                    </div>
                    <input type="number" name="product-id" class="hidden" value="<?= $product->id_produk ?>">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr id="tr-head">
                                <th></th>
                                <th>Ukuran</th>
                                <th>Stok</th>
                                <th id="th-action" class="hidden">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-data">
                            <?php $i = 1 ?>
                            <?php foreach ($product_stock as $stock) : ?>
                                <tr id="<?= $stock->id_stok ?>-tr-data" class="tr-data">
                                    <td><?= $i ?></td>
                                    <td><?= $stock->jenis_ukuran ?></td>
                                    <td id="<?= $stock->id_stok ?>-stock-total"><?= $stock->stok ?></td>
                                    <td class="td-action hidden gap-2">
                                        <button id="<?= $stock->id_stok ?>-add-stock" type="button" class="add-stock-btn btn btn-sm btn-square btn-info">+</button>
                                        <button id="<?= $stock->id_stok ?>-minus-stock" type="button" class="minus-stock-btn btn btn-sm btn-square btn-error">-</button>
                                        <button id="<?= $stock->id_stok ?>-delete-stock" type="button" class="delete-stock-btn btn btn-sm btn-outline btn-error">kosongi</button>
                                    </td>
                                    <input id="<?= $stock->id_stok ?>-stock" type="number" name="<?= $stock->id_stok ?>-product-stock" class="product-stock hidden" value="<?= $stock->stok ?>">
                                    <input type="number" name="<?= $i - 1 ?>-stock-id" class="hidden" value="<?= $stock->id_stok ?>">
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </form>
                <form action="/produk/stok_produk_baru" method="post" id="form-new-size-stock" class="gap-2 hidden mt-2">
                    <input type="number" name="product-id" class="hidden" value="<?= $product->id_produk ?>">
                    <div class="form-control ">
                        <label class="label">
                            <span class="label-text">Input Stok Ukuran Baru</span>
                        </label>
                        <div class="input-group">
                            <select class="select select-bordered" name="product-size">
                                <option disabled selected>Pilih Ukuran</option>
                                <?php foreach ($sizes as $size) : ?>
                                    <?php if (!in_array($size->id_ukuran, $sizeStock)) : ?>
                                        <option value="<?= $size->id_ukuran ?>"><?= $size->jenis_ukuran ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                            <input type="number" name="product-stock" placeholder="10XX" class="input input-bordered" required />
                            <button type="submit" class="btn btn-primary">tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="text-right">
        <label for="edit-product-form-modal" class="btn btn-accent mt-5">edit detail</label>
    </div>
</div>