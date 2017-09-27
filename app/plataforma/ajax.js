function objetoAjax(){
	var xmlhttp=false;
	try {
		   xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		   try {
			  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		   } catch (E) {
				   xmlhttp = false;
		   }
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		   xmlhttp = new XMLHttpRequest();

	}

	return xmlhttp;
}
function cargar_pendientes_blind_excel(archivo){
    divResultado = document.getElementById('carga_archivo');
    var fecha=document.getElementById('fecha').value;

    $("#carga_archivo").html($("#cargador").html());

    ajax = objetoAjax();
    ajax.open("POST", "../../app/plataforma/blindaje/carga_pendiente_blind.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("archivo=" + archivo + "&fecha=" + fecha);

}
function distribuye_ordenes_blind_cargadas(nivel,filtro){
    if (nivel == 'Nivel 1'){

        var div_carga='bloque_div_cargadas';
        var url_carga='../../app/plataforma/blindaje/distribuye_ordenes_cargadas.php';
        var url_extrae='../../app/plataforma/blindaje/extrae_asignado_ejecutivo.php';
        var select_asignado='select_bloque';
        var divq='div-n1';

    } else if (nivel == 'Nivel 2'){

        var div_carga="bloque_div_cargadas_n2";
        var url_carga="../../app/plataforma/blindaje/distribuye_ordenes_cargadas_n2.php";
        var url_extrae="../../app/plataforma/blindaje/extrae_asignado_ejecutivo.php";
        var select_asignado="select_comuna";
        var divq='div-n2';

    } else if (nivel == 'Nivel 4'){

        var div_carga="bloque_div_cargadas_n4";
        var url_carga="../../app/plataforma/blindaje/distribuye_ordenes_cargadas_n4.php";
        var url_extrae="../../app/plataforma/blindaje/extrae_asignado_ejecutivo.php";
        var select_asignado="select_comuna_n4";
        var divq='div-n4';
    }

    $('#'+div_carga).html($("#cargador").html());

    divResultado = document.getElementById(div_carga);

    ajax = objetoAjax();
    ajax.open("POST", url_carga, true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("filtro="+filtro);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.responseText == 1){
                divResultado.innerHTML = "";
            }else{
                divResultado.innerHTML = ajax.responseText;
            }

            var bloque = document.getElementById(select_asignado).value
            if (bloque != '--' ){
                ajax.open("POST", url_extrae, true);
                ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                ajax.send("bloque=" + bloque + "&nivel=" + nivel);
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4) {
                        var json = ajax.responseText;

                        var arrayJS = eval('(' + json + ')');

                        for(var i=0;i<arrayJS.length;i++)
                        {
                            $("#"+divq+arrayJS[i].usuario).html(arrayJS[i].q);
                        }
                    }
                }
            }
        }
    }
}
function distribuye_ordenes_blind_usuario(nivel,filtro){

    if (nivel == 'Nivel 1'){

        var div_carga='bloque_div_sin_asignar';
        var url_carga='../../app/plataforma/blindaje/distribuye_ordenes_usuarios.php';
        var url_extrae='../../app/plataforma/blindaje/extrae_asignado_ejecutivo.php';
        var select_asignado='select_bloque';
        var divq='div-n1';

    } else if (nivel == 'Nivel 2'){

        var div_carga="bloque_div_sin_asignar_n2";
        var url_carga="../../app/plataforma/blindaje/distribuye_ordenes_usuarios_n2.php";
        var url_extrae="../../app/plataforma/blindaje/extrae_asignado_ejecutivo.php";
        var select_asignado="select_comuna";
        var divq='div-n2';

    } else if (nivel == 'Nivel 4'){

        var div_carga="bloque_div_sin_asignar_n4";
        var url_carga="../../app/plataforma/blindaje/distribuye_ordenes_usuarios_n4.php";
        var url_extrae="../../app/plataforma/blindaje/extrae_asignado_ejecutivo.php";
        var select_asignado="select_comuna_n4";
        var divq='div-n4';
    }

    $("#"+div_carga).html($("#cargador").html());

    divResultado = document.getElementById(div_carga);

    ajax = objetoAjax();
    ajax.open("POST", url_carga, true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("filtro="+filtro);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText

            var bloque = document.getElementById(select_asignado).value
            if (bloque != '--' ){
                ajax.open("POST", url_extrae, true);
                ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                ajax.send("bloque=" + bloque + "&nivel=" + nivel);
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4) {
                        var json = ajax.responseText;
                        var arrayJS = eval('(' + json + ')');

                        for(var i=0;i<arrayJS.length;i++)
                        {
                            $("#"+divq+arrayJS[i].usuario).html(arrayJS[i].q);
                        }
                    }
                }
            }
        }
    }
}
function mover_sin_asignar_nivel(desde,nivel_desde,nivel_hasta,filtro){
    if (desde == 'DISTRIBUCION'){
        if (nivel_desde == 'Nivel 1'){

            var div_carga='bloque_div_sin_asignar';
            var url_carga='../../app/plataforma/blindaje/distribuye_ordenes_mover_nivel.php';

        }
    }


    $("#"+div_carga).html($("#cargador").html());

    divResultado = document.getElementById(div_carga);

    ajax = objetoAjax();
    ajax.open("POST", url_carga, true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("filtro="+filtro + "&desde=" + nivel_desde + "&hasta=" + nivel_hasta + "&pagina=" + desde);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText
        }
    }
}
function des_habilita_usuario_bloque(usuario,bloque,tarea){
    if (tarea == 'Nivel 1'){

        var divq='div-n1';
        var div_carga='bloque_div_sin_asignar';
        var check_u="check-n1";

    } else if (tarea == 'Nivel 2'){

        var divq='div-n2';
        var div_carga="bloque_div_sin_asignar_n2";
        var check_u="check-n2";

    } else if (tarea == 'Nivel 4'){

        var divq='div-n4';
        var div_carga="bloque_div_sin_asignar_n4";
        var check_u="check-n4";
    }

    $("#"+divq+usuario).html($("#cargador").html());

    var check
    if (document.getElementById(check_u+usuario).checked) check=1; else check=0;

    ajax = objetoAjax();
    ajax.open("POST", "../../app/plataforma/blindaje/des_habilita_usuario_bloque.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado = document.getElementById(divq+usuario);
            divResultado.innerHTML = 0;

            divResultado = document.getElementById(div_carga);
            divResultado.innerHTML = ajax.responseText;;

        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("usuario=" + usuario + "&bloque=" + bloque + "&estado=" + check + "&tarea=" + tarea);
}
function cambia_nivel_usuario_comuna(usuario,comuna){

    $("#div-"+comuna+"-"+usuario).html($("#cargador").html());


    var tarea = document.getElementById('select-'+comuna+'-'+usuario).value

    ajax = objetoAjax();
    ajax.open("POST", "../../app/plataforma/blindaje/cambia_nivel_usuario_comuna.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado = document.getElementById("div-"+comuna+"-"+usuario);
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("usuario=" + usuario + "&comuna=" + comuna + "&tarea=" + tarea);
}
function listar_usuario_bloque(){
    $("#listar_bloque_ejecutivo").html($("#cargador").html());


    var bloque = document.getElementById('select_bloque').value

    ajax = objetoAjax();
    if (bloque != '--' ){
        ajax.open("POST", "../../app/plataforma/blindaje/listar_bloque_ejecutivo_N1.php", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                divResultado = document.getElementById("listar_bloque_ejecutivo");
                divResultado.innerHTML = ajax.responseText;
            }
        }
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("bloque=" + bloque);
    }else{
        divResultado = document.getElementById("listar_bloque_ejecutivo");
        divResultado.innerHTML = "";
    }
}
function listar_usuario_comuna(){
    $("#listar_comuna_ejecutivo").html($("#cargador").html());


    var comuna = document.getElementById('select_comuna').value

    ajax = objetoAjax();
    if (comuna != '--' ){
        ajax.open("POST", "../../app/plataforma/blindaje/listar_comuna_ejecutivo_N2.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("comuna=" + comuna);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                divResultado = document.getElementById("listar_comuna_ejecutivo");
                divResultado.innerHTML = ajax.responseText;
            }
        }

    }else{
        divResultado = document.getElementById("listar_comuna_ejecutivo");
        divResultado.innerHTML = "";
    }
}
function listar_usuario_comuna_N4(){
    $("#listar_comuna_ejecutivo_n4").html($("#cargador").html());


    var comuna = document.getElementById('select_comuna_n4').value

    ajax = objetoAjax();
    if (comuna != '--' ){
        ajax.open("POST", "../../app/plataforma/blindaje/listar_comuna_ejecutivo_N4.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("comuna=" + comuna);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                divResultado = document.getElementById("listar_comuna_ejecutivo_n4");
                divResultado.innerHTML = ajax.responseText;
            }
        }

    }else{
        divResultado = document.getElementById("listar_comuna_ejecutivo_n4");
        divResultado.innerHTML = "";
    }
}
function buscar_ordenes_listar(iduser,filtro){

    $.ajax({
        url: '../../app/plataforma/blindaje/listar_ordenes_pendientes.php',
        type: 'POST',
        dataType: 'html',
        data: { filtraje: filtro, iduser: iduser},
    })
    .done (function(result){
        $('#ordenes_pendientes').html(result)
    })
    .error(function(xhr, ajaxOptions, thrownError) {
        $('#ordenes_pendientes').html(xhr.responseText)
    })
}
function listar_usuario_seguimiento(iduser,filtro){
    $.ajax({
        url: '../../app/plataforma/blindaje/listar_ordenes_seguimiento.php',
        type: 'POST',
        dataType: 'html',
        data: { filtraje: filtro, iduser: iduser},
    })
    .done (function(result){
        $('#listar_ordenes_ejecutivo_seguimiento').html(result)
    })
}
function listar_usuario_finalizada(iduser,filtro){
    $.ajax({
        url: '../../app/plataforma/blindaje/listar_ordenes_finalizadas.php',
        type: 'POST',
        dataType: 'html',
        data: { filtraje: filtro, iduser: iduser },
    })
    .done (function(result){
        $('#listar_ordenes_ejecutivo_finalizadas').html(result)
    })
}
function listar_usuario_futuras(iduser,filtro){
    $.ajax({
        url: '../../app/plataforma/blindaje/listar_ordenes_futuras.php',
        type: 'POST',
        dataType: 'html',
        data: { filtraje: filtro, iduser: iduser },
    })
    .done (function(result){
        $('#listar_ordenes_ejecutivo_futuras').html(result)
    })
}
function listar_usuario_buscar(iduser,filtro){
    $.ajax({
        url: '../../app/plataforma/blindaje/listar_ordenes_buscar.php',
        type: 'POST',
        dataType: 'html',
        data: { filtraje: filtro, iduser: iduser },
    })
    .done (function(result){
        $('#listar_ordenes_buscar').html(result)
    })
}
function listar_Resumen_usuario(iduser,filtro){
    $.ajax({
        url: '../../app/plataforma/blindaje/listar_resumen_gestion_usuario.php',
        type: 'POST',
        dataType: 'html',
        data: { iduser: iduser,filtro:filtro },
    })
    .done (function(result){
        $('#listar_Resumen_usuario').html(result)
    })
}
function ejecutar_accion_orden(id_orden,tab){

    var select_id = document.getElementById('marca-'+id_orden).value
    if (select_id == 'MOVER A REVISIÓN' ){

        $.ajax({
            url: '../../app/plataforma/blindaje/update_orden_mover_revision.php',
            type: 'POST',
            dataType: 'html',
            data: { id: id_orden }
        })
        .done (function(result){
            $('#tr-'+ id_orden).hide();
        })
    }
    else if (select_id != '--' ){
        $("#capa_modal").show();
        $("#capa_para_edicion").show();

        $.ajax({
            url: '../../app/plataforma/blindaje/mostrar_update_orden_accion.php',
            type: 'POST',
            dataType: 'html',
            data: { id: id_orden,accion: select_id }
        })
        .done (function(result){
            $('#capa_para_edicion').html(result)
            document.getElementById('marca-'+id_orden).selectedIndex=0;
        })
    }
}
function update_orden_seguimiento(id_orden,accion){
    if (accion != 'ESCALAR'){

        var orden = document.getElementById('orden').value;
        var usuario = document.getElementById('usuario').value;
        var observacion = document.getElementById('observacion').value;
        var gestion = document.getElementById('gestion').value;

        $.ajax({
            url: '../../app/plataforma/blindaje/update_orden_revision.php',
            type: 'POST',
            dataType: 'html',
            data: { id:id_orden ,orden: orden, accion: accion, usuario: usuario, observacion: observacion, gestion:gestion }
        })
        .done (function(result){
            if (accion == 'FINALIZAR')
            {
                $('#tr-'+ id_orden).hide();

            }else{
            var json = result;
            var arrayJS = eval('(' + json + ')');

                $('#gestion-'+ id_orden).html(arrayJS[0].gestion);
                $('#observacion-'+ id_orden).html("<a href='#' onclick=\"mostrar_observaciones_orden('" + id_orden +"');\">"+ arrayJS[0].q_obs + "</a>");
                $('#final-'+ id_orden).html(arrayJS[0].final);
                $('#accion-'+ id_orden).html(accion);
            }
            cerrar_div_modal();
        })
    }else{
        var orden = document.getElementById('orden').value;
        var usuario = document.getElementById('usuario').value;
        var observacion = document.getElementById('observacion').value;
        var ubicacion = document.getElementById('escalar').value;
        var gestion = document.getElementById('gestion').value;

        if (ubicacion != '--'){
            $.ajax({
                url: '../../app/plataforma/blindaje/update_orden_revision.php',
                type: 'POST',
                dataType: 'html',
                data: { id:id_orden ,orden: orden, accion: accion, usuario: usuario, observacion: observacion, ubicacion: ubicacion, gestion:gestion }
            })
            .done (function(result){
                var json = result;
                var arrayJS = eval('(' + json + ')');

                $('#gestion-'+ id_orden).html(arrayJS[0].gestion);
                $('#observacion-'+ id_orden).html("<a href='#' onclick=\"mostrar_observaciones_orden('" + id_orden +"');\">"+ arrayJS[0].q_obs + "</a>");
                $('#final-'+ id_orden).html(arrayJS[0].final);
                $('#accion-'+ id_orden).html(accion);


                cerrar_div_modal();
            })
        }
    }
}
function cerrar_div_modal() {
    $("#capa_modal").hide();
    $("#capa_para_edicion").hide();
    $("#capa_para_edicion").html("");
}
function update_estado_real_orden(id_orden){

    var select_id = document.getElementById('real-'+id_orden).value

    if (select_id != '--' ){
        $.ajax({
            url: '../../app/plataforma/blindaje/update_orden_estado_real.php',
            type: 'POST',
            dataType: 'html',
            data: { id: id_orden,real: select_id }
        })
        .done (function(result){
            $('#capa_para_edicion').html(result)
        })
    }
}
function mostrar_observaciones_orden(nmro_orden){
    $("#capa_modal").show();
    $("#capa_para_edicion").show();

    $.ajax({
        url: '../../app/plataforma/blindaje/mostrar_observaciones_orden.php',
        type: 'POST',
        dataType: 'html',
        data: { id: nmro_orden }
    })
    .done (function(result){
        $('#capa_para_edicion').html(result)
    })
}
function mostrar_orden_reagendar(nmro_orden){
    $("#mostrar_orden_reagendar").html($("#cargador").html());

    divResultado = document.getElementById("mostrar_orden_reagendar");

    ajax = objetoAjax();
    if (nmro_orden != '' ){
        ajax.open("POST", "../../app/plataforma/blindaje/mostrar_orden_reagendar.php", true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("nmro_orden=" + nmro_orden);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                divResultado.innerHTML = ajax.responseText;
            }
        }

    }else{
        divResultado.innerHTML = "";
    }
}
function exporta_excel_blindaje(nivel,reporte,bloque) {
    window.open("../../app/plataforma/blindaje/exporta_excel_blindaje.php?reporte=" + reporte + "&bloque=" + bloque + "&nivel=" + nivel , "", "height=100,width=100,scrollbars=yes");
}
function exporta_excel_blindaje_revision(reporte,usuario,view,search) {
    window.open("../../app/plataforma/blindaje/exporta_excel_blindaje.php?reporte=" + reporte + "&usuario=" + usuario + "&search=" + search + "&view=" + view , "", "height=100,width=100,scrollbars=yes");
}
