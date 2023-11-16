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