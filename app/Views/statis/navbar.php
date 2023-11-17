<header>
    <nav class="d-flex navbar navbar-expand-lg padding-global py-2 mb-4 border-bottom">
      <a class="d-flex align-items-center navbar-brand fw-bold" href="<?= base_url('dashboard')?>"><span class="me-2"><img src="<?= base_url('public/assets') ?>/Logo.png" alt="" /></span><span>SIMS PPOB</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item me-5">
            <a class="nav-link fw-bolder" href="<?= base_url('topup')?>">Top Up</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link fw-bolder" href="<?= base_url('transaction')?>">Transaction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bolder" href="<?= base_url('account')?>">Akun</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>