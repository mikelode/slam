var random_array = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);

function generarTeclado() {

    var aux = 0;
    var swpIdx = 0;

    for (var i = 0; i < 10; i ++ ) {
        swpIdx = Math.ceil(Math.random() * 9);
        aux = random_array[swpIdx];
        random_array[swpIdx] = random_array[i];
        random_array[i] = aux;
    }

    for (var i = 0; i < 10; i ++) {
        eval("document.forms[0].tecla_" + i + ".value='" + random_array[i] + "';");
    }

}

function pulsaTecla(tecla, longitud, texto) {

    if (tecla == -1) {
        texto.value = '';
        return;
    }

    if (texto.value.length >= longitud) {
        return;
    }

    texto.value += random_array[tecla];

}