<input type="checkbox" id="edit-transaction-status-form-modal" class="modal-toggle" />
<div class="modal">
    <form action="/transaksi/ubah_status" method="post" class="modal-box max-w-xl">
        <input type="text" name="transaction-id" class="hidden" value="<?= $transaction->id_transaksi ?>">
        <h3 class="font-bold text-xl">Form Ubah Status Transaksi</h3>
        <p class="py-4">Lorem ipsum dolor sit amet consecte</p>
        <div class="flex flex-col gap-3">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Status Transaksi</span>
                </label>
                <select name="transaction-status" class="select select-bordered w-full" required>
                    <option disabled selected>Pilih status</option>
                    <option value="berhasil">Berhasil</option>
                    <option value="gagal">Gagal</option>
                </select>
            </div>
        </div>
        <div class="modal-action">
            <button type="submit" class="btn btn-sm btn-primary">submit</button>
            <label for="edit-transaction-status-form-modal" class="btn btn-sm btn-primary btn-outline">tutup</label>
        </div>
    </form>
</div>