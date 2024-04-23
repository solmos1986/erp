function ajax(url, method, data = {}) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            type: method,
            url: url,
            data: data,
            dataType: 'json',
            success: function (response) {
                response = response;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                error_status(jqXHR)
            },
            fail: function () {
                fail()
            }
        }).done(resolve).fail(reject);
    });
}

function ajaxFormData(url, method, formData = {}) {
    return new Promise(function (resolve, reject) {

        $.ajax({
            async: true,
            type: method,
            url: url,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
                response = response;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                error_status(jqXHR)
            },
            fail: function () {
                fail()
            }
        }).done(resolve).fail(reject);
    });
}
