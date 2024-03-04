function BtnAddSave(elemento, classStore, classUpdate) {
    elemento.removeClass(classUpdate);
    elemento.addClass(classStore);
}
function BtnAddUpdate(elemento, classStore, classUpdate) {
    elemento.removeClass(classStore);
    elemento.addClass(classUpdate);
}