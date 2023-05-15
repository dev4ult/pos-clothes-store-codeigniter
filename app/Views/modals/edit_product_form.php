<input type="checkbox" id="edit-product-form-modal" class="modal-toggle" />
<div class="modal">
    <form id="edit-form-tag" class="modal-box max-w-xl" enctype="multipart/form-data">
        <h3 class="font-bold text-xl">Form Edit Produk</h3>
        <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
        <input type="number" name="product-id" class="hidden" value="<?= $product->id_produk ?>">
        <div class="flex flex-col gap-3">
            <div class="flex gap-3">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Nama Baju</span>
                    </label>
                    <input type="text" name="product-name" placeholder="T-Shirt XYZ ..."
                        class="input w-full input-bordered" value="<?= $product->nama_baju ?>" />
                </div>
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Harga (Rp)</span>
                    </label>
                    <input type="number" name="product-price" placeholder="100XXX" class="input w-full input-bordered"
                        value="<?= $product->harga ?>" />
                </div>
            </div>
            <div class="flex gap-3">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Kategori</span>
                    </label>
                    <select class="select w-full select-bordered" name="product-category">
                        <option disabled>Pilih Kategori</option>
                        <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id_kategori ?>"
                            <?= $category->id_kategori == $product->id_kategori ? 'selected' : '' ?>>
                            <?= $category->nama_kategori ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Deskripsi</span>
                    </label>
                    <textarea class="textarea textarea-bordered h-24 w-full" name="product-desc"
                        placeholder="Deksripsi"><?= $product->deskripsi ?></textarea>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Upload Gambar</span>
                    </label>
                    <input type="file" name="product-img" class="file-input file-input-bordered w-full" />
                </div>
            </div>
        </div>
        <div class="modal-action">
            <button type="submit" class="btn btn-sm btn-primary">simpan</button>
            <label for="edit-product-form-modal" class="btn btn-sm btn-primary btn-outline">tutup</label>
        </div>
    </form>
</div>
<script src="<?= base_url('./js/productStockOfSize.js') ?>"></script>