<?= $this->extend('components/Layout') ?>

<?= $this->section('content') ?>
<?php
helper('form');

$validation = \Config\Services::validation(); ?>
<div class="row" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="col-md-6 offset-md-3 align-self-center">
        <div class="card">
            <div class="card-header text-light bg-dark">
                <strong>Form Lupa Password</strong>
            </div>
            <div class="card-body">
                <?= form_open('/lupa-password/ganti-password') ?>
                <?= csrf_field(); ?>
                <?= form_hidden('token', $token) ?>
                <div class="mb-3">
                    <label for="barupass">Password baru</label>
                    <input type="password"
                        class="form-control <?= ($validation->hasError('barupass')) ? 'is-invalid' : '' ?>"
                        name="barupass" id="barupass" placeholder="">
                    <div style="color: red; font-size: small;">
                        <?= $validation->getError('barupass') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="conbarupass">Confirm Password baru</label>
                    <input type="password"
                        class="form-control <?= ($validation->hasError('conbarupass')) ? 'is-invalid' : '' ?>"
                        name="conbarupass" id="conbarupass" placeholder="">
                    <div style="color: red; font-size: small;">
                        <?= $validation->getError('conbarupass') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Ganti password">
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>