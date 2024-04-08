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
