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
function cargar_pendientes_excel(archivo){
    divResultado = document.getElementById('carga_archivo');
    var fecha=document.getElementById('fecha').value;
    
    $("#carga_archivo").html($("#cargador").html());
    
    ajax = objetoAjax();
    ajax.open("POST", "../../app/operaciones/pendientes/cargar_pendientes.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("archivo=" + archivo + "&fecha=" + fecha);
    
}