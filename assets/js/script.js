function blockey(tecla,e){
	let regex = /[a-zA-Z0-9\+\#\:\.\s]/;
			if(!regex.test(tecla)){
				e.preventDefault();
				return false;
			}
}

// SOLO ACEPTA NUMEROS PARA NUMERO DE EDICION
function blockeyEdicion(tecla,e){
	let regex = /[a0-9]/;
			if(!regex.test(tecla)){
				e.preventDefault();
				return false;
			}
}

function validarTituloAltaFicha(titulo){	
	if(titulo ==''||titulo.len<3){
		return false;
	}else{
		return true;
	}
}

function validarAutorAltaFicha(autor){
	if(autor == ''||autor.len<3){
		return false;
	}else{
		return true;
	}
}

function validarISBNAltaFicha(isbn){
	if(isbn == ''||isbn.len<3){
		return false;
	}else{
		return true;
	}
}

function validarClasificacionAltaFicha(clasificacion){
	if(clasificacion == ''||clasificacion.len<3){
		return false;
	}else{
		return true;
	}
}

