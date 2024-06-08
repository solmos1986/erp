
$(document).ready(function () {
    $("#paginate_producto").hide();
    CargarProducto();
});
function CargarProducto() {
    $("#loader_producto").show();
    $("#paginate_producto").hide();
    ajax(`${base_url}/producto`, "GET").then((response) => {
        if (response.status == "1") {
            $("#loader_producto").hide();
            $("#paginate_producto").show();
            productos = response.data;
            stock = response.stock;
            renderCard();
        } else {
            SwallErrorValidate(response);
        }
    });
}
function renderCard() {
    $("#list_cards").html("");
    let cards = ``;
    productos.map((item, i) => {
        cards += `
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 mb-4 mb-lg-0" >
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface" >
                                        <img src="${base_url}/imagenes/productos/${item.imagenProducto}"
                                            class="w-100" />
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                    <div>
                                        <h5 class="">${item.nomProducto}</h5>
                                    </div>
                                    <div class="text-truncate">
                                       
                                    </div>
                                    <div class="text-truncate">
                                        ${item.resumen}
                                    </div>
                                    <a href='#'>Ver mas...</a>
                                </div>
                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 border-sm-start-none border-start ">
                                    <div class="d-flex flex-row justify-content-center align-items-center mb-0">
                                        <h5 class="me-1">${item.precioVenta} Bs</h5>
                                    </div>
                                    <div class="d-flex flex-row justify-content-center align-items-center mb-0">
                                       <h5 class="me-1">Stock: ${item.stock}</h5>
                                    </div>
                                    <div class="d-flex flex-column mt-4">
                                        <button data-id="${i}" class="addCart btn btn-outline-primary btn-sm mt-2 " type="button">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
    });
    $("#list_cards").append(cards);
}