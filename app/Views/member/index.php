<div class="w-full">

    <div class="flex gap-10 justify-between mb-10">
        <div class="flex gap-3">
            <a href="/dashboard" class="btn btn-square">
                <img src="<?= base_url('./images/dashboard.png') ?>" class="w-7" alt="dashboard">
            </a>
            <label for="new-member-modal-form" class="btn btn-primary">Registrasi Member +</label>
        </div>
        <div class="form-control">
            <div class="input-group">
                <input type="text" placeholder="Search…" class="input input-bordered" />
                <button class="btn btn-primary btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
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
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($members as $member) : ?>
                    <tr>
                        <th><?= $i ?></th>
                        <td><?= $member->id_member ?></td>
                        <td><?= $member->nama_lengkap ?></td>
                        <td><?= $member->no_telepon ?></td>
                        <td class="flex gap-2">
                            <label for="<?= $member->id_member ?>-edit-member-form-modal" class="btn btn-sm btn-accent">edit</label>
                            <?php include('../app/Views/modals/edit_member_form.php') ?>
                            <?php if (session()->get('role') != "cashier") : ?>
                                <label for="<?= $member->id_member ?>-delete-member-form-modal" class="btn btn-sm btn-error btn-outline">hapus</label>
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