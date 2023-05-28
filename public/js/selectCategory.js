$(document).ready(function () {
  $('select[name="select-category"]').on('change', function () {
    $.ajax({
      type: 'POST',
      url: '/produk/pilih_kategori',
      data: {
        category: this.value,
      },
      cache: false,
      success: function (data) {
        $('#item-container').html(data);
      },
    });
  });
});
