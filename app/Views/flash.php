<?php if (!empty(session()->getFlashdata("success"))) : ?>
<div id="flash" class="alert alert-success shadow-lg mb-5 w-fit">
    <div>
        <svg id="close-flash" xmlns="http://www.w3.org/2000/svg"
            class="cursor-pointer stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span><?= session()->getFlashdata('success') ?></span>
    </div>
</div>
<?php endif ?>
<?php if (!empty(session()->getFlashdata("error"))) : ?>
<div id="flash" class="alert alert-error shadow-lg mb-5 w-fit">
    <div>
        <svg id="close-flash" xmlns="http://www.w3.org/2000/svg"
            class="cursor-pointer stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span><?= session()->getFlashdata('error') ?></span>
    </div>
</div>
<?php endif ?>
<?php if (!empty(session()->getFlashdata("warning"))) : ?>
<div id="flash" class="alert alert-warning shadow-lg mb-5 w-fit">
    <div>
        <svg id="close-flash" xmlns="http://www.w3.org/2000/svg"
            class="cursor-pointer stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <span><?= session()->getFlashdata('warning') ?></span>
    </div>
</div>
<?php endif ?>