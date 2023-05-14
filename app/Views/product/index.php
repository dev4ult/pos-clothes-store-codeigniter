<div class="flex-grow">
    <!-- <label for="new-product-modal" class="btn mb-10">Tambah Produk</label>

    <input type="checkbox" id="new-product-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Congratulations random Internet user!</h3>
            <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!
            </p>
            <div class="modal-action">
                <label for="new-product-modal" class="btn">Tutup</label>
            </div>
        </div>
    </div> -->

    <div class="flex gap-10 justify-between mb-10 w-full">
        <div class="form-control">
            <div class="input-group">
                <select class="select select-bordered">
                    <option disabled selected>Pilih kategori</option>
                    <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->id_kategori ?>"><?= $category->nama_kategori ?></option>
                    <?php endforeach ?>
                </select>
                <button type="button" class="btn btn-primary">Set</button>
            </div>
        </div>
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

    <div class="flex flex-wrap gap-10">
        <?php foreach ($products as $product) : ?>
        <?php $product_id = $product->id_produk; ?>
        <div class=" card w-64 z-0 bg-white/50 border-2 transition-all hover:shadow-md">
            <figure><img src="data:image/jpg;base64,<?= base64_encode($product->gambar_baju) ?>"
                    class="h-40 w-full object-cover" alt="<?= $product->nama_baju ?>" /></figure>
            <div class="card-body p-6">
                <div class="badge badge-outline justify-end"><?= $product->nama_kategori ?></div>
                <h2 class="card-title text-base ">
                    <?= $product->nama_baju ?>
                </h2>
                <div class="card-actions">
                    <h3 class="text-xl font-bold">Rp.<?= $product->harga ?></h3>
                </div>
                <div class="card-actions justify-end">
                    <?php foreach ($product_stock as $stock) : ?>
                    <?php if ($product->id_produk == $stock->id_produk) : ?>
                    <div>
                        <input type="radio" id="<?= $stock->id_stok ?>" name="<?= $product_id ?>-size"
                            class="peer hidden" value="<?= $stock->jenis_ukuran ?>">
                        <label for="<?= $stock->id_stok ?>" class="btn btn-xs peer-checked:btn-accent">
                            <?= $stock->jenis_ukuran ?>
                        </label>
                    </div>
                    <?php endif ?>
                    <?php endforeach ?>
                </div>
                <div class="card-actions justify-end mt-3">
                    <div class="hidden">
                        <input type="text" id="<?= $product_id ?>-name" value="<?= $product->nama_baju ?>">
                        <input type="number" id="<?= $product_id ?>-price" value="<?= $product->harga ?>">
                    </div>
                    <button id="<?= $product_id ?>-add" type="submit"
                        class="add-to-basket-btn btn btn-sm btn-primary btn-outline">Keranjang
                        +</button>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>