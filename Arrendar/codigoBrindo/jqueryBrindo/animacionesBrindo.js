// se deja cargado el evento cuando se hace el evento load, es decir, cuando se carga la página
$(window).on("load", function() {
    $(window).scroll(function() {
        var windowBottom = $(this).scrollTop() + $(this).innerHeight();
        $(".why-us-header-icon").each(function() {
            /* La clase why-us-header-icon es del icono en la carta */
            var objectBottom = $(this).offset().top + $(this).outerHeight();
            // si se hace scroll hacia abajo se le sube la opacidad (aparece)
            if (objectBottom < windowBottom) {
                if ($(this).css("opacity") == 0) { $(this).fadeTo(500, 1); }
            }
            // si se hace scroll hacia arriba se le baja la opacidad (desaparece)            
            else {
                if ($(this).css("opacity") == 1) { $(this).fadeTo(500, 0); }
            }
        });
    }).scroll(); //Se invoca la función al hacer scroll
});