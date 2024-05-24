function blockey(tecla,e){
	let regex = /[a-zA-Z0-9\+\#\'\:\.\s]/;
	if(!regex.test(tecla)){
		e.preventDefault();
		return false;
	}
}

function justDigits(tecla,e){
	let regex = /[0-9]/;
	
	if(e.key==='Backspace'){
		return true;
	}

	if(!regex.test(tecla)){
		e.preventDefault();
		return false;
	}
}

function quitarComilla(texto){
	return texto.replace(/'/g,"''");
}

function quitarGuiones(value) {
    return value.replace(/-+/g, '-');   
}

function validarMayorATres(input){	
	if(input ==''||input.length<3){
		return false;
	}else{
		return true;
	}
}

