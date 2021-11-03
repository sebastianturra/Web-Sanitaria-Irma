<head>
		<title>jQuery Load</title>
		<!-- Libreria jQuery -->
		<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 
		<!-- Acción sobre el botón con id=boton y actualizamos el div con id=capa -->
<script type="text/javascript">
	$(document).ready(function() {    
        $("#txt").keyup(function() {
        var tipo = $("#opcion").val();
        var url = "prueba2.php?opcion=" + tipo + "&texto=" + this.value;
        $("#resultado").load(url);
        });
        
        $("#opcion").change(function() {
        var txt = $("#txt").val();
        var url = "prueba2.php?opcion=" + this.value  + "&texto=" + txt;
        $("#resultado").load(url);
        });
    
    
    });
        
    
</script>

<div id="texto" name="texto">
    <select id="opcion" name="opcion">
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
    <input type="texto" id="txt" name="txt">
</div>
<div id="resultado" name="resultado" >
    
    
</div>