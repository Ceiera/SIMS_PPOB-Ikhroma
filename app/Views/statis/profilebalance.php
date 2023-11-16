<section id="info-akun" class="padding-global mb-5">
    <div class="d-flex flex-row justify-content-between">
        <div class="d-flex flex-column row-gap-3 align-items-start">
            <div>
                <img src="<?php if ($profile->profile_image!="https://minio.nutech-integrasi.app/take-home-test/null") {
                    echo $profile->profile_image;
                }else{
                    echo base_url('assets/Profile Photo.png');
                } ?>" alt="" />
            </div>
            <div>
                <h5 class="mb-0">Selamat Datang,</h5>
                <h3 class="fw-bold"><?= $profile->first_name ?> <?= $profile->last_name ?></h3>
            </div>
        </div>
        <div class="saldo d-flex flex-column p-1 py-1 px-4 rounded-3 row-gap-2 position-relative">
            <p class="text-white z-2">Saldo anda</p>
            <h3 class="text-white z-2">Rp <?= $balance->balance ?></h3>
            <p class="text-white mb-0 z-2 align-items-stretch">Lihat saldo</p>
            <img src="<?= base_url('assets') ?>/Background Saldo.png" class="position-absolute z-1 start-0 top-0" width="" alt="">
        </div>
    </div>
</section>