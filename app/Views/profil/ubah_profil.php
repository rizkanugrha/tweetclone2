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
            <img src="<?= base_url('asset/images/download.png'); ?>" class="mr-3 rounded-circle tahu2"
              alt="User Avatar">
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
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>