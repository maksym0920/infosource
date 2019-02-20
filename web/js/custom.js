$(function () {
  $('.node').click(function () {
    $('#node-number').val(this.dataset.number);
    $('#exampleModalLabel>span').text(this.dataset.number);

    if(typeof grecaptcha == 'object') {
      grecaptcha.reset();
    }

    $('#exampleModal').modal();
    return false;
  });

  $('#button-send').click(function () {
    $.ajax({
      type: 'POST',
      url: '/get-image',
      data: {},
      dataType: 'json',
      success: function(json) {
      },
    });
  });
});