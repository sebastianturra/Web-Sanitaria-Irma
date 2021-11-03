
<html>
	<head>
		<title>jQuery Load</title>
		<!-- Libreria jQuery -->
		<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 
		<!-- Acción sobre el botón con id=boton y actualizamos el div con id=capa -->
		<script type="text/javascript">
			$(document).ready(function() {
				$("#boton").click(function(event) {
                                    var texto=$("#boton").val();
					$("#capa2").text(texto);
                                        $("#capa").load("AgregarContacto.php");
				});
                                
                                $("#menu1").mousemove(function(event) {
                                    var texto=$("#boton").val();
					$("#capa2").text(texto);
                                        $("#menu2").load("AgregarContacto.php");
				});
			});
                 function cambiocolor(dato){
                     document.getElementById('menu2').innerHTML="<div id='menu2' style='background-color:blue'>"+dato+"</div>";
                 }
                  function cambiocolor2(){
                     document.getElementById('menu2').innerHTML="<div id='menu2' style='background-color:yellow'>hola</div>";
                 }
		</script>
	</head>
	<body>
	<div id="capa">Pulsa 'Actualizar capa' y este texto se actualizará</div>
        <div id="capa2"></div>
	<br>
        <div name="boton" id="boton" >A </div>
        
        <table>
            <tr><td><div id="menu1"  onmousemove="cambiocolor(1)">hola</div></td>
                <td><div id="menu2"></div></td>
            </tr>
            <tr><td><div id="menu3" onmousemove="cambiocolor(2);">hola</div></td>
                <td><div id="menu2"></div></td>
            </tr>
            
        </table>
        <iframe src="AgregarContacto.php" style="border:0;"></iframe>
        
	</body>
</html>
