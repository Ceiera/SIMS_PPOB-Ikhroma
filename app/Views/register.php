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
    <link rel="stylesheet" href="<?= base_url('css') ?>/register.css" />
</head>

<body>
    <div class="d-flex flex-row">
        <div class="register-form">
            <div class="d-flex flex-column">
                <div class="form-header d-flex flex-column row-gap-3">
                    <h4 class="fw-bolder text-center">
                        <span><img src="<?= base_url('assets') ?>/Logo.png" alt="" /></span>
                        SIMS PPOB
                    </h4>
                    <h4 class="fw-bolder text-center mb-4">
                        Lengkapi data untuk <br />membuat akun
                    </h4>
                </div>
                <div class="form-body d-flex flex-column row-gap-2">
                    <?= form_open('register') ?>
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white" id="basic-addon1"><i class="bi bi-at"></i></span>
                        <input type="email" class="form-control border-start-0" placeholder="masukkan email anda" aria-label="email" aria-describedby="basic-addon1" name="email" id="email" required />
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white" id="basic-addon2"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control border-start-0" placeholder="nama depan" aria-label="firstname" aria-describedby="basic-addon2" name="firstname" id="firstname" required />
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white" id="basic-addon3"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control border-start-0" placeholder="nama belakang" aria-label="lastname" aria-describedby="basic-addon3" name="lastname" id="lastname" required />
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white" id="basic-addon4"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control border-end-0 border-start-0" placeholder="buat password" aria-label="Password" aria-describedby="basic-addon4" name="password" id="password" required minlength="8" />
                        <span class="input-group-text bg-white" name="password-eye" id="password-eye"><i class="bi bi-eye"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white" id="basic-addon5"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control border-end-0 border-start-0" placeholder="konfirmasi password" aria-label="re-password" aria-describedby="basic-addon5" name="re-password" id="re-password" required minlength="8" />
                        <span class="input-group-text bg-white" name="re-password-eye" id="re-password-eye"><i class="bi bi-eye"></i></span>
                    </div>
                    <div class="input-group mt-3">
                        <button type="submit" class="btn btn-danger form-control">
                            Masuk
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
                <div class="form-footer align-self-center mt-3">
                    <p>sudah punya akun? login <a href="<?= base_url('login') ?>">di sini</a></p>
                </div>
            </div>

        </div>
        <div class="register-image">
            <img src="<?= base_url('assets') ?>/Illustrasi Login.png" alt="" />
        </div>
    </div>
    <?php
    if (session()->getFlashdata('error') !== null) {
    ?>
        <div id="alert" class="d-flex flex-column alert alert-danger position-absolute bottom-0 start-0 p-2" style="margin-left: 5rem;">
            <div id="alert-close" class="text-end text-white">X</div>
            <?php
            $error = session()->getFlashdata('error');
            foreach ($error as $key) {
                if ($key !== null) {
            ?>
                    <div><?= $key ?></div>
            <?php
                }
            } ?>
        </div>
        <script>
            let alert = document.getElementById("alert");
            let alertClose = document.getElementById("alert-close");
            alertClose.addEventListener("click", () => {
                alert.remove();
            })
        </script>
    <?php
    }
    ?>

    <?php
    if (session()->getFlashdata('success') !== null) {
    ?>
        <div id="alert" class="d-flex flex-column alert alert-success position-absolute bottom-0 start-0 p-2" style="margin-left: 5rem;">
            <div>SUCCESS CREATED ACCOUNT</div>
        </div>
    <?php
    }
    ?>

    <script>
        let eyePassword = document.getElementById("password");
        let eyeIcon = document.getElementById("password-eye");
        eyeIcon.addEventListener("click", () => {
            if (eyePassword.type === "password") {
                eyePassword.type = "text";
            } else {
                eyePassword.type = "password";
            }
        });
        let reEyePassword = document.getElementById("re-password");
        let reEyeIcon = document.getElementById("re-password-eye");
        reEyeIcon.addEventListener("click", () => {
            if (reEyePassword.type === "password") {
                reEyePassword.type = "text";
            } else {
                reEyePassword.type = "password";
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php ?>