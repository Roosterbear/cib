	
<script>
$(document).ready(function(){

  altaLibro.forEach(function(libro){
		libro.addEventListener('keydown', function(e){
			blockey(e.key,e);
		});	
	});
});
</script>
</body>
</html>