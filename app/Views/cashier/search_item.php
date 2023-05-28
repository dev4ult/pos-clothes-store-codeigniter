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
        <td colspan="6" class="text-center">- Tidak ada Pegawai dengan keyword tersebut -</td>
    </tr>
<?php endif ?>