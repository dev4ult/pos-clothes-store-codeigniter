<input type="checkbox" id="<?= $member->id_member ?>-delete-member-form-modal" class="modal-toggle" />
<div class="modal">
    <form action="/member/hapus_member/<?= $member->id_member ?>" class="modal-box max-w-xl overflow-hidden break-words">
        <h3 class="font-bold text-xl">Konfirmasi Hapus Member</h3>
        <p class="py-4 ">Apakah anda yakin ingin menghapus member ini?</p>
        <div class="modal-action">
            <button type="submit" class="btn btn-sm btn-error">hapus</button>
            <label for="<?= $member->id_member ?>-delete-member-form-modal" class="btn btn-sm btn-error btn-outline">tutup</label>
        </div>
    </form>
</div>