	
<script>
$(document).ready(function(){

  const ficha = document.querySelector("#ficha");
	const ejemplar = document.querySelector("#ejemplar");

	const altaFicha = document.querySelector("#altaFicha");
	const bajaFicha = document.querySelector("#bajaFicha");
	const cambioFicha = document.querySelector("#cambioFicha");
	
	const altaEjemplar = document.querySelector("#altaEjemplar");
	const bajaEjemplar = document.querySelector("#bajaEjemplar");
	const cambioEjemplar = document.querySelector("#cambioEjemplar");
	
	
	ficha.addEventListener('dblclick', function(){
		alert(ficha.innerText);
	});
	const altaLibro = document.querySelectorAll(".altaLibro");
	
  
  altaLibro.forEach(function(libro){
		libro.addEventListener('keydown', function(e){
			blockey(e.key,e);
		});	
	});
});
</script>
</body>
</html>