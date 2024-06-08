var asientos = [];

$(document).ready(function () {
    actualizarAsientos()
});
function actualizarAsientos() {
    ajax(
        `${base_url}/asiento-frecuente/${$("#idMetodoPago").find(":selected").val()}`,
        "GET"
    ).then((response) => {
        asientos = response.data;
        render()
    });
}
function render() {
    let asientoHTML = ``;
    const total = $("#TotalCart").text()
    $('#table_frecuente_body').html('');
    asientos.map((row) => {
        asientoHTML += `
        <tr>
            <td>
                <input type="number" name="numero_cuenta[]"
                    class="form-control form-control-sm" placeholder="numero cuenta"
                    value="${row.codigo_cuenta}">
            </td>
            <td>
                <input type="text" name="cuenta[]"
                    class="form-control form-control-sm" placeholder="cuenta"
                    value="${row.nombre_cuenta}">
            </td>
            <td>
                <input type="number" name="debe[]"
                    class="form-control form-control-sm" placeholder="debe"
                    value="${redondeo(row.debe * total)}">
            </td>
            <td>
                <input type="number" class="form-control form-control-sm"
                    name="haber[]" placeholder="haber"
                    value="${redondeo(row.haber * total)}">
            </td>
        </tr>
        `;
    })
    $('#table_frecuente_body').append(asientoHTML);
    return asientoHTML;
}
$(document).on('change', '#idMetodoPago', function () {
    actualizarAsientos()
});

$(document).on('keyup change', '.precio, .cantidad', function () {
    render()
})
$(document).on('click', '.addCart', function () {
    render()
})