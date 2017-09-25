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
 
function cargar_nombre(fecha=""){
    
    divotros = document.getElementById('nombre');
    	
    var rutt=document.form_buscar_ejecutivo.rut.value;
    
	ajax=objetoAjax();
	ajax.open("POST", "horasextras/consultarusuario.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divotros.innerHTML = ajax.responseText
            divotros.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	ajax.send("ruts=" + rutt + "&fecha=" + fecha);
}
function consultarestado(){

	divotros = document.getElementById('divverreg');
	estado=document.form_estado.estado.value;
    fdesde=document.form_estado.fecha_desde.value;
    fhasta=document.form_estado.fecha_hasta.value;
	ajax=objetoAjax();
	
	ajax.open("POST", "horasextras/consultarhe.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divotros.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	ajax.send("estado=" + estado + "&fdesde="+ fdesde + "&fhasta="+fhasta);
}

function guardarhorasextras(){
    if (document.form_buscar_ejecutivo.rut.value != null){
        //donde se mostrará lo resultados
        divotros = document.getElementById('divhorasextras');

        //valores de los inputs
        rut=document.form_buscar_ejecutivo.rut.value;
        fecha=document.form_horas.fecha.value;

        desde=document.form_horas.h_desde.value;
        hasta=document.form_horas.h_hasta.value;

        motivo=document.form_horas.motivo.value;
        solicitante=document.form_horas.solicitante.value;

        //instanciamos el objetoAjax
        ajax=objetoAjax();

        //uso del medotod POST
        //archivo que realizará la operacion

        ajax.open("POST", "horasextras/ingresarhoras.php",true);
        ajax.onreadystatechange=function() {
            if (ajax.readyState==4) {
                //mostrar resultados en esta capa
                divotros.innerHTML = ajax.responseText
                //llamar a funcion para limpiar los inputs
            }

        }
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

        //enviando los valores
        ajax.send("rut="+rut+"&fecha="+fecha+"&desde="+desde+"&hasta="+hasta+"&motivo="+motivo+"&solicitante="+solicitante);
        limpiar();
    }else{
        alert("Debe ingresar un rut para registrar...");
    }
}

function limpiar (){

	document.form_buscar_ejecutivo.rut.value=null;
	document.form_horas.motivo.value=null;
	document.form_horas.solicitante.value=null;
	document.getElementById("nombre").innerHTML="";
	
}

function updatehe(idhe)
{	
	divResultado = document.getElementById('divverreg');

	ajax=objetoAjax();
    
	ajax.open("POST", "horasextras/verusuario.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {	
			divResultado.innerHTML = ajax.responseText
			divResultado.style.display="block";
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idhe="+idhe);
}

function enviarupdatehe(){
	divResultado = document.getElementById('divverreg');
    
	idhe=document.editarhe.idhe.value;
	estado=document.editarhe.estado.value;

	ajax=objetoAjax();
	ajax.open("POST", "horasextras/actualizarhe.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idhe="+idhe+"&estado="+estado);
}
function buscar_horas_extras(){

	divotros = document.getElementById('motrar_tabla');
	
    fdesde=document.form_buscar_he.fecha_desde.value;
    fhasta=document.form_buscar_he.fecha_hasta.value;
	ajax=objetoAjax();
	
	ajax.open("POST", "horasextras/listar_horas_extras.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divotros.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	ajax.send("fdesde="+ fdesde + "&fhasta="+fhasta);
}