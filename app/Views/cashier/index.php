<div class="w-full">
    <div class="flex gap-10 justify-between mb-10 w-full">
        <div class="flex gap-3">
            <a href="/dashboard" class="btn btn-square">
                <img src="<?= base_url('./images/dashboard.png') ?>" class="w-7" alt="dashboard">
            </a>
            <label for="new-cashier-form-modal" class="btn btn-primary">Registrasi Pegawai Kasir +</label>
        </div>
        <div class="form-control">
            <input type="text" placeholder="Cari Kasir..." id="kasir-search" name="search-key" class="input input-bordered" />
        </div>
    </div>
    <?php include("../app/Views/flash.php") ?>
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
            <tbody id="item-container">
                <?php $i = 1 ?>
                <?php foreach ($cashiers as $cashier) : ?>
                    <tr>
                        <th><?= $i ?></th>
                        <td><img src="data:image/jpg;base64,<?= base64_encode($cashier->foto_profil) ?>" class="w-20 h-20 object-cover rounded-xl" alt="foto profil" /></td>
                        <td><?= $cashier->nama_lengkap ?></td>
                        <td><?= $cashier->no_telepon ?></td>
                        <td><?= $cashier->email ?></td>
                        <td>
                            <div class="flex gap-2">
                                <a href="kasir/detail/<?= $cashier->id_kasir ?>" class="btn btn-sm btn-accent">detail</a>
                                <label for="<?= $cashier->id_kasir ?>-delete-cashier-form-modal" class="btn btn-sm btn-error btn-outline">hapus</label>
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