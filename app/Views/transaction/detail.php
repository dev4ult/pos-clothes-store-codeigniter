<div class="py-1.5 w-full">
    <h1 class="font-semibold text-3xl mb-10">Detail Transaksi</h1>
    <div class="flex flex-col gap-3 border-2 rounded-2xl p-8 w-full">
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Member</h3>
            <h5 class=" text-xl  "><?= $transaction->nama_member ?></h5>
        </div>
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Kasir yang Mengurus</h3>
            <h5 class=" text-xl  "><?= $transaction->nama_kasir ?></h5>
        </div>
        <div>
            <h3 class="badge badge-outline font-semibold mb-2">Status Transaksi</h3>
            <div class="block badge badge-lg badge-success"><?= ucwords($transaction->status) ?></div>
        </div>
    </div>
</div>