<?= $this->extend('components/dalam/Layout') ?>

<?= $this->section('content') ?>

<?php helper('form');
$validation = \Config\Services::validation(); ?>
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="text-center mb-4">
          <?php if (empty($profile->fotoprofil) || $profile->fotoprofil == 'download.png') {
              echo '<img src="' . base_url('asset/images/profil/download.png') . '" class="mr-3 rounded-circle tahu" alt="User Avatar">';
            } else {
              echo '<img src="' . base_url('asset/images/profil/'.$profile->fotoprofil) . '"  class="mr-3 rounded-circle tahu" alt="User Avatar">';
              echo '<br><br><a href="'. base_url('profil/hpsfotoprofil//'. $profile->id).'" class="btn btn-sm btn-danger"
              onclick="return confirm(\'Anda yakin ingin hapus foto profil?\')">Hapus foto profil</a>';                  
            }
            ?>
            <br><br>
    
            <h5 class="mt-2">
              <?= $profile->fullname ?>
            </h5>
            <p class="text-muted">
              <?= $profile->username ?>
            </p>
          </div>

          <?= form_open_multipart("/profil/ubah-profil/" . $profile->id) ?>
          <?= csrf_field(); ?>
          <?= form_hidden('username', $profile->username) ?>
          <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="<?= $profile->username ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder=" <?= $profile->email ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="passbaru">Password baru</label>
            <input type="password" class="form-control <?= ($validation->hasError('passbaru')) ? 'is-invalid' : '' ?>"
              name="passbaru" id="passbaru" placeholder="">
            <div style="color: red; font-size: small;">
              <?= $validation->getError('passbaru') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="confpassbaru">Confirm Password baru</label>
            <input type="password"
              class="form-control <?= ($validation->hasError('confpassbaru')) ? 'is-invalid' : '' ?>"
              name="confpassbaru" id="confpassbaru" placeholder="">
            <div style="color: red; font-size: small;">
              <?= $validation->getError('confpassbaru') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="profile-image">Foto Profil</label>
            <input type="file" name="fotoprofil"
              class="form-control-file <?= ($validation->hasError('fotoprofil')) ? 'is-invalid' : '' ?>"
              id="profile-image">
            <div style="color: red; font-size: small;">
              <?= $validation->getError('fotoprofil') ?>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="<?= base_url('/profil/'. $profile->username) ?>" class="btn btn-warning">Kembali</a>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>