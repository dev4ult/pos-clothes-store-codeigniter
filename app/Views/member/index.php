<div class="w-full">

    <div class="flex gap-10 justify-between mb-10">
        <div class="flex gap-3">
            <a href="/dashboard" class="btn btn-square">
                <img src="<?= base_url('./images/dashboard.png') ?>" class="w-7" alt="dashboard">
            </a>
            <label for="new-member-modal-form" class="btn btn-primary">Registrasi Member +</label>
        </div>
        <div class="form-control">
            <input type="text" id="member-search" placeholder="Cari Member..." name="search-key"
                class="input input-bordered" />
        </div>
    </div>
    <?php include("../app/Views/flash.php") ?>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th></th>
                    <th>ID Member</th>
                    <th>Nama Lengkap</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="item-container">
                <?php $i = 1 ?>
                <?php foreach ($members as $member) : ?>
                <tr>
                    <th><?= $i ?></th>
                    <td><?= $member->id_member ?></td>
                    <td><?= $member->nama_lengkap ?></td>
                    <td><?= $member->no_telepon ?></td>
                    <td class="flex gap-2">
                        <label for="<?= $member->id_member ?>-edit-member-form-modal"
                            class="btn btn-sm btn-accent">edit</label>
                        <?php include('../app/Views/modals/edit_member_form.php') ?>
                        <?php if (session()->get('role') != "cashier") : ?>
                        <label for="<?= $member->id_member ?>-delete-member-form-modal"
                            class="btn btn-sm btn-error btn-outline">hapus</label>
                        <?php include('../app/Views/modals/delete_member_form.php') ?>
                        <?php endif ?>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach ?>

                <?php if (count($members) == 0) : ?>
                <tr>
                    <td colspan="5" class="text-center">- Belum ada member yang Registrasi -</td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>