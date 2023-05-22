<div class="w-full">
    <div class="flex gap-10 items-center justify-between mb-10">
        <h1 class="font-semibold text-3xl">Detail Pegawai Kasir</h1>
        <a href="/kasir" class="btn ">
            <img src="<?= base_url("./images/arrow_white.png") ?>" class="w-7" alt="back">
        </a>
    </div>
    <?php include("../app/Views/flash.php") ?>
    <div class="flex gap-5 border-2 rounded-2xl p-8 w-full">
        <div class="flex-grow min-w-[20rem]">
            <img src="data:image/jpg;base64,<?= base64_encode($cashier->foto_profil) ?>" class="h-96 w-80 object-cover rounded-xl" alt="product">
        </div>
        <div class="w-0.5 bg-slate-300"></div>
        <div class="flex flex-col gap-3">
            <div>
                <h3 class="badge badge-outline font-semibold mb-2">Nama Lengkap</h3>
                <h5 class=" text-xl  "><?= $cashier->nama_lengkap ?></h5>
            </div>
            <div>
                <h3 class="badge badge-outline font-semibold mb-2">NIK</h3>
                <h5 class=" text-xl  "><?= $cashier->nik ?></h5>
            </div>
            <div>
                <h3 class="badge badge-outline font-semibold mb-2">Nomor telepon</h3>
                <h5 class=" text-xl  "><?= $cashier->no_telepon ?></h5>
            </div>
            <hr>
            <div>
                <h3 class="badge badge-outline font-semibold mb-2">Alamat</h3>
                <h5 class=" text-xl  "><?= $cashier->alamat ?></h5>
            </div>

        </div>
        <div class="w-0.5 bg-slate-300"></div>
        <div class="bg-black text-white p-6 flex flex-col gap-3 rounded-2xl h-fit">
            <div>
                <h3 class="badge badge-outline font-semibold mb-2">Username</h3>
                <h5 class=" text-xl  "><?= $cashier->username ?></h5>
            </div>
            <div>
                <h3 class="badge badge-outline font-semibold mb-2">Email</h3>
                <h5 class=" text-xl  "><?= $cashier->email ?></h5>
            </div>
        </div>
    </div>
    <div class="text-right">
        <label for="edit-cashier-form-modal" class="btn btn-accent mt-5">edit detail</label>
    </div>
</div>