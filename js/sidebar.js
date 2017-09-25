// JavaScript Document
function ajaxFunction() {
  var xmlHttp;
  
  try {
   
    xmlHttp=new XMLHttpRequest();
    return xmlHttp;
  } catch (e) {
    
    try {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      return xmlHttp;
    } catch (e) {
      
	  try {
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        return xmlHttp;
      } catch (e) {
        alert("Tu navegador no soporta AJAX!");
        return false;
      }}}
}

function Enviar(_pagina,capa) {
    var ajax;
    ajax = ajaxFunction();

    ajax.open("POST", _pagina, true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function() {
        if (ajax.readyState==1){
            document.getElementById(capa).innerHTML = " Aguarde por favor...";
        }
        if (ajax.readyState == 4) {

        document.getElementById(capa).innerHTML=ajax.responseText; 
        }
    }

    ajax.send("pagina="+_pagina);
} 
function rebaja_notificacion(opcion,id,iduser){
    var ajax;
    ajax = ajaxFunction();
    
    divResultado = document.getElementById('result_notificaciones');
    
    ajax.open("POST","/intranielsen/includes/rebaja_notificaciones.php", false);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            //divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("opcion="+opcion+"&id="+id+"&iduser="+iduser);
}

function mostrar_cambiar_pass(usuario) {
    $("#capa_modal").show();
    $("#capa_para_edicion").show();
    
    divResultado = document.getElementById('capa_para_edicion');
    
    ajax = ajaxFunction();
    ajax.open("POST", "/intranielsen/app/administra/usuarios/cambiacontrasena.php", true);
    
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("usuario="+usuario);
    
}
function cambiarpassword(opcion){
	user=document.cambiarpassword_form.usuario.value;
	
	passn=document.cambiarpassword_form.passn.value;
	passr=document.cambiarpassword_form.passr.value;
    
	estado=1;
	if (passn!=passr){
        estado=0;
	}
	
	ajax=ajaxFunction();
	
    if (opcion=='admin')
	{
        divResultado = document.getElementById('bloque_listausuarios');
        ajax.open("POST", "../../app/administra/usuarios/update_pass_db.php",true);
	}else{
        divResultado = document.getElementById('resultado');
        ajax.open("POST", "/intranielsen/app/administra/usuarios/update_pass_db.php",true);
    }
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
            if (opcion=='user')
            {
            document.cambiarpassword_form.passn.value="";
	        document.cambiarpassword_form.passr.value="";
	        document.cambiarpassword_form.passn.focus();
            }
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("usuario="+user+"&passn="+passn+"&passr="+passr+"&estado="+estado);
    if (opcion=='admin')
	{
        cerrar_div_modal();
    }
}
function cerrar_div_modal() {
    $("#capa_modal").hide();
    $("#capa_para_edicion").hide();
    $("#capa_para_edicion").html("");
}
function informar_actualizacion_app(){
	divResultado = document.getElementById('informa_update_app');
	ajax=ajaxFunction();
    ajax.open("POST", "/intranielsen/includes/informar_actualizacion.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send();
}
