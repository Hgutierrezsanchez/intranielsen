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

function enviardatosusuario(opcion){
	
	divResultado = document.getElementById('bloque_registro');
	
	var perfil=document.nuevo_usuario.perfil.value;
	nom=document.nuevo_usuario.nombres.value;
	user=document.nuevo_usuario.usuario.value;
	pass=document.nuevo_usuario.pass.value;
	corr=document.nuevo_usuario.correo.value;
	rut=document.nuevo_usuario.rut.value;
	
	if (document.nuevo_usuario.admin.checked==true){
		adm=1;
	}else{
		adm=0;
	}

	ajax=objetoAjax();
	ajax.open("POST", "../../app/administra/usuarios/registro_usuario_db.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
			Limpiar_usuario();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("opcion="+opcion+"&nombres="+nom+"&usuario="+user+"&pass="+pass+"&correo="+corr+"&admin="+adm+"&rut="+rut+"&perfil="+perfil);
}


function Limpiar_usuario(){
	document.nuevo_usuario.nombres.value="";
	document.nuevo_usuario.usuario.value="";
	document.nuevo_usuario.pass.value="";
	document.nuevo_usuario.correo.value="";
	document.nuevo_usuario.rut.value="";
	document.nuevo_usuario.nombres.focus();
}
function limpiar_pass(){
	document.cambiarpassword_form.passn.value="";
	document.cambiarpassword_form.passr.value="";
	document.cambiarpassword_form.passn.focus();
}

function consultausuarioperfil(){
	
	divResultado = document.getElementById('bloque_listausuarios');
	
	var perfil=document.filtra_usuario_perfil.perfil.value;
	
	ajax=objetoAjax();
	
	ajax.open("POST", "../../app/administra/usuarios/lista_usuarios_actualizar.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {	
			divResultado.innerHTML = ajax.responseText
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("perfil="+perfil);
}

function updateusuarioperfil(usuario)
{	
    $("#capa_modal").show();
    $("#capa_para_edicion").show();
    
	divResultado = document.getElementById('capa_para_edicion');
	
	ajax=objetoAjax();

	ajax.open("POST", "../../app/administra/usuarios/muestra_usuario_mod.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {	
			divResultado.innerHTML = ajax.responseText;
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("usuario="+usuario);
}

function enviardatosusuarioupdate(opcion){
	
	divResultado = document.getElementById('bloque_listausuarios');
	
	var perfil=document.modifica_usuario.perfil.value;
	nom=document.modifica_usuario.nombres.value;
	user=document.modifica_usuario.usuario.value;
	pass="";
	corr=document.modifica_usuario.correo.value;
	rut=document.modifica_usuario.rut.value;
	
	if (document.modifica_usuario.admin.checked==true){
		adm=1;
	}else{
		adm=0;
	}

	
	ajax=objetoAjax();
	ajax.open("POST", "../../app/administra/usuarios/registro_usuario_db.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("opcion="+opcion+"&nombres="+nom+"&usuario="+user+"&pass="+pass+"&correo="+corr+"&admin="+adm+"&rut="+rut+"&perfil="+perfil);
    cerrar_div_modal();
}

function actualizapassxusuario(usuario)
{	
	$("#capa_modal").show();
    $("#capa_para_edicion").show();
    
    divResultado = document.getElementById('capa_para_edicion');
	
	ajax=objetoAjax();

	ajax.open("POST", "../../app/administra/usuarios/muestra_usuario_mod_pass.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {	
			divResultado.innerHTML = ajax.responseText
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("usuario="+usuario);
}

function actualizaestadousuario(usuario,estado)
{	
	divResultado = document.getElementById('bloque_listausuarios');
	
	ajax=objetoAjax();

	ajax.open("POST", "../../app/administra/usuarios/update_estado_db.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {	
			divResultado.innerHTML = ajax.responseText
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("usuario="+usuario+"&estado="+estado);
}
