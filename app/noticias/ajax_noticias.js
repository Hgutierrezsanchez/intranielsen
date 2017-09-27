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
$('#main form').on('submit', function () {

    // var act = $('#main form').attr('action');
    // var met = $('#main form').attr('method');
    var titulo = $('#titulo').val();
    var dcorta = $('#dcorta').val();
    var dlarga = $('#dlarga').val();
    var importancia = $('#importancia').val();
    var from = $('#ori').val();

    $.ajax({
        url: '../noticias/guardar_noticia.php',
        type: 'POST',
        dataType: 'html',
        data: {
            titulo: titulo,
            dcorta: dcorta,
            dlarga: dlarga,
            importancia: importancia,
            from: from
        },
        
    });
window.location.reload;
});

function borrar(id){
    var opcion = confirm("¿Desea eliminar esta noticia de manera permanente?");
    if(opcion==true){
        
                ajax = objetoAjax();
                ajax.open("POST", "../noticias/eliminar_noticia.php", true);
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4) {


                }

                }

                ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                ajax.send("id=" + id);
        
        alert("Datos eliminados correctamente");
        
    }
    location.reload(false);
}
function modificarnoticiass(id){
    titulo1=document.modificaa.titulo1.value;
    dcorta1=document.modificaa.dcorta1.value;
    dlarga1=document.modificaa.dlarga1.value;
    importancia1=document.modificaa.importancia1.value;
    ajax = objetoAjax();
    ajax.open("POST", "../noticias/modificar_noticia.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
    }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("id=" + id + "&titulo=" + titulo1 + "&dcorta=" + dcorta1 + "&dlarga=" +dlarga1+ "&importancia=" +importancia1);
    alert("Datos modificados correctamente");
        location.reload(false);

}

function updatenoticia(id)
{	
    $("#capa_modal").show();
    $("#capa_para_edicion").show();
    
	divResultado = document.getElementById('capa_para_edicion');
	
	ajax=objetoAjax();

	ajax.open("POST", "../noticias/muestra_noticia_mod.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {	
			divResultado.innerHTML = ajax.responseText;
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id="+id);
}


function actualizaestadonoticia(id,estatus)
{	
    var opcion = confirm("¿Desea cambiar el estado de esta noticia?");
    if(opcion===true){
	divResultado = document.getElementById('act');
	ajax=objetoAjax();
	ajax.open("POST", "../noticias/desactiva_noticia.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
		}
	};
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("estatus="+estatus+"&id="+id);
    alert("Estado modificado Satisfactoriamente");
    }
    location.reload();
}

$('#botona').click(function(){
            $('#importancia1').html('off');
            $(this).toggleClass('btn-info');
            $(this).addClass('btn-warning');
    return;
});
$('#botond').click(function(){
            $(this).toggleClass('btn-warning');
            $(this).addClass('btn-info');
            $('#importancia1').html('activo');
    return;
});