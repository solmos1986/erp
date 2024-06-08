function salto_linea(texto) {
    const nuevo_texto = texto.replace(/(\r\n|\n|\r)/gm, "<br>")
    return nuevo_texto;
}
function redondeo(valor) {
    return parseFloat(valor).toFixed(2);
}