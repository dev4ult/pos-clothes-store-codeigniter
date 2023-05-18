<div class="w-full">
    <div class="flex gap-10 justify-between items-center">
        <h1 class="font-semibold text-3xl">Selamat datang, <?= session()->get('username') ?></h1>
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn m-1 btn-square btn-error"><img class="w-7"
                    src="<?= base_url('./images/logout.png') ?>" alt="logout" /></label>
            <div tabindex="0" class="dropdown-content menu p-4 shadow bg-base-100 rounded-box w-52">
                <h4 class="badge badge-success">Online</h4>
                <h3 class="font-medium text-2xl"><?= session()->get('username') ?></h3>
                <a href="/auth/logout" class="btn btn-sm btn-outline ml-auto">logout</a>
            </div>
        </div>
    </div>
    <div class="mt-10 w-fit">
        <div class="mb-4 flex flex-wrap gap-4">
            <div class="stats bg-accent text-primary-content border-2">
                <div class="stat">
                    <div class="stat-title">Produk Baju</div>
                    <div class="stat-value"><?= $total_product ?> Produk</div>
                    <div class="stat-actions">
                        <a href="/produk" class="btn btn-sm">List Produk</a>
                    </div>
                </div>
            </div>
            <a href="/transaksi" class="card w-96 bg-white border-2 hover:bg-primary hover:text-white">
                <div class="card-body">
                    <h2 class="card-title font-bold">Histori Transaksi</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                </div>
            </a>

        </div>
        <div class="w-full">
            <div class="stats text-primary-content border-2 border-black w-full">
                <div class="stat border-r-2 border-black"">
                    <div class=" stat-title">Member</div>
                <div class="stat-value"><?= $total_product ?> Terdaftar</div>
                <div class="stat-actions">
                    <a href="/member" class="btn btn-sm btn-outline">List Member</a>
                </div>
            </div>
            <div class="stat w-full bg-black text-white">
                <div class="stat-title text-white">Kasir</div>
                <div class="stat-value"><?= $total_product ?> Pegawai</div>
                <div class="stat-actions">
                    <a href="/kasir" class="btn btn-sm btn-accent btn-outline">List Pegawai</a>
                </div>
            </div>
        </div>

    </div>
</div>
</div>