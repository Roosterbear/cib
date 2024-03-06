	
<script>
$(document).ready(function(){
	const altaFicha = document.querySelectorAll(".altaFicha");
	const btnGuardarAltaFicha = document.querySelector("#btnGuardarAltaFicha");

  altaFicha.forEach(function(libro){
		libro.addEventListener('keydown', function(e){
			blockey(e.key,e);
		});	
	});


	btnGuardarAltaFicha.addEventListener('click',()=>{
		alert('==ALTA DE FICHA==');
	});
});
</script>
</body>
</html>