$(document).ready(function () {
  $('input[name="search-key"]').keyup(function () {
    const item = this.getAttribute('id').split('-')[0];
    $.ajax({
      type: 'POST',
      url: `/${item}/cari_${item}`,
      data: {
        keyword: this.value,
        view: this.getAttribute('id').split('-')[2] != undefined ? this.getAttribute('id').split('-')[2] : '',
      },
      cache: false,
      success: function (data) {
        $('#item-container').html(data);
      },
    });
  });
});
