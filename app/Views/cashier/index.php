<div class="w-full">
    <div class="flex gap-10 justify-between mb-10 w-full">
        <div class="flex gap-3">
            <a href="/dashboard" class="btn btn-primary btn-square">
                <img src="<?= base_url('./images/dashboard.png') ?>" class="w-7" alt="dashboard">
            </a>
            <label for="new-cashier-form-modal" class="btn btn-primary">Registrasi Pegawai Kasir +</label>
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
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th></th>
                    <th>Foto Profil</th>
                    <th>Nama Lengkap</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($cashiers as $cashier) : ?>
                <tr>
                    <th><?= $i ?></th>
                    <td><img src="data:image/jpg;base64,<?= base64_encode($cashier->foto_profil) ?>"
                            class="w-20 h-20 object-cover rounded-xl" alt="foto profil" /></td>
                    <td><?= $cashier->nama_lengkap ?></td>
                    <td><?= $cashier->no_telepon ?></td>
                    <td><?= $cashier->email ?></td>
                    <td>
                        <div class="flex gap-2">
                            <a href="kasir/detail/<?= $cashier->id_kasir ?>" class="btn btn-sm btn-accent">detail</a>
                            <label for="<?= $cashier->id_kasir ?>-delete-cashier-form-modal"
                                class="btn btn-sm btn-error btn-outline">hapus</label>
                            <?php include('../app/Views/modals/delete_cashier_form.php'); ?>
                        </div>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach ?>

                <?php if (count($cashiers) == 0) : ?>
                <tr>
                    <td colspan="6" class="text-center">- Tidak ada pegawai -</td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>