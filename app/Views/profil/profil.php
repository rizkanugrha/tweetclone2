<?= $this->extend('components/dalam/Layout') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="text-center mb-4">
            <?php if (empty($profile->fotoprofil)) {
              echo '<img src="' . base_url('asset/images/download.png') . '" class="mr-3 rounded-circle tahu2" alt="User Avatar">';
            } else {
              echo '<img src="' . base_url('asset/images/'.$profile->fotoprofil) . '"  class="mr-3 rounded-circle tahu2" alt="User Avatar">';
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
            <li class="list-group-item"><a href="#" class="text-dark">Bookmark</a></li>
            <li class="list-group-item"><a href="#" class="text-dark">Tweet Saya</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br>
<br><br>
<br><br>


<?= $this->endSection() ?>