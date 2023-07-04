<?= $this->extend('components/Layout') ?>

<?= $this->section('content') ?>
<?php
helper('form');

$validation = \Config\Services::validation(); ?>
<div class="row" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="col-md-6 offset-md-3 align-self-center">
    <?php if (session()->getFlashdata('ssendlink')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('ssendlink') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errsendlink')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('errsendlink') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('tokennot')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('tokennot') ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header text-light bg-dark">
                <strong>Form Lupa Password</strong>
            </div>
            <div class="card-body">
                <?= form_open('/lupa-password/sendlink') ?>
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                        name="email" value="<?= stripslashes(htmlentities(set_value('email'), ENT_QUOTES)) ?>" id="email"
                        placeholder="abc@zxc.vom">
                    <div style="color: red; font-size: small;">
                        <?= $validation->getError('email') ?>
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