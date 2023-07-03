$(document).ready(function () {
  $('.reply-btn').click(function (e) {
    e.preventDefault();
    $(this).siblings('.reply-form').toggle();
  })
})