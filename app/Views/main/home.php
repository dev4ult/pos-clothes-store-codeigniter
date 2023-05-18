<div class="w-full">
    <div class="flex gap-10 justify-between items-center">
        <h1 class="font-semibold text-3xl">Toko Baju</h1>
        <?php if (is_null(session()->get('logged_in'))) : ?>
        <a href="/auth" class="btn btn-xl btn-primary btn-success">login</a>
        <?php else : ?>
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn m-1 btn-square btn-error"><img class="w-7"
                    src="<?= base_url('./images/logout.png') ?>" alt="logout" /></label>
            <div tabindex="0" class="dropdown-content menu p-4 shadow bg-base-100 rounded-box w-52">
                <h4 class="badge badge-success">Online</h4>
                <h3 class="font-medium text-2xl"><?= session()->get('username') ?></h3>
                <a href="/auth/logout" class="btn btn-sm btn-outline ml-auto">logout</a>
            </div>
        </div>
        <?php endif ?>
    </div>
</div>