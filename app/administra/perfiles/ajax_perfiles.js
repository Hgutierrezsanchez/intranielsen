// JavaScript Document
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

function lista_perfil_primario_check(){
    divResultado = document.getElementById('bloque_perfil_primaro');

    ajax=objetoAjax();
    var perfil =document.form_select_perfil.select_perfil.value


    ajax.open("POST", "../../app/administra/perfiles/lista_perfil_primario_check.php");

    ajax.onreadystatechange=function() {
           if (ajax.readyState==4) {
                divResultado.innerHTML = ajax.responseText
           }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("perfil="+perfil);
}

function update_peril_primario_db(){
    divResultado = document.getElementById('bloque_perfil_primaro');
    var perfil =document.form_update_perfil.perfil.value

    ajax=objetoAjax();
    var checks = document.forms['form_update_perfil'].elements['check'];

    var checkboxes = [];

    for(var i = 0; i < checks.length; i++ ) {
        if(checks[i].checked) {
            checkboxes.push(checks[i].name + "=" + checks[i].value);
        }
    }

    ajax.open("POST", "../../app/administra/perfiles/update_perfil_primario_db.php",true);

    ajax.onreadystatechange=function() {
    if (ajax.readyState==4) {
        divResultado.innerHTML = ajax.responseText
        }
    }

    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("perfil="+perfil+"&"+checkboxes.join('&'))
}

function nuevo_perfil_primario(){
    divResultado = document.getElementById('bloque_perfil_primaro');

    ajax=objetoAjax();

    ajax.open("POST", "../../app/administra/perfiles/nuevo_perfil_primario.php");

    ajax.onreadystatechange=function() {
       if (ajax.readyState==4) {
            divResultado.innerHTML = ajax.responseText
       }
    }
    
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send()
}

function guardar_nuevo_perfil_primario(){
    divResultado = document.getElementById('bloque_perfil_primaro');

    nperfil =document.form_nuevo_perfil_primario.nombres.value;

    ajax=objetoAjax();

    ajax.open("POST", "../../app/administra/perfiles/create_perfil_primario_db.php");

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
            divResultado.innerHTML = ajax.responseText
        }
    }
    
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("nuevoperfil="+nperfil);
}

function listar_perfil_usuario_check(){
    divResultado = document.getElementById('bloque_perfil_usuario');

    ajax=objetoAjax();
    var usuario =document.form_usuario_perfil.select_usuario_perfil.value


    ajax.open("POST", "../../app/administra/perfiles/lista_perfil_usuario_check.php");

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
            divResultado.innerHTML = ajax.responseText
        }
    }

    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("usuario="+usuario)
}

function update_peril_usuario_db(){
    divResultado = document.getElementById('bloque_perfil_usuario');
    var usuario =document.form_update_perfil_usuario.usuario.value

    ajax=objetoAjax();
    var checks = document.forms['form_update_perfil_usuario'].elements['check'];
		
    var checkboxes = [];

    for(var i = 0; i < checks.length; i++ ) {
        if(checks[i].checked) {
            checkboxes.push(checks[i].name + "=" + checks[i].value);
        }
    }

    ajax.open("POST", "../../app/administra/perfiles/update_peril_usuario_db.php",true);

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
            divResultado.innerHTML = ajax.responseText
        }
    }
    
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("usuario="+usuario+"&"+checkboxes.join('&'))
}
