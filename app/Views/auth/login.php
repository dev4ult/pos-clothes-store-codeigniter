<div class="w-full flex flex-col items-center justify-center py-16">
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-error shadow-lg mb-5 w-fit">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        </div>
    <?php endif ?>
    <div class="border-2 border-black/10 p-8 rounded-3xl flex gap-10 items-center">
        <img src="<?= base_url('./images/login_pic.jpg') ?>" class="w-80 h-96 rounded-2xl object-cover" alt="clothes">
        <form action="/auth/login" method="post">
            <h1 class="text-2xl font-semibold">Login</h1>
            <p class="max-w-sm mt-2">Masuk untuk mengakses fitur dari aplikasi ini</p>
            <div class="mb-8 mt-5">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text ">Email</span>
                    </label>
                    <input type="email" placeholder="Ketikkan email anda" class="input input-bordered min-w-[22rem]" name="email" required />
                </div>
                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text ">Password</span>
                    </label>
                    <input type="password" placeholder="Ketikkan password anda" class="input input-bordered min-w-[22rem]" name="password" required />
                </div>
            </div>
            <button type="submit" class="block w-full btn btn-primary">Login</button>
        </form>
    </div>
</div>