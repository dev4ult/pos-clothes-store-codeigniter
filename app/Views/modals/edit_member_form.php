<input type="checkbox" id="<?= $member->id_member ?>-edit-member-form-modal" class="modal-toggle" />
<div class="modal">
    <form action="/member/save_member" method="post" class="modal-box max-w-xl">
        <input type="text" name="member-id" class="hidden" value="<?= $member->id_member ?>">
        <h3 class="font-bold text-xl">Form Registrasi Member</h3>
        <p class="py-4">Lorem ipsum dolor sit amet consecte</p>
        <div class="flex flex-col gap-3">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nama Lengkap</span>
                </label>
                <input type="text" name="full-name" placeholder="Ketikkan nama lengkap" class="input w-full input-bordered" value="<?= $member->nama_lengkap ?>" required />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nomor Telepon</span>
                </label>
                <input type="number" name="phone-number" placeholder="Ketikkan nomor telepon" class="input w-full input-bordered" value="<?= $member->no_telepon ?>" required />
            </div>
        </div>
        <div class="modal-action">
            <button type="submit" class="btn btn-sm btn-primary">submit</button>
            <label for="<?= $member->id_member ?>-edit-member-form-modal" class="btn btn-sm btn-primary btn-outline">tutup</label>
        </div>
    </form>
</div>