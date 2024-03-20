function blockey(tecla,e){
	let regex = /[a-zA-Z0-9\+\#\:\.\s]/;
			if(!regex.test(tecla)){
				e.preventDefault();
				return false;
			}
}


function blockeyEdicion(tecla,e){
	let regex = /[a0-9]/;
			if(!regex.test(tecla)){
				e.preventDefault();
				return false;
			}
}

function validarAltaFicha(titulo){	
	if (titulo ==''||titulo.len<3){
		return false;
	}else{
		return true;
	}

	//autor = ''||autor.len<3?false:true;
	//isbn = ''||isbn.len<3?false:true;
	//clasificacion == ''||clasificacion.len<3?false:true;

	//valido = (titulo,autor,isbn,clasificacion)?true:false;
}