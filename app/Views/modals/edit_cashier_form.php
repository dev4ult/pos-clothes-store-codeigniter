<input type="checkbox" id="edit-cashier-form-modal" class="modal-toggle" />
<div class="modal">
    <form action="/kasir/save_kasir" method="post" class="modal-box max-w-xl" enctype="multipart/form-data">
        <input type="number" name="cashier-id" class="hidden" value="<?= $cashier->id_kasir ?>">
        <h3 class="font-bold text-xl">Form Update Data Pegawai Kasir</h3>
        <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
        <div class="flex flex-col gap-3">
            <div class="flex gap-3">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="employee-full-name" placeholder="Ketikkan nama lengkap pegawai" class="input w-full input-bordered" value="<?= $cashier->nama_lengkap ?>" required />
                </div>
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">NIK</span>
                    </label>
                    <input type="number" name="employee-nik" maxlength="16" placeholder="XXXXXXXXXXXXXXXX" class="input w-full input-bordered" value="<?= $cashier->nik ?>" required />
                </div>
            </div>
            <div class="flex gap-3">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Nomor Telepon</span>
                    </label>
                    <input type="number" name="employee-phone-number" placeholder="08XXXXXXXXXX" class="input w-full input-bordered" value="<?= $cashier->no_telepon ?>" required />
                </div>
            </div>
            <div class="flex gap-3">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Alamat</span>
                    </label>
                    <textarea class="textarea textarea-bordered h-24 w-full" name="employee-address" placeholder="Ketikkan alamat tempat tinggal" required><?= $cashier->alamat ?></textarea>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Upload Foto Profil</span>
                    </label>
                    <input type="file" name="employee-photo" class="file-input file-input-bordered w-full" />
                </div>
            </div>
            <h4 class="font-semibold text-lg mt-6">Data / Kredential Akun</h4>
            <div class="flex gap-3">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="employee-username" placeholder="Ketikkan username akun" class="input w-full input-bordered" value="<?= $cashier->username ?>" required />
                </div>
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Email Baru (Opsional)</span>
                    </label>
                    <input type="email" name="employee-email" placeholder="Ketikkan email baru jika ingin ubah email" class="input w-full input-bordered" />
                </div>
            </div>
            <div class="form-control flex-grow">
                <label class="label">
                    <span class="label-text">Password Baru (Opsional)</span>
                </label>
                <input type="password" name="employee-password" placeholder="Ketikkan password baru jika ingin ubah password" class="input w-full input-bordered" />
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-sm btn-primary">simpan</button>
                <label for="edit-cashier-form-modal" class="btn btn-sm btn-primary btn-outline">tutup</label>
            </div>
        </div>
    </form>
</div>