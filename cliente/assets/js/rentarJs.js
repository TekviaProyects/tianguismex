function prueba(a) {
    var t = a.id,
        o = "#" + t,
        n = $(o);
    "white" == n.attr("fill") ? (n.attr("fill", "#2196F3"), map[t] = t) : "#2196F3" == n.attr("fill") && (n.attr("fill", "white"), delete map[t])
}

function fix() {
    var a = this,
        t = a.parentNode,
        o = a.nextSibling;
    t.removeChild(a), setTimeout(function() {
        t.insertBefore(a, o)
    }, 0)
}
var nUso = 0,
    ultimoId, ultimoColor, id = 0,
    paso = 1,
    fecha = "";
$(window).ready(function() {
    $(".botonVolver").hide(), $(".botonComprar #ultimo").hide(), $(".botonComprar #spanUltimo").hide(), $("#seleccionLocal").transition({
        animation: "scale",
        duration: ".1s"
    }), $("#calendarioLocal").transition({
        animation: "scale",
        duration: ".1s"
    }), $("#tarjetaNormal").on("click", function() {
        $("#tipoLocalInput").attr("value", "normal"), $("#tarjetaNormal").addClass("orange"), $("#tarjetaUltra").removeClass("orange"), $("#tarjetaClass").removeClass("orange")
    }), $("#tarjetaClass").on("click", function() {
        $("#tipoLocalInput").attr("value", "class"), $("#tarjetaClass").addClass("orange"), $("#tarjetaNormal").removeClass("orange"), $("#tarjetaUltra").removeClass("orange")
    }), $("#tarjetaUltra").on("click", function() {
        $("#tipoLocalInput").attr("value", "ultra"), $("#tarjetaUltra").addClass("orange"), $("#tarjetaNormal").removeClass("orange"), $("#tarjetaClass").removeClass("orange")
    }), $(".botonComprar").on("click", function() {
        var a = 0;
        1 == paso && ("none" != $("#tipoLocalInput").attr("value") ? ($("#tiposLocal").transition({
            animation: "fly right",
            onComplete: function() {
                $("#seleccionLocal").transition("fly down"), $(".botonVolver").transition("scale")
            }
        }), a++) : swal("Oops...", "Selecciona un tipo de local", "error")), 2 == paso && ("" != fecha ? ($.ajax({
            url: "../php/obtenerLocales.php",
            type: "GET",
            data: "tipo=" + $("#tipoLocalInput").attr("value") + "&fechaActual=" + fecha
        }).done(function(a) {
            $.each(JSON.parse(a), function(a, t) {
                $("#" + t.nombre_local).attr("fill", "#E0E0E0"), $("#" + t.nombre_local + " text").attr("fill", "white")
            }), $("#seleccionLocal").transition({
                animation: "fly right",
                onComplete: function() {
                    $("#calendarioLocal").transition("fly down"), $(".botonComprar #normal").transition({
                        animation: "fade left",
                        onComplete: function() {
                            $("#spanNormal").transition({
                                animation: "scale",
                                onComplete: function() {
                                    $(".botonComprar #spanUltimo").transition("scale"), $(".botonComprar #ultimo").transition("scale")
                                }
                            })
                        }
                    })
                }
            })
        }), a++) : swal("Oops...", "Selecciona una fecha", "error")), 3 == paso && (jQuery.isEmptyObject(map) ? swal("Oops...", "Selecciona al menos un local", "error") : swal({
            title: "¿Estás seguro de realizar la compra?",
            text: "No podrás revertir la transacción después",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            showLoaderOnConfirm: !0,
            confirmButtonText: "Rentar!",
            preConfirm: function() {
                return new Promise(function(a, t) {
                    $.ajax({
                        url: "../php/guardarRenta.php",
                        type: "GET",
                        data: "tipo=" + $("#tipoLocalInput").attr("value") + "&fechaActual=" + fecha + "&json=" + JSON.stringify(map)
                    }).done(function(o) {
                        "true" == o ? a() : t("Fallo la renta")
                    })
                })
            },
            allowOutsideClick: !1
        }).then(function() {
            swal({
                title: "¡Rentado!",
                text: "El local ha sido rentado, los formatos de pago fueron enviados a tu correo y como sms a tu celular",
                type: "success",
                allowOutsideClick: !1
            }).then(function() {
                window.location.href = "../panel"
            })
        })), a > 0 && (paso++, a = 0)
    }), $(".botonVolver").on("click", function() {
        2 == paso && $("#seleccionLocal").transition({
            animation: "fly down",
            onComplete: function() {
                $("#tiposLocal").transition("fly right"), $(".botonVolver").transition("scale")
            }
        }), 3 == paso && (map = new Object, $("#svgCroquis g").each(function(a) {
            $(this).attr("fill", "white"), void 0 !== $(this).attr("id") && $("#" + $(this).attr("id") + " text").attr("fill", "black")
        }), $("#calendarioLocal").transition({
            animation: "fly down",
            onComplete: function() {
                $("#seleccionLocal").transition("fly right"), $(".botonComprar #ultimo").transition({
                    animation: "fade left",
                    onComplete: function() {
                        $("#spanUltimo").transition({
                            animation: "scale",
                            onComplete: function() {
                                $(".botonComprar #spanNormal").transition("scale"), $(".botonComprar #normal").transition("scale")
                            }
                        })
                    }
                })
            }
        })), paso--
    });
    var a = new Date;
    $("#fechaLocal").calendar({
        type: "date",
        minDate: new Date(a.getFullYear(), a.getMonth(), a.getDate() + 1),
        maxDate: new Date(a.getFullYear(), a.getMonth(), a.getDate() + 30),
        text: {
            days: ["D", "L", "M", "M", "J", "V", "S"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
        },
        formatter: {
            date: function(a, t) {
                return a ? a.getDate() + "-" + (a.getMonth() + 1) + "-" + a.getFullYear() : ""
            }
        },
        onChange: function(a, t) {
            fecha = "", ("normal" == $("#tipoLocalInput").attr("value") || "class" == $("#tipoLocalInput").attr("value")) && a.getDay() < 4 && 0 != a.getDay() ? (swal("¡Hey!", "En este tipo de local solo puedes seleccionar un día entre jueves y domingo", "warning"), $("#mycalendar").calendar("refresh")) : fecha = t
        }
    })
});
var map = new Object;
