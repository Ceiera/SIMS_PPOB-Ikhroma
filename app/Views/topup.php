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
    <link rel="stylesheet" href="<?= base_url('public/css') ?>/dashboard.css" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
</head>

<body>
    <?= $this->include('statis/navbar') ?>
    <?= $this->include('statis/profilebalance') ?>
    <section id="topup" class="padding-global">
        <div class="d-flex flex-column row-gap-5">
            <div class="d-flex flex-column row-gap-3">
                <h5>Silahkan Masukkan,</h5>
                <h5 class="fw-bold">Nominal Top Up</h5>
            </div>
            <div class="form topup d-flex flex-row gap-2">
                <div class="d-flex flex-column flex-grow-1">
                    <?= form_open('topup') ?>
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white" id="basic-addon"><i class="bi bi-cash"></i></span>
                        <input type="number" class="form-control border-start-0" placeholder="Masukkan Nominal Top Up" aria-label="nilai" aria-describedby="basic-addon" value="0" name="nilai" id="nilai" required min="10000" max="1000000" />
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" disabled class="btn btn-secondary form-control" name="topup-button" id="topup-button">Top Up</button>
                    </div>
                    <?= form_close() ?>
                </div>
                <div class="d-flex flex-wrap justify-content-between gap-2" style="width: 40%;">
                    <div class="btn nominal-topup border border-2 " style="width: 120px;" value="10">Rp. 10.000</div>
                    <div class="btn nominal-topup border border-2 " style="width: 120px;" value="20">Rp. 20.000</div>
                    <div class="btn nominal-topup border border-2 " style="width: 120px;" value="50">Rp. 50.000</div>
                    <div class="btn nominal-topup border border-2 " style="width: 120px;" value="100">Rp. 100.000</div>
                    <div class="btn nominal-topup border border-2 " style="width: 120px;" value="250">Rp. 250.000</div>
                    <div class="btn nominal-topup border border-2 " style="width: 120px;" value="500">Rp. 500.000</div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let topUp = document.getElementById("nilai");
        let topUpButton = document.getElementById("topup-button");
        const checkValue = (nilai) => {
            let value = parseInt(nilai);
            if (value >= 10000 && value <= 1000000) {
                topUpButton.disabled = false;
                topUpButton.classList.remove('btn-secondary');
                topUpButton.classList.add('btn-danger');
            } else {
                topUpButton.disabled = true;
                topUpButton.classList.remove('btn-danger');
                topUpButton.classList.add('btn-secondary');
            }
        }
        topUp.addEventListener("change", () => {
            checkValue(topUp.value);
        });
        topUp.addEventListener("keyup", () => {
            checkValue(topUp.value);
        });
        let nominalTopUp = document.getElementsByClassName("nominal-topup");
        for (let i = 0; i < nominalTopUp.length; i++) {
            nominalTopUp[i].addEventListener("click", () => {
                let value = nominalTopUp[i].getAttribute("value") * 1000;
                let total = 0 + parseInt(topUp.value) + value;
                topUp.value = total;
                checkValue(topUp.value);
            })
        }
    </script>
    <?php if (session()->getFlashdata('alert')!==null) {
        ?>
        <script>
            alert("<?= session()->getFlashdata('alert') ?>");
        </script>
        <?php
    }?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php ?>