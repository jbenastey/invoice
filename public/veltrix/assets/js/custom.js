$(document).ready(function () {
    $('.dropify').dropify();

    var root = window.location.origin + '/invoice/public/';

    $('#id_produk').change(function (){
        const $option = $(this).find('option:selected');
        const value = $option.val();
        const text = $option.text();

        $.ajax({
            url: root + 'get-product/'+value,
            type: 'GET',
            async: true,
            cache: false,
            dataType: 'json',
            success: function (response) {
                $("#jumlah").attr('maxlength',response.stok);
                $("#harga").attr('value',response.harga);
            },
            error: function (response) {
                console.log(response.status + 'error');
            }
        })
    })
})
