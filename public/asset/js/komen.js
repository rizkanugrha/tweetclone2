$(document).ready(function () {
  $('#formKomentar').submit(function (e) {
    e.preventDefault();

    var komentar = $('#komentar').val();
    var tweetId = $('#tweetId').val();
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: '<?php echo base_url('/addkomens/') ?>' + tweetId,
      type: 'POST',
      data: {
        _token: token,
        komentar: komentar,
        tweet_id: tweetId
      },
      success: function (response) {
        // Tanggapan dari server setelah berhasil menambahkan komentar
        // Lakukan manipulasi DOM untuk menampilkan komentar baru tanpa perlu me-refresh halaman
        var newComment = `
        <div class="media">
          <img src="<?= base_url('asset/images/avatar.jpg'); ?>" class="mr-3 rounded-circle" alt="User Avatar" style="width: 50px; height: 50px;">
          <div class="media-body">
            <h6 class="mt-0">${response.username}</h6>
            <p>${response.komentar}</p>
            <a href="#" class="btn btn-sm btn-link"><i class="fas fa-reply"></i> Reply</a>
          </div>
        </div>
      `;
        $('.comments').append(newComment);

        // Setel input komentar kembali ke nilai awal
        $('#komentar').val('');
      },
      error: function (xhr, status, error) {
        // Tanggapan dari server jika terjadi kesalahan
        console.log(xhr.responseText);
      }
    })
  })
})