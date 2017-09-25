function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }

    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function buscar_bloque() {

    divResultado = document.getElementById('bloque_agendamiento');

    var fecha = document.form_busca_bloque.fecha_agen.value;
    var comuna = document.form_busca_bloque.comuna.value;

    ajax = objetoAjax();
    ajax.open("POST", "../../app/agendamiento_ordenes/muestra_bloques.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("fecha=" + fecha + "&comuna=" + comuna);
}

function cerrar_div_modal() {
    $("#capa_modal").hide();
    $("#capa_para_edicion").hide();
    $("#capa_para_edicion").html("");
}

function agrega_agendamiento(idusuario, bloque) {
    $("#capa_modal").show();
    $("#capa_para_edicion").show();
    
    divResultado = document.getElementById('capa_para_edicion');

    var fecha = document.form_busca_bloque.fecha_agen.value;
    var comuna = document.form_busca_bloque.comuna.value;
 
    ajax = objetoAjax();
    ajax.open("POST", "../../app/agendamiento_ordenes/formulario_agendamiento.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("idusuario=" + idusuario + "&bloque=" + bloque + "&fecha=" + fecha + "&comuna=" + comuna);
}

function guardar_agendamiento() {

    divResultado = document.getElementById('bloque_agendamiento');

    var fecha = document.form_busca_bloque.fecha_agen.value;
    var bloque = document.form_agendamiento.bloque.value;
    var norden = document.form_agendamiento.norden.value;
    var rut = document.form_agendamiento.rut.value;
    var idusuario = document.form_agendamiento.idusuario.value;
    var observacion = document.form_agendamiento.observacion.value;
    var comuna = document.form_agendamiento.comuna.value;


    ajax = objetoAjax();
    ajax.open("POST", "../../app/agendamiento_ordenes/guarda_agendamiento.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("idusuario=" + idusuario + "&bloque=" + bloque + "&fecha=" + fecha + "&norden=" + norden + "&rut=" + rut + "&observacion=" + observacion + "&comuna=" + comuna);
    cerrar_div_modal();
}
function listar_ordenes_blank(fecha,bloque,comuna) {
    $("#capa_modal").show();
    $("#capa_para_edicion").show();
    
    divResultado = document.getElementById('capa_para_edicion');
    
    ajax = objetoAjax();
    ajax.open("POST", "../../app/agendamiento_ordenes/listar_ordenes_agendadas.php", true);
    
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("fecha="+fecha+"&bloque="+bloque + "&comuna=" + comuna);
}