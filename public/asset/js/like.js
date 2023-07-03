$(document).ready(function() {
    $('.like-button').click(function(e) {
      e.preventDefault(); // Prevent default link behavior

      var button = $(this);
      var tweetId = button.data('tweet-id');
      var userId = button.data('user-id');

      $.ajax({
        url: '<?= base_url('/addlike/') ?>' + tweetId + '/' + userId,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            var likeCountElement = $('#like-count-' + tweetId);
            var likeCount = parseInt(likeCountElement.text());
            var newLikeCount = response.isLiked ? likeCount + 1 : likeCount - 1;
            likeCountElement.text(newLikeCount);
            button.toggleClass('liked');
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });
  });