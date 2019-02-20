var Functions = {
  showImage: function () {
    $('#captcha-content').addClass('hide');
    $('#image-content').removeClass('hide');

    $('#button-send').addClass('hide');
    $('#button-close').removeClass('hide');
  },
  showCaptcha: function () {
    $('#captcha-content').removeClass('hide');
    $('#image-content').addClass('hide');

    $('#button-close').addClass('hide');
    $('#button-send').removeClass('hide');
  }
};

$(function () {
  $('.node').click(function () {
    $('#node-number').val(this.dataset.number);
    $('#exampleModalLabel>span').text(this.dataset.number);
    Functions.showCaptcha();
    if (typeof grecaptcha == 'object') {
      grecaptcha.reset();
    }

    $('#exampleModal').modal();
    return false;
  });

  $('#button-send').click(function () {
    $.ajax({
      type: 'POST',
      url: '/get-image',
      data: $('#image-form').serialize(),
      dataType: 'json',
      beforeSend: function() {
        $('#exampleModal .overlay').removeClass('hide');
      },
      complete: function() {
        $('#exampleModal .overlay').addClass('hide');
      },
      success: function (json) {
        if (json.success) {
          if (json.image) {
            $('#image-content > img').attr('src', json.image);
            Functions.showImage();
          } else {
            //...
          }
        } else {
          if (json.errorMsg) {
            alert(json.errorMsg);
          }
        }
      },
    });
  });
});