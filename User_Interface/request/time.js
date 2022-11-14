$('.boxs').on('change', function (e) {
    if ($('.boxs:checked').length > 1) {
        $(this).prop('checked', false);
    }
  });