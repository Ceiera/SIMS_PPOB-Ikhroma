<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIMS PPOB-IKHROMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <style>
        * {
            font-family: sans-serif;
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('css') ?>/dashboard.css" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
</head>

<body>
    <?= $this->include('statis/navbar') ?>
    <div class="mt-3 d-flex flex-column padding-global" style="padding-left: 20rem; padding-right: 20rem;">
        <div class="profile-img d-flex flex-column align-items-center row-gap-2">
            <img src="<?= base_url('assets/Profile Photo.png') ?>" width="100px" alt="">
            <h3 class="fw-bold"><?= $profile->first_name ?> <?= $profile->last_name ?></h3>
        </div>
        <div class="d-flex flex-column align-item-center row-gap-2">
            <?= form_open('account/update') ?>
            <?= csrf_field() ?>
            <div class="group">
                <label for="email" class="fw-bold">Email</label>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white" id="basic-addon1"><i class="bi bi-at"></i></span>
                    <input type="email" readonly class="form-control border-start-0" placeholder="masukkan email anda" value="<?= $profile->email ?>" aria-label="email" aria-describedby="basic-addon1" name="email" id="email" required />
                </div>
            </div>
            <div class="group">
                <label for="firstname" class="fw-bold">Nama Depan</label>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white" id="basic-addon2"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control border-start-0" placeholder="masukkan nama depan anda" aria-label="firstname" value="<?= $profile->first_name; ?>"" aria-describedby=" basic-addon2" name="firstname" id="lastname" required />
                </div>
            </div>
            <div class="group">
                <label for="lastname" class="fw-bold">Nama Belakang</label>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white" id="basic-addon3"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control border-start-0" placeholder="masukkan nama belakang anda" aria-label="lastname" value="<?= $profile->last_name; ?>" aria-describedby="basic-addon3" name="lastname" id="lastname" required />
                </div>
            </div>
            <button type="submit" class="btn btn-danger">Simpan</button>
            <?= form_close() ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php ?>