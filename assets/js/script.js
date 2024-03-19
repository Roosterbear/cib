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
