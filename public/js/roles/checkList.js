//render
function renderSuperModulos() {
    $('#form_rol #rol_id').val(data.rol_id);
    $('#form_rol #nombre_rol').val(data.nombre_rol);
    let HTML = ``;
    data.super_modulos.map((super_modulo, i) => {
        HTML += `
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-1 shadow-none border">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check mb-2 form-check-primary">
                                    <input class="form-check-input" type="checkbox" data-name="super_modulo" data-id="${super_modulo.super_modulo_id}" id="super_modulo${i}" ${super_modulo.validate ? 'checked' : ''}>
                                    <label class="form-check-label text-uppercase header-title font-12" for="super_modulo${i}">${super_modulo.nombre_super_modulo}</label>
                                </div>
                                ${renderModulos(super_modulo.modulos)}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    })
    $('#super_modulo').html('');
    $('#super_modulo').append(HTML);
}
function renderModulos(modulos) {
    let HTML = ``;
    modulos.map((modulo, i) => {
        HTML += `
            <div class="row" style="padding-left: 30px;">
                <div class="col-md-12">
                    <div class="form-check mb-2 form-check-primary">
                        <input class="form-check-input" type="checkbox" data-name="modulo" data-id="${modulo.modulo_id}" id="modulo${i}" ${modulo.validate ? 'checked' : ''}>
                        <label class="form-check-label" for="modulo${i}" >${modulo.nombre_modulo}</label>
                    </div>
                    <div class="row" style="padding-left: 30px;">
                        ${renderSubModulos(modulo.sub_modulos)}            
                    </div>
                </div>
            </div>
        `;
    })
    return HTML;
}
function renderSubModulos(sub_modulos) {
    let HTML = ``;
    sub_modulos.map((sub_modulo, i) => {
        HTML += `
            <div class="col-md-12">
                <div class="form-check mb-2 form-check-primary">
                    <input class="form-check-input" type="checkbox" data-name="sub_modulo" data-id="${sub_modulo.sub_modulo_id}" id="sub_modulo${i}" ${sub_modulo.validate ? 'checked' : ''}>
                    <label class="form-check-label" for="sub_modulo${i}">${sub_modulo.nombre_sub_modulo}</label>
                </div>
            </div>
        `;
    });
    return HTML;
}

$(document).on('change', '#form_rol .form-check-input', function () {
    if (this.checked) {
        if ($(this).data('name') == 'super_modulo') {
            listCheck($(this).data('name'), $(this).data('id'), true)
        }
        if ($(this).data('name') == 'modulo') {
            listCheck($(this).data('name'), $(this).data('id'), true)
        }
        if ($(this).data('name') == 'sub_modulo') {
            listCheck($(this).data('name'), $(this).data('id'), true)
        }
    } else {
        if ($(this).data('name') == 'super_modulo') {
            listCheck($(this).data('name'), $(this).data('id'), false)
        }
        if ($(this).data('name') == 'modulo') {
            listCheck($(this).data('name'), $(this).data('id'), false)
        }
        if ($(this).data('name') == 'sub_modulo') {
            listCheck($(this).data('name'), $(this).data('id'), false)
        }
    }
    console.log(data.super_modulos)
});

function listCheck(nivel, id, valor) {
    data.super_modulos.map((super_modulo) => {
        if (nivel == 'super_modulo') {
            if (super_modulo.super_modulo_id == id) {
                super_modulo.validate = valor;
            }
        }
        super_modulo.modulos.map((modulo) => {
            if (nivel == 'modulo') {
                if (modulo.modulo_id == id) {
                    modulo.validate = valor;
                }
            }
            modulo.sub_modulos.map((sub_modulo) => {
                if (nivel == 'sub_modulo') {
                    if (sub_modulo.sub_modulo_id == id) {
                        sub_modulo.validate = valor;
                    }
                }
            })
        })
    })
}
