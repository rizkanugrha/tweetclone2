<?= $this->extend('components/dalam/Layout') ?>

<?= $this->section('content') ?>
<div class="row" style="margin: 30px 0px;">
    <div class="col-md-4">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <?php
                    if ($profile->fotoprofil == null) {
                        echo '<img src="' . base_url('asset/images/profil/download.png') . '" class="img-fluid rounded-start" alt="User Avatar">';
                    } else {
                        echo '<img src="' . base_url('asset/images/profil/' . $profile->fotoprofil) . '"  class="img-fluid rounded-start" alt="User Avatar">';

                    }
                    ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p>
                            <strong class="card-title">
                                <?= $profile->fullname ?>
                            </strong>
                            <small class="text-muted">@
                                <?= $profile->username ?>
                            </small>
                        </p>
                        <p class="card-text">
                            <a class="btn btn-info btn-sm" style="padding: 0.25rem 0.5rem; font-size: 0.7rem;"
                                href="<?= base_url('/add') ?>">Tweet Baru</a>
                            <a class="btn btn-info btn-sm" style="padding: 0.25rem 0.5rem; font-size: 0.7rem;"
                                href="<?= base_url('/profil/' . $profile->username) ?>">Profil </a>
                            <a class="btn btn-danger btn-sm" style="padding: 0.25rem 0.5rem; font-size: 0.7rem;"
                                href="<?= base_url('/logout') ?>">Logout</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item list-group-item-action active" aria-current="true">
                <strong>Kategori Tweet</strong>
            </div>
            <?php foreach ($categories as $key => $val): ?>
                <a href="<?= htmlentities(base_url('/category//' . $key), ENT_QUOTES) ?>"
                    class="list-group-item list-group-item-action <?= (current_url() == base_url('/category//' . $key)) ? 'link-primary' : '' ?>"
                    href="<?= base_url('/category//' . $key) ?>">
                    <?= $val ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-8">
        <!-- alert tambah twet -->
        <?php if (session()->getFlashdata('addtweet')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('addtweet') ?>
            </div>
        <?php endif; ?>
        <!-- tweet tambah alert akhir-->
        <!-- alert hapus -->
        <?php if (session()->getFlashdata('berhapus')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('berhapus') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('berhapusfot')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('berhapusfot') ?>
            </div>
        <?php endif; ?>
        <!-- akhir alert hapus-->
        <!-- awal alert edit-->
        <?php if (session()->getFlashdata('editsus')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('editsus') ?>
            </div>
        <?php endif; ?>
        <!-- akhir alert edit-->

        <h2>
            <?= $judul ?>
        </h2>

        <?php foreach ($tweets as $tweet) { ?>

            <div class="row" style="border-top: 1px solid #eee; padding-top: 10px; margin-bottom: 10px;">
                <div class="col-sm-2">
                    <?php
                    if (empty($tweet->fotoprofil)) {
                        echo '<img src="' . base_url('asset/images/profil/download.png') . '" class="img-thumbnail" alt="User Avatar">';
                    } else {
                        echo '<img src="' . base_url('asset/images/profil/' . $tweet->fotoprofil) . '"  class="img-thumbnail" alt="User Avatar">';
                    }
                    ?>
                </div>
                <div class="col-sm-10">
                    <h4>
                        <?= $tweet->fullname ?> <small>@
                            <?= $tweet->username ?>
                        </small>
                    </h4>
                    <div class="mb-3">
                        <?php
                        if (empty($tweet->fototweet)) {
                            echo $tweet->content;
                        } else {
                            echo $tweet->content;
                            echo '<br><br><img src="' . base_url('asset/images/tweets/' . $tweet->fototweet) . '"  class="figure-img img-fluid rounded" style="max-width:350px;">';
                        }
                        ?>
                    </div>
                    <div class="container-fluid">
                        <span>
                            <a href="<?= base_url('/category//' . $tweet->category) ?>">#<?= $tweet->category ?></a>
                            <small>
                                <?= $tweet->getCreatedAt() ?>
                            </small>
                        </span>
                        <?php
                        $sess = session();
                        $curUser = $sess->get('currentuser');
                        if ($curUser['userid'] == $tweet->user_id):
                            ?>
                            <span>
                                <a href="<?= base_url('/edit//' . $tweet->id) ?>" class="btn btn-sm btn-warning">E</a>
                                <a href="<?= base_url('/delete//' . $tweet->id) ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Anda yakin ingin hapus tweet?')">D</a>
                            </span>
                        <?php endif; ?>
                        <div></div>
                        <a class="card-link" href="#">
                            <i class="fa-heart far mt-icon-reaction"></i>
                            <div class="mt-counter likes-count d-inline-block">
                                <p>
                                    <?= $likeCounts[$tweet->id]; ?>
                                </p>
                            </div>
                        </a>
                        <a href="<?= base_url('/detail/' . $tweet->id) ?>" class="card-link"><i class="fas fa-comment"></i>
                            <?= $komenCounts[$tweet->id]; ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?= $this->endSection() ?>