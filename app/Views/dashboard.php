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
  <section id="kategori" class="mb-5 padding-global">
    <div class="d-flex flex-wrap align-content-start column-gap-5">
      <?php
      foreach ($services as $key) {
      ?>
        <a href="<?= base_url('service/' . $key->service_code)?>" style="text-decoration: none; color: black;">
          <div class="d-flex flex-column gap-2 align-items-center">
            <img src="<?= $key->service_icon ?>" alt="" />
            <h6 class="text-center" style="width: 70px; font-size: smaller;"><?= $key->service_name ?></h6>
          </div>
        </a>
      <?php
      }
      ?>

    </div>
  </section>
  <section id="promo">
    <div class="d-flex flex-column">
      <p class="fw-bold text-black padding-global">Temukan promo menarik</p>
      <div class="slider padding-promo">
        <div class="carousel" data-flickity='{ "freeScroll": true, "prevNextButtons" : false, "pageDots":false,"contain":true }'>
          <?php
          foreach ($banners as $key) {
          ?>
            <div class="carousel-cell"><img src="<?= $key->banner_image ?>" alt=""></div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>

</html>
<?php ?>