const BASE_URL = $("#base-url").val();
function ajaxPost(url , data, button = null, typeErrorNotification = 'sweetError') {

    if (button !== null) {
        var valButton = $(button).html();
    }

    var ajax = $.ajax({
        type: 'post',
        url: url,
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        beforeSend: function () {
            if (button !== null) {
                $(button).empty().append(loadingSpiner).prop('disabled', true).css('cursor', 'wait');
            }
        },
        complete: function () {
            // on complate
        }
    }).done(function (response) {
        // write your script

    }).fail(function (response) {
        let res = response.responseJSON;

        if (res.errors || res.invalid) {
            new handleValidation(res.errors||res.invalid);
        } else if(res.message !== undefined) {
            if (typeErrorNotification == 'sweetError') {
                sweetError(res.message);
            }

            if (typeErrorNotification == 'toastError') {
                toastError(res.message);
            }

            if (typeErrorNotification == 'snackbarError') {
                snackbarError(res.message)
            }

            if (typeErrorNotification == 'snackbar') {
                snackbar(res.message);
            }
        } else {
            if (typeErrorNotification == 'sweetError') {
                sweetError('There is an error');
            }

            if (typeErrorNotification == 'toastError') {
                toastError('There is an error');
            }

            if (typeErrorNotification == 'snackbarError') {
                snackbarError('There is an error')
            }

            if (typeErrorNotification == 'snackbar') {
                snackbar('There is an error');
            }
        }

    }).always(function () {
        if (button !== null) {
            $(button).empty().append(valButton).prop('disabled', false).css('cursor', 'auto');
        }
    });

    return ajax;
}

function handleValidation(messages) {
    // reset before looping
    $('.invalid-feedback').remove();
    for (let i in messages) {
        for (let t in messages[i]) {
            $('[name=' + i + ']').addClass('is-invalid').parent().append('<div class="text-left invalid-feedback order-3">' + messages[i][t] + '</div>');
        }

        // remove message if event key press
        $('[name=' + i + ']').keypress(function () {
            $('[name=' + i + ']').removeClass('is-invalid');
        });

        // remove message if event change
        $('[name=' + i + ']').change(function () {
            $('[name=' + i + ']').removeClass('is-invalid');
        });
    }
}

function resetValidation() {
    $(".form-control").removeClass("is-invalid");
    $(".form-select").removeClass("is-invalid");
}

$(document).on('keyup', '.convert-currency', function () {
    $(this).val(formatRupiah(this.value, "Rp ", false));
})

function formatRupiah(angka, prefix, decimalRound = true) {
    if (typeof angka == "number") {
        if (prefix != undefined && decimalRound == true) {
            angka = Math.round(angka);
        }
        angka = angka.toFixed(2)
        rupiah = new Intl.NumberFormat('de-DE').format(angka)
        if (prefix != undefined && decimalRound == true) {
            return prefix == undefined ? rupiah + ",00" : rupiah ? "Rp " + rupiah + ",00" : "";
        } else {
            return prefix == undefined ? rupiah : rupiah ? "Rp " + rupiah : "";
        }
    } else {
        var number_string = angka.toString().replace(/[^,\d]/g, ""),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + (split[1].substr(0, 2) != "00" ? "," + split[1].substr(0, 2) : "") : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp " + rupiah : "";
    }
}

function reverseFormatRupiah(angka) {
    angka = angka.toString().replace(/[^,\d]/g, "")
    angka = angka.replace(',', ".")
    return angka;
}

function resetValidationFile() {
	$(".dropify").change(function () {
		if ($(".dropify-wrapper").hasClass("error")) {
			$(".dropify-wrapper").removeClass("error");
			$(".dropify-error").empty();
		}
	});
}
