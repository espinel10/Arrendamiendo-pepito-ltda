window.onload = function() {


    // creamos el objeto audio cuando se carga la página
    var audioElement = document.createElement('audio');
    // indicamos el archivo de audio a cargar la ruta
    audioElement.setAttribute('src', './datosBrindo/audiosBrindo/click.mp3');

    // id en el cuerpo
    document.getElementById("brindo-song").addEventListener("click", function() {
        // Si deseamos que inicie siempre desde el principio
        // iniciamos el audio
        audioElement.play();
    });

    // document.getElementById("pause").addEventListener("click", function() {
    //     // hacemos pausa
    //     audioElement.pause();
    // });
};