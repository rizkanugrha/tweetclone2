<?= $this->extend('components/dalam/Layout') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
  <div class="row justify-content-center">
  <?php if (session()->getFlashdata('berhapusfotpr')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('berhapusfotpr') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('psnpass')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('psnpass') ?>
            </div>
        <?php endif; ?>
        
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="text-center mb-4">
            <?php if (empty($profile->fotoprofil)) {
              echo '<img src="' . base_url('asset/images/profil/download.png') . '" class="mr-3 rounded-circle tahu" alt="User Avatar">';
            } else {
              echo '<img src="' . base_url('asset/images/profil/'.$profile->fotoprofil) . '"  class="mr-3 rounded-circle tahu" alt="User Avatar">';
            }
            ?>

            <h5 class="mt-2">
              <?= $profile->fullname ?>
            </h5>
            <p class="text-muted">
              <?= $profile->username ?>
            </p>
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="<?= base_url('/profil/ubah-profil/' . $profile->username) ?>"
                class="text-dark">Ubah Profil</a></li>
          </ul>
          <a href="<?= base_url('/') ?>" class="btn btn-warning">Kembali</a>

        </div>
      </div>
    </div>
  </div>
</div>
<br><br>
<br><br>
<br><br>


<?= $this->endSection() ?>