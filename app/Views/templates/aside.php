<?php
$pages = ["Home", "Dashboard", "Produk", "Transaksi", "Member"];

if (session()->get('role') != "cashier") {
    array_push($pages, "Kasir");
}
?>
<div class="pr-14">
    <button type="button" class="aside-btn btn btn-square btn-ghost">
        <img src="<?= base_url('./images/menu.png') ?>" class="w-7" alt="menu">
    </button>
</div>
<div id="aside" class="fixed h-full right-full transition-all top-0 z-20 w-fit p-14 bg-white text-right border-r-2">
    <button type="button" class="aside-btn btn btn-square mb-10 btn-ghost">
        <img src="<?= base_url('./images/arrow.png') ?>" class="w-8" alt="back">
    </button>
    <div class="text-center">
        <?php if (is_null(session()->get('logged_in'))) : ?>
        <div class="w-16 h-16 flex justify-center items-center mx-auto bg-black/20 rounded-full">
            <img src="<?= base_url('./images/user.png') ?>" class="w-7" alt="profile photo">
        </div>
        <?php else : ?>
        <img src="data:image/jpg;base64,<?= base64_encode(session()->get('user_photo')) ?>"
            class="w-16 h-16 mx-auto bg-cover rounded-full" alt="profile photo">
        <?php endif ?>
        <h3 class="text-base font-medium mb-5 mt-2">
            <?= session()->get('username') ? session()->get('username') : 'Guest' ?></h3>

    </div>
    <ul class="mt-10 flex flex-col gap-2">
        <?php foreach ($pages as $page) : ?>
        <li><a href="/<?= strtolower($page) ?>"
                class="btn <?= $page_title == $page ? 'btn-primary text-white btn-active' : 'btn-ghost' ?> w-full text-lg btn-xl min-w-[13rem]"><?= $page == "" ? "Home" : $page ?></a>
        </li>
        <?php endforeach ?>
    </ul>
</div>
<script src="<?= base_url('./js/toggleAside.js') ?>"></script>