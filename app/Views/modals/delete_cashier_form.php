<input type="checkbox" id="<?= $cashier->id_kasir ?>-delete-cashier-form-modal" class="modal-toggle" />
<div class="modal">
    <form action="/kasir/hapus_kasir/<?= $cashier->id_kasir ?>" class="modal-box max-w-xl overflow-hidden break-words">
        <h3 class="font-bold text-xl">Konfirmasi Hapus Pegawai Kasir</h3>
        <p class="py-4 ">Apakah anda yakin ingin menghapus pegawai ini?</p>
        <div class="modal-action">
            <button type="submit" class="btn btn-sm btn-error">hapus</button>
            <label for="<?= $cashier->id_kasir ?>-delete-cashier-form-modal"
                class="btn btn-sm btn-error btn-outline">tutup</label>
        </div>
    </form>
</div>