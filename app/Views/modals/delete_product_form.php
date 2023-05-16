<input type="checkbox" id="delete-product-form-modal" class="modal-toggle" />
<div class="modal">
    <form action="/produk/hapus_produk/<?= $product->id_produk ?>" class="modal-box max-w-xl overflow-hidden break-words">
        <h3 class="font-bold text-xl">Konfirmasi Hapus Produk</h3>
        <p class="py-4 ">Apakah anda yakin ingin menghapus produk ini?</p>
        <div class="modal-action">
            <button type="submit" class="btn btn-sm btn-error">hapus</button>
            <label for="delete-product-form-modal" class="btn btn-sm btn-error btn-outline">tutup</label>
        </div>
    </form>
</div>
<script src="<?= base_url('./js/productStockOfSize.js') ?>"></script>