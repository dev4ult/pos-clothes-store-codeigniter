<div class="py-1.5">
    <h1 class="font-semibold text-3xl">Selamat datang, Nibras</h1>
    <div class="mt-10 flex flex-wrap gap-4">
        <div class="stats bg-accent text-primary-content border-2">
            <div class="stat">
                <div class="stat-title">Produk Baju</div>
                <div class="stat-value"><?= $total_product ?></div>
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
        <div class="stats text-primary-content border-2">
            <div class="stat">
                <div class="stat-title">Member</div>
                <div class="stat-value"><?= $total_product ?> Terdaftar</div>
                <div class="stat-actions">
                    <a href="/produk" class="btn btn-sm btn-outline">List Member</a>
                </div>
            </div>
            <div class="stat">
                <div class="stat-title">Kasir</div>
                <div class="stat-value"><?= $total_product ?> Pegawai</div>
                <div class="stat-actions">
                    <a href="/produk" class="btn btn-sm btn-outline">List Pegawai</a>
                </div>
            </div>
        </div>
    </div>
</div>