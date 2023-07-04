<?= $this->extend('components/Layout') ?>

<?= $this->section('content') ?>
<?php
helper('form');
$validation = \Config\Services::validation();
?>

<div class="row" style="margin-top: 100px; margin-bottom: 100px;">
    <!-- Awal koding tambahan notifikasi -->
    <!--  awal notif register -->
    <?php if (session()->getFlashdata('pesan')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan') ?>
        </div>
    <?php endif; ?>
    <!-- akhir notif register -->

    <!-- notif logut -->
    <?php
    $sess = session();
    if ($sess->get('logout') == 'success') {
        echo '<div class="alert alert-success" role="alert">
            Berhasil logout. Silahkan login kembali.
            </div>';
    }

    $err_login = $sess->get('login_error');
    if ($err_login) {
        echo '<div class="alert alert-danger" role="alert">
            ' . $err_login . '
            </div>';
    }
    ?>
    <?php if (session()->getFlashdata('succespass')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('succespass') ?>
        </div>
    <?php endif; ?>
    <!-- Akhir koding tambahan notifikasi -->
    <div class="col-md-6 offset-md-3 align-self-center">
        <div class="card">
            <div class="card-header text-white bg-dark">
                <strong>Form Login</strong>
            </div>
            <div class="card-body">
                <?= form_open('/login') ?>
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="username"
                        class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                        name="username" id="username" placeholder="username"
                        value="<?= stripslashes(htmlentities(set_value('username'), ENT_QUOTES)) ?>">
                    <div style="color: red; font-size: small;"> <?= $validation->getError('username') ?> </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                        class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                        name="password" id="password" placeholder="password">
                    <div style="color: red; font-size: small;"> <?= $validation->getError('password') ?> </div>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Login">
                    <a href="<?= base_url('/lupa-password') ?>" class="card-link">Lupa Password</a>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>