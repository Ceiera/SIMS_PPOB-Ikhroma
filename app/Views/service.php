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
    <?= $this->include('statis/profilebalance') ?>
    <section id="topup" class="padding-global">
        <div class="d-flex flex-column row-gap-5">
            <div class="d-flex flex-column row-gap-3">
                <h5>PemBayaran</h5>
                <h5 class="fw-bold"><span class="me-2"><img width="50px" src="<?= $service->service_icon?>" alt=""></span><?= $service->service_name?></h5>
            </div>
            <div class="form topup d-flex flex-column gap-2 flex-grow-1">
                <?= form_open('service/'.$service->service_code) ?>
                <?= csrf_field() ?>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white" id="basic-addon"><i class="bi bi-cash"></i></span>
                    <input type="number" class="form-control border-start-0" placeholder="Masukkan Nominal Top Up" aria-label="nilai" aria-describedby="basic-addon" value="<?= $service->service_tariff?>" name="nilai" id="nilai" readonly/>
                </div>
                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-danger form-control" name="topup-button" id="topup-button">Bayar</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </section>
    <?php if (session()->getFlashdata('alert') !== null) {
    ?>
        <script>
            alert("<?= session()->getFlashdata('alert') ?>");
        </script>
    <?php
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php ?>