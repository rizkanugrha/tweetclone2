<?= $this->extend('components/dalam/Layout') ?>

<?= $this->section('content') ?>

<?php helper('form');
$validation = \Config\Services::validation(); ?>
<div class="row" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="col-md-6 offset-md-3 align-self-center">
        <div class="card">
            <div class="card-header bg-info">
                <strong>Tweet Baru</strong>
            </div>
            <div class="card-body">
                <?= form_open('/add') ?>
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="content" class="form-label">Tweet</label>
                    <textarea name="content" id="content"
                        class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : '' ?>"></textarea>
                    <div style="color: red; font-size: small;">
                        <?= $validation->getError('content') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <?= form_dropdown('category', $categories, '', 'class="form-select"') ?>
                </div>
                <div class="mb-3">
                    <label for="tweet-image">Foto Tweet</label>
                    <input type="file" name="fototweet"
                        class="form-control-file"
                        id="tweet-image">
                    <div style="color: red; font-size: small;">
                      
                    </div>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Tambah Tweet">
                    <a href="<?= previous_url() ?>" class="btn btn-warning">Kembali</a>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>