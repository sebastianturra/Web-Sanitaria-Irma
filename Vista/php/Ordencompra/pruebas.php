<html lang="en">
<head>
    <!-- Font Icon -->
    <!--<link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css"> -->

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli_1.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script> -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script  type="text/javascript">
   $(function(){
     $("#opciones").on("change", function(){
       var index = parseInt($(this).val());
            if(index==1){
              var texto ="<table><tr>";
                  texto += "<th colspan='2'>Titulo</th>";
                  texto += "</tr>";
                  texto += "<tr>";
                  texto += "<td>Esto es un titulo.</td>";
                  texto += "<td>Esto es un subtitulo.</td>";
                  texto += "</tr>";
                  texto += "</table>";
            }else{
              var texto ="<table><tr>";
                  texto += "<th colspan='2'>AWESOME</th>";
                  texto += "</tr>";
                  texto += "<tr>";
                  texto += "<td>THIS IS.</td>";
                  texto += "<td>AWESOME.</td>";
                  texto += "</tr>";
                  texto += "</table>";
            }
   $("#prueba").html(texto);
  });
 });                                                                              
</script>
<style>
   #uno{
        border:1px solid black;  
  width:100%;
  display:inline-block;
  margin:auto;
  height:auto;
  background-color:ghostwhite;
        margin-bottom: 5px;
    }
 .contacto{
        table-layout: fixed;
        width:100%;
        max-width: 100%;    
            }

  .contacto td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}

 .contacto td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}

.datemp{
        table-layout: fixed;
        width:100%;
        max-width: 100%;    
            }

  .datemp td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}

 .datemp td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}

 .datemp td:nth-child(5) {
    background-color:whitesmoke;
    font-weight: bold;
}
.datcottit{
        table-layout: fixed;
        width:100%;
        max-width: 100%;    
            }

.datcotpie{
        table-layout: fixed;
        width:auto;
        max-width: 100%;    
            }

 td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 15px;
                font-weight: bold;
                    background-color:white;
            }
  
    th{
        text-align: center;
    }

.botones{
  margin-bottom: 20px;
}
#popup {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}
 
.content-popup {
    margin:0px auto;
    margin-top:120px;
    position:relative;
    padding:10px;
    width:500px;
    height: auto;
    max-height:300px;
    border-radius:4px;
    background-color:#FFFFFF;
    box-shadow: 0 2px 5px #666666;
}
 
.content-popup h2 {
    color:#48484B;
    border-bottom: 1px solid #48484B;
    margin-top: 0;
    padding-bottom: 4px;
}
 
.popup-overlay {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 999;
    display:none;
    background-color: #777777;
    cursor: pointer;
    opacity: 0.7;
}
 
.close {
    position: absolute;
    right: 15px;
}
</style>
   
</head>
<body>
  <div class="container">
    <div id="menu-opcion"  >
      <center><table>
              <tr>
                  <td style="width: 35%; background-color: skyblue; color: white; font-weight: bold;"> Tipo de Usuario<td>
                  <td style="width: 100%; background-color: white"> <select name="opciones" id="opciones" style="width: 100%; border-color: black" class="btn btn-block">
                              <option value="0">Seleccione tipo de Usuario</option>
                              <option value="1">Baños</option>
                              <option value="2">Fosas</option>
                              <option value="3">General</option>
                              
                      </select> </td>
              </tr>
          </table>
          </center>
      </div>
      <div id=container>
        <form>
              <div id="prueba">
                
              </div>
        </form>
      </div>
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>