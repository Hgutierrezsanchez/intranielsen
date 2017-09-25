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

function guardar(){
	var num1=document.inasistencia.iddesde.value;
   	var num2=document.inasistencia.idhasta.value;
  
   	if(num1<=num2){

        divotros = document.getElementById('otros');

        rutt=document.inasistencia.datos.value;
        inasistencia=document.inasistencia.inasistencias.value;
        descripciones=document.inasistencia.descripcion.value;
        desde=document.inasistencia.iddesde.value;
        hastas=document.inasistencia.idhasta.value;

        ajax=objetoAjax();
        ajax.open("POST", "inasistencia/registroguardarinasistencia.php",true);
        ajax.onreadystatechange=function() {
            if (ajax.readyState==4) {
                divotros.innerHTML = ajax.responseText
            }
        }

        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        ajax.send("valrut="+rutt+"&inasistencias="+inasistencia+"&descripcion="+descripciones+"&desdes="+desde+"&hasta="+hastas);
        limpiar_datos();
        
    }else{
    	alert("La Fecha Hasta debe ser mayor que la fecha desde");
   	}
}
function limpiar_datos(){
    document.inasistencia.datos.value="";
    document.inasistencia.inasistencias.value="";
    document.inasistencia.descripcion.value="";	
}
function buscar_ausencia(rut,id){
    $("#capa_modal").show();
    $("#capa_para_edicion").show();
    
    divResultado = document.getElementById('capa_para_edicion');

	ajax=objetoAjax();
    ajax.open("POST", "inasistencia/mostrar_ausencia.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
	    }

	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("rut="+rut+"&id="+id);
}
function buscar_ausencias(){

	divotros = document.getElementById('motrar_tabla');
	
    fdesde=document.form_buscar_ausencia.fecha_desde.value;
    fhasta=document.form_buscar_ausencia.fecha_hasta.value;
	ajax=objetoAjax();
	
	ajax.open("POST", "inasistencia/listar_ausencias.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divotros.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	ajax.send("fdesde="+ fdesde + "&fhasta="+fhasta);
}