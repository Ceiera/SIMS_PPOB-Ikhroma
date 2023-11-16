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
    <section id="transaction" class="padding-global">
        <div class="d-flex flex-column row-gap-5">
            <div class="d-flex flex-column row-gap-3">
                <h5 class="fw-bold">Semua Transaksi</h5>
            </div>
            <div class="form transaction d-flex flex-column gap-2 flex-grow-1">
                <div class="d-flex flex-column gap-2">
                    <?php
                    $count = $transaction;
                    if (count($count) > 0) {
                        foreach ($transaction as $key) {
                            if ($key->transaction_type == "TOPUP") {
                    ?>
                                <div class="border rounded-2 flex-grow-1 d-flex flex-row py-2 px-5 align-items-center justify-content-between">
                                    <div class="d-flex flex-column">
                                        <h5 class="fw-bold text-success"><span class="me-2">+</span>Rp. <?= number_format($key->total_amount, 0, '.', '.') ?></h5>
                                        <p class="text-secondary"><?php $date = new DateTime($key->created_on);
                                                                    echo $date->format('d M Y H:i') ?> WIB</p>
                                    </div>
                                    <div class="">
                                        <p class="text-secondary"><?= $key->description ?></p>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="border rounded-2 flex-grow-1 d-flex flex-row py-2 px-5 align-items-center justify-content-between">
                                    <div class="d-flex flex-column">
                                        <h5 class="fw-bold text-danger"><span class="me-2">-</span>Rp. <?= number_format($key->total_amount, 0, '.', '.') ?></h5>
                                        <p class="text-secondary"><?php $date = new DateTime($key->created_on);
                                                                    echo $date->format('d M Y H:i') ?> WIB</p>
                                    </div>
                                    <div class="">
                                        <p class="text-secondary"><?= $key->description ?></p>
                                    </div>
                                </div>
                    <?php
                            }
                        };
                    }
                    ?>
                </div>
                <a class="btn btn-disable fw-bold" style="text-decoration: none; color: red;" href=" <?= base_url('transaction/' . $page + 1) ?>">
                    Show More
                </a>
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