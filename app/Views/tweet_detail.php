<?= $this->extend('components/komen/Layout') ?>

<?= $this->section('content') ?>

<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2 mt-5">
      <!-- Post -->
      <?php if (session()->getFlashdata('errorkom')): ?>
        <div class="alert alert-danger">
          <?php
          $errorMessages = session()->getFlashdata('errorkom');
          if (is_array($errorMessages)) {
            foreach ($errorMessages as $errorMessage) {
              echo $errorMessage . '<br>';
            }
          } else {
            echo $errorMessages;
          }
          ?>
        </div>
      <?php endif; ?>
      <div class="card mb-3">
        <div class="card-body">
          <div class="media">
            <?php if (empty($data['fotoprofil'])) {
              echo '<img src="' . base_url('asset/images/download.png') . '" class="mr-3 rounded-circle tahu" alt="User Avatar">';
            } else {
              echo '<img src="' . base_url('asset/images/' . $data['fotoprofil']) . '"  class="mr-3 rounded-circle tahu" alt="User Avatar">';
            }
            ?>
            <div class="media-body">
              <h6 class="mt-0">
                <?= $data['fullname']; ?>
              </h6>
              <small>@
                <?= $data['username']; ?>
              </small>
              <p>
                <?= $data['content']; ?>
              </p>

              <a href="#" class="card-link"><i class="fas fa-comment"></i>
                <?= isset($data['komenCounts']) ? strval($data['komenCounts']) : '0'; ?>
              </a>

              <a class="card-link like-button"
                href="<?= base_url('/addlike/' . $data['id'] . '/' . $data['user_id']) ?>">
                <i class="fa-heart far mt-icon-reaction"></i>
                <div class="mt-counter likes-count d-inline-block">
                  <p>
                    <?= $data['likeCounts']; ?>
                  </p>
                </div>
              </a>

            </div>
          </div>
          <hr>
          <!-- Comments -->
          <div class="comments">
            <?php foreach ($data['komentar'] as $comment): ?>
              <div class="media">
                <?php if (empty($comment['fotoprofil'])) {
                  echo '<img src="' . base_url('asset/images/download.png') . '" class="mr-3 rounded-circle tahu2" alt="User Avatar">';
                } else {
                  echo '<img src="' . base_url('asset/images/' . $comment['fotoprofil']) . '"  class="mr-3 rounded-circle tahu2" alt="User Avatar">';
                }
                ?>
                <div class="media-body">
                  <h6 class="mt-0">
                    <?= $comment['fullname'] ?>
                  </h6>
                  <small>@
                    <?= $comment['username']; ?>
                  </small>

                  <p>
                    <?= $comment['komentar'] ?>
                  </p>
                  <a href="#" class="btn btn-sm btn-link reply-btn"><i class="fas fa-reply"></i> Reply </a>
                  <!-- Reply Form --><br><br>
                  <div class="reply-form mt-3" style="display: none;">
                    <?php
                    helper('form');
                    $validation = \Config\Services::validation();
                    ?>
                    <?= form_open("/addreply/{$comment['id']}") ?>
                    <div class="mb-3">
                      <textarea name="replies" id="replies"
                        class="form-control <?= ($validation->hasError('replies')) ? 'is-invalid' : '' ?>"></textarea>
                      <?php if ($validation->hasError('replies')): ?>
                        <div class="invalid-feedback">
                          <?= $validation->getError('replies') ?>
                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="mb-3">
                      <input type="submit" class="btn btn-primary" value="Reply">
                    </div>
                    <?= form_close() ?>
                  </div>
                  <!-- End Reply Form -->
                  <!-- Nested Comments -->
                  <?php if (isset($replyData[$comment['id']])): ?>
                    <?php foreach ($replyData[$comment['id']] as $reply): ?>
                      <div class="nested-comments">
                        <div class="media">
                          <?php if (empty($reply['fotoprofil'])) {
                            echo '<img src="' . base_url('asset/images/download.png') . '" class="mr-3 rounded-circle tahu3" alt="User Avatar">';
                          } else {
                            echo '<img src="' . base_url('asset/images/' . $reply['fotoprofil']) . '"  class="mr-3 rounded-circle tahu3" alt="User Avatar">';
                          }
                          ?>
                          <div class="media-body">
                            <h6 class="mt-0">
                              <?= $reply['fullname'] ?>
                            </h6>
                            <small>@
                              <?= $reply['username'] ?>
                            </small>
                            <p>
                              <?= $reply['replies'] ?>
                            </p>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  <!-- End of Nested Comments -->

                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <?php
          helper('form');
          $validation = \Config\Services::validation();
          ?>
          <div class="form-group">
            <?= form_open("/addkomens/{$data['id']}") ?>
            <div class="mb-3">
              <label for="komentar" class="form-label">Komentar:</label>
              <textarea name="komentar" id="komentar"
                class="form-control <?= ($validation->hasError('komentar')) ? 'is-invalid' : '' ?>"></textarea>
              <div style="color: red; font-size: small;">
                <?= $validation->getError('komentar') ?>
              </div>
            </div>
            <div class="mb-3">
              <input type="submit" class="btn btn-primary" value="Tambah Komentar">
            </div>
            <?= form_close() ?>
          </div>





        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>