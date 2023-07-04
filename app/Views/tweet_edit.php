<?= $this->extend('components/dalam/Layout') ?>


<?= $this->section('content') ?>
<?php helper('form');
$validation = \Config\Services::validation(); ?>
<div class="row" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="col-md-6 offset-md-3 align-self-center">
        <div class="card">
            <div class="card-header bg-info">
                <strong>Edit Tweet</strong>
            </div>
            <div class="card-body">
                <?= form_open_multipart("/edit/{$data['id']}") ?>
                <?= csrf_field(); ?>
                <?= form_hidden('id', $data['id']) ?>
                <div class="mb-3">
                    <label for="content" class="form-label">Tweet</label>
                    <textarea name="content" id="content"
                        class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : '' ?>"><?= old($data['content']) ? old($data['content']) : $data['content']; ?></textarea>
                    <div style="color: red; font-size: small;">
                        <?= $validation->getError('content') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <?= form_dropdown('category', $data['categories'], "pendidikan", 'class="form-select"') ?>
                </div>
                <div class="mb-3">
                    <label for="tweet-image">Foto Tweet</label>
                    <input type="file" name="fototweet"
                        class="form-control-file <?= ($validation->hasError('fototweet')) ? 'is-invalid' : '' ?>"
                        id="tweet-image">
                    <div style="color: red; font-size: small;">
                        <?= $validation->getError('fototweet') ?>
                    </div>
                    <div id="tweet-image-preview">
                        <?php if (isset($data['fototweet']) && !empty($data['fototweet'])){
                            echo '<br><br><img src="' . base_url('asset/images/tweets/' .$data['fototweet']) . '" style="max-width:100px;">';
                        } ?>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Edit Tweet">
                    <a href="<?= previous_url() ?>" class="btn btn-warning">Kembali</a>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>