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
        <td colspan="5" class="text-center">- Tidak ada Member dengan keyword tersebut -</td>
    </tr>
<?php endif ?>