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
function traerejecutivos(){
    $("#capa_modal").show();
    $("#capa_para_edicion").show();
    
    divResultado = document.getElementById('capa_para_edicion');

	ajax=objetoAjax();
	var usuario =document.form_supervisor.select1.value
    var nombre=document.form_supervisor.select1.selectedOptions[0].text
		

    ajax.open("POST", "../../app/rrhh/asignacion/agregar_ejecutivos.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
	    }

	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("usuario="+usuario+"&nombre="+nombre);
}
function agregar_ejecutivos(){
	divResultado = document.getElementById('resultado_check');
	var usuario =document.form_supervisor.select1.value;
			
	ajax=objetoAjax();
	var checks = document.forms['form_sinasginar'].elements['check'];
    
	var checkboxes = [];
	
    if (checks.length!=undefined)
    {
        for(var i = 0; i < checks.length; i++ ) {
            if(checks[i].checked) {
                checkboxes.push(checks[i].name + "=" + checks[i].value);
            }	 
        }
    }else{
        if(checks.checked) {
            checkboxes.push(checks.name + "=" + checks.value);
        }	 
    }
	
	ajax.open("POST", "../../app/rrhh/asignacion/update_agrega.php",true);

	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(checkboxes.join('&')+"&usuario="+usuario);
    
    cerrar_div_modal();
}
function quitarejecutivos(){
	divResultado = document.getElementById('resultado_check');
	var usuario =document.form_supervisor.select1.value;
				
	ajax=objetoAjax();
	var checks = document.forms['form_asignados'].elements['check'];
		
	var checkboxes = [];
    
    if (checks.length!=undefined)
    {
        for(var i = 0; i < checks.length; i++ ) {
            if(checks[i].checked) {
                checkboxes.push(checks[i].name + "=" + checks[i].value);
            }	 
        }
    }else{
        if(checks.checked) {
            checkboxes.push(checks.name + "=" + checks.value);
        }	 
    }
	
	ajax.open("POST", "../../app/rrhh/asignacion/update_quitar.php",true);

	ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				divResultado.innerHTML = ajax.responseText;
			}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("usuario="+usuario+"&"+checkboxes.join('&'));
    
    cerrar_div_modal();
}
function consulta_carga(){
	divResultado = document.getElementById('resultado');
	
	var perfil=document.filtra_usuario_perfil.perfil.value;
	
	ajax=objetoAjax();
	
	ajax.open("POST", "../../app/rrhh/asignacion/consulta_carga.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {	
			divResultado.innerHTML = ajax.responseText
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("perfil="+perfil);
}
function cerrar_div_modal() {
    $("#capa_modal").hide();
    $("#capa_para_edicion").hide();
    $("#capa_para_edicion").html("");
}
function cargaturnoejecutivo_blank(idusuario,fecha) {
    window.open("../../app/rrhh/turnos/verturnousuario.php?usuario=" + idusuario + "&fecha="+ fecha, "", "height=700,width=800,scrollbars=yes");
}
function buscar_turno(){
    divResultado = document.getElementById('turnos_plataforma');

    var fecha = document.form_busca_turno.fecha_turno.value;

    ajax = objetoAjax();
    ajax.open("POST", "../../app/rrhh/turnos/listar_turnos_plataforma.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("fecha=" + fecha);
    
}
function cargar_turno_excel(archivo){
    divResultado = document.getElementById('carga_archivo');
    
    $("#carga_archivo").html($("#cargador").html());
    
    ajax = objetoAjax();
    ajax.open("POST", "../../app/rrhh/carga_turnos/cargar_turnos.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("archivo=" + archivo);
    
}
function carga_fecha_turno_propio(usuario) {

    divResultado = document.getElementById('motrar_tabla');

    var fecha = document.form_cargar_tabla.fecha_desde.value;
    var fechah = document.form_cargar_tabla.fecha_hasta.value;

    ajax = objetoAjax();
    ajax.open("POST", "../../app/rrhh/turnos/tabla_turno_propio.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("fecha=" + fecha + "&fechah=" + fechah + "&iduser=" + usuario);
}
function muestra_ejecutivo_asignar(usuario) {

    divResultado = document.getElementById('filtr_ejecutivos_asignar');
    var perfil = document.form_sinasginar.perfil.value;

    ajax = objetoAjax();
    ajax.open("POST", "../../app/rrhh/asignacion/muestra_ejecutivos_asignar.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("usuario=" + usuario + "&perfil=" + perfil);
}
function exporta_excel_turno_plataforma(fecha) {
    window.open("../../app/rrhh/turnos/exporta_excel_plataforma.php?fecha=" + fecha, "", "height=700,width=800,scrollbars=yes");
}