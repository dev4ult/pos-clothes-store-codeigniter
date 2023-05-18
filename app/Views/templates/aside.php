<?php
$pages = ["Home", "Dashboard", "Produk", "Transaksi", "Member", "Kasir"];
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
        <div class="bg-black/5 rounded-full overflow-hidden w-fit mx-auto p-3">
            <img src="<?= base_url('./images/user.png') ?>" class="w-12" alt="profile photo">
        </div>
        <h3 class="text-base font-medium mb-5 mt-2">Nibras</h3>
        <a href="/" class="btn btn-sm btn-outline btn-primary">edit profil</a>
    </div>
    <ul class="mt-10 flex flex-col gap-2">
        <?php foreach ($pages as $page) : ?>
            <li><a href="/<?= strtolower($page) ?>" class="btn <?= $page_title == $page ? 'btn-primary text-white btn-active' : 'btn-ghost' ?> w-full text-lg btn-xl min-w-[13rem]"><?= $page == "" ? "Home" : $page ?></a>
            </li>
        <?php endforeach ?>
    </ul>
</div>
<script src="<?= base_url('./js/toggleAside.js') ?>"></script>