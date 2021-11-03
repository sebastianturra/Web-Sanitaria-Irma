<?php 
include_once('Conexion.php');

class vehiculo{

    var $CON;

    //este metodo devuelve el ultimo codigo de vehiculo agregado.
    public function getcodigovehiculo(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT VEH_CODIGO
  FROM vehiculo ORDER BY VEH_CODIGO DESC LIMIT 1";
             $resultado=mysqli_query($Con, $sql);
            if (!isset($resultado)) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"]
                                    );
                        $i++;
                
            } 
                    $cotid=$data[0]['VEH_CODIGO'];
                    return $cotid;
        }else {
            $cotid = "Error: " . $sql;
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function validarpatente($VEH_PATENTE){
        $texto = preg_replace('([^A-Za-z0-9])', '', $VEH_PATENTE);

            $arr1 = array();
            $arr1 = str_split($texto);

            for($i=0;$i<(count($arr1));$i++){
            //  echo $arr1[$i];
            }

            if((count($arr1)==6)){

                  //arrayletraspatente
                $arrayletraspatente = array_slice($arr1, 0, 4);

                //arraynumerospatente
                $arraynumerospatente = array_slice($arr1, -2, 2);

                $contadorinvalido=0;
                for($i=0;$i<(count($arrayletraspatente));$i++){
                  if($arrayletraspatente[$i]=='B'){
                    $arrayletraspatente[$i]=1;
                  }else if($arrayletraspatente[$i]=='C'){
                    $arrayletraspatente[$i]=2;
                  }else if($arrayletraspatente[$i]=='D'){
                    $arrayletraspatente[$i]=3;
                  }else if($arrayletraspatente[$i]=='F'){
                    $arrayletraspatente[$i]=4;
                  }else if($arrayletraspatente[$i]=='G'){
                    $arrayletraspatente[$i]=5;
                  }else if($arrayletraspatente[$i]=='H'){
                    $arrayletraspatente[$i]=6 ;
                  }else if($arrayletraspatente[$i]=='J'){
                    $arrayletraspatente[$i]=7;
                  }else if($arrayletraspatente[$i]=='K'){
                    $arrayletraspatente[$i]=8;
                  }else if($arrayletraspatente[$i]=='L'){
                    $arrayletraspatente[$i]=9;
                  }else if($arrayletraspatente[$i]=='P'){
                    $arrayletraspatente[$i]=0;
                  }else if($arrayletraspatente[$i]=='R'){
                    $arrayletraspatente[$i]=2;
                  }else if($arrayletraspatente[$i]=='S'){
                    $arrayletraspatente[$i]=3;
                  }else if($arrayletraspatente[$i]=='T'){
                    $arrayletraspatente[$i]=4;
                  }else if($arrayletraspatente[$i]=='V'){
                    $arrayletraspatente[$i]=5;
                  }else if($arrayletraspatente[$i]=='W'){
                    $arrayletraspatente[$i]=6;
                  }else if($arrayletraspatente[$i]=='X'){
                    $arrayletraspatente[$i]=7;
                  }else if($arrayletraspatente[$i]=='Y'){
                    $arrayletraspatente[$i]=8;
                  }else if($arrayletraspatente[$i]=='Z'){
                    $arrayletraspatente[$i]=9;
                  }else{
                    $contadorinvalido++;
                  }
                }

                if($contadorinvalido==0){

                $arrayunion = array_merge($arrayletraspatente,$arraynumerospatente);

                $contadorarray=count($arrayunion);

                //Variables de validación
                $sumatoria=0;
                $Dvk=10;
                $DvR=0;
                $multiplicador=7;
                $division=0;
                $numero = array();
                $arraydecimal = array();
                $DvX = array('1','2','3','4','5','6','7','8','9','10','11');

                //Multiplicación del array.
                for($i=0;$i<($contadorarray);$i++){
                  $sumatoria+=($arrayunion[$i]*$multiplicador);
                  //echo "<br>".$arrayunion[$i]."*".$multiplicador."=".($arrayunion[$i]*$multiplicador);
                  $multiplicador--;
                }

                //echo "La sumatoria es:".$sumatoria;

                //Division de la parte entera y la parte decimal.
                //Division
                $division = ($sumatoria/11);
                //echo "La division es:".$division;

                $numero = explode(".",$division);
                //echo "<br>";
                //echo "Entero es:".$numero[0];
               // echo "<br>";
               // echo "Decimal es:".$numero[1];

                $arraydecimal = str_split($numero[1]);

                //Array con valor aproximado.
                      for($i=(count($arraydecimal)-1);$i>=0;$i--){
                        //echo "<br>posicion entrada: ".$i;
                          if(($i<=(count($arraydecimal))-1)&&($i>0)){
                                  if(($arraydecimal[$i]>=5)){
                                  $arraydecimal[$i-1]=$arraydecimal[$i-1]+1;
                                   } 
                                             
                    } 
                   }

                    $resta=0;
                    $resta = 11-($arraydecimal[0]);

                    //asignar DV.
                    $DV=0;
                    $primervalorarray=$resta;
                    if($primervalorarray==11){
                      $DV=0;
                      return true;
                    }else if(($primervalorarray)==10){
                      $DV='K';
                      return true;
                    }else if(($primervalorarray>=1)&&($primervalorarray<11)){
                      $DV=$primervalorarray;
                      return true;
                    }
                }else{
                  //$error = "Patente invalida";
                  return false;
                }
            }         
    }

    //este metodo ve si es que ya esta la patente la base de datos.
    public function verificarpatente($veh_patente){
            $this->CON = new Conexion();
            $Con = $this->CON->conectar();
            $sql="SELECT VEH_PATENTE from vehiculo WHERE VEH_PATENTE='".$veh_patente."';";
            $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) { // Encontro coincidencia == true
                    return true;
        }else {
            return false; // NO ENCONTRO COINCIDENCIA. == FALSE
           }
          mysqli_close($Con);
          $this->CON->desconectar(); 
    }

    public function selectpatente($TVEH_CODIGO){
           $this->CON = new Conexion();
            $Con = $this->CON->conectar();
            $sql="SELECT VEH_PATENTE from vehiculo WHERE TVEH_CODIGO='".$TVEH_CODIGO."';";
            $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"]
                                    );
                        $i++;
                
            } 
                    return $data;
        }else{
          $data = "error";
          return $data;
        }
          mysqli_close($Con);
          $this->CON->desconectar(); 
    }

    public function selecttipocombustible($TCOMB_CODIGO){
           $this->CON = new Conexion();
            $Con = $this->CON->conectar();
            $sql="SELECT a.VEH_CODIGO,b.TCOMB_CODIGO,b.TCOMB_NOMBRE from vehiculo AS a INNER JOIN tipo_combustible AS b on b.TCOMB_CODIGO=a.TCOMB_CODIGO WHERE a.VEH_PATENTE='".$TCOMB_CODIGO."';";
            $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"]
                                    );
                        $i++;
                
            } 
                    return $data;
        }else{
          $data = "error";
          return $data;
        }
          mysqli_close($Con);
          $this->CON->desconectar(); 
    }

    //este metodo devuelve el ultimo codigo de vehiculo agregado +1.
    public function getlastcodigovehiculo(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT VEH_CODIGO
  FROM vehiculo ORDER BY VEH_CODIGO DESC LIMIT 1";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"]
                                    );
                        $i++;
                
            } 
                    $cotid=$data[0]['VEH_CODIGO']+1;
                    return $cotid;
        }else {
            $cotid = 1;
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function getlastcodigocombustible(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT COMB_CODIGO
  FROM combustible ORDER BY COMB_CODIGO DESC LIMIT 1";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "COMB_CODIGO"            =>$row["COMB_CODIGO"]
                                    );
                        $i++;
                
            } 
                    $cotid=$data[0]['COMB_CODIGO']+1;
                    return $cotid;
        }else {
            $cotid = 1;
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function getchoferes(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT b.PER_RUT,b.PER_NOMBRE,b.PER_APELLIDO FROM personal AS b WHERE b.CAR_CODIGO=1";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "PER_RUT"            =>$row["PER_RUT"],
                                        "PER_NOMBRE"            =>$row["PER_NOMBRE"],
                                        "PER_APELLIDO"            =>$row["PER_APELLIDO"]
                                    );
                        $i++;
                
            } 
                    return $data;
        }else {
            $cotid="error";
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar(); 
    }

    public function gettipovehiculo(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_vehiculo";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"]
                                    );
                        $i++;
                
            } 
          return $data;
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function gettipocombustible(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_combustible";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"]
                                    );
                        $i++;
                
            } 
            return $data;
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function getmodelovehiculo(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT MVEH_CODIGO,MVEH_DESCRIPCION FROM modelo_vehiculo";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "MVEH_CODIGO"            =>$row["MVEH_CODIGO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"]
                                    );
                        $i++;
                
            } 
            return $data;
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    //este metodo agrega el vehiculo al servidor.
    public function createvehiculo($TCOMB_CODIGO,$TVEH_CODIGO,$MVEH_CODIGO,$VEH_PATENTE,$FEC_INGRESO,$VEH_NCHASIS){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO vehiculo (TCOMB_CODIGO,TVEH_CODIGO,MVEH_CODIGO,VEH_PATENTE,EVEH_CODIGO,FEC_DESHABILITAR,FEC_INGRESO,VEH_NCHASIS) VALUES ('".$TCOMB_CODIGO."','".$TVEH_CODIGO."','".$MVEH_CODIGO."','".$VEH_PATENTE."',1,'0000-00-00','".$FEC_INGRESO."','".$VEH_NCHASIS."');";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                return true;
            } else {
              echo $sql;
            $resultado = false;
            return $resultado;
            }
            mysqli_close($Con);
            $this->CON->desconectar();          
    }

    //Este metodo lista todos los vehiculos.
    public function listarvehiculos(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT a.VEH_CODIGO, a.VEH_PATENTE ,b.TCOMB_NOMBRE,c.TVEH_TIPOVEHICULO,d.MVEH_DESCRIPCION,e.EVEH_DESC,a.EVEH_CODIGO,a.VEH_NCHASIS FROM vehiculo AS a INNER JOIN tipo_combustible AS b ON b.TCOMB_CODIGO=a.TCOMB_CODIGO INNER JOIN tipo_vehiculo AS c ON c.TVEH_CODIGO=a.TVEH_CODIGO INNER JOIN modelo_vehiculo AS d ON d.MVEH_CODIGO=a.MVEH_CODIGO INNER JOIN estado_vehiculo AS e ON e.EVEH_CODIGO=a.EVEH_CODIGO WHERE a.EVEH_CODIGO=1";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"],
                                        "VEH_NCHASIS"            =>$row["VEH_NCHASIS"],
                                        "EVEH_DESC"            =>$row["EVEH_DESC"]
                                    );
                        $i++;
                
            } 
                    return $data;
        }else {
            $data="error";
            return $data;
           }
          mysqli_close($Con);
          $this->CON->desconectar();

    }

    //Este metodo busca los vehiculos con se respectivo estado
    public function selectestadovehiculo($estado){
            $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT a.VEH_CODIGO, a.VEH_PATENTE,a.EVEH_CODIGO ,b.TCOMB_NOMBRE,c.TVEH_TIPOVEHICULO,d.MVEH_DESCRIPCION,e.EVEH_DESC,a.VEH_NCHASIS FROM vehiculo AS a INNER JOIN tipo_combustible AS b ON b.TCOMB_CODIGO=a.TCOMB_CODIGO INNER JOIN tipo_vehiculo AS c ON c.TVEH_CODIGO=a.TVEH_CODIGO INNER JOIN modelo_vehiculo AS d ON d.MVEH_CODIGO=a.MVEH_CODIGO INNER JOIN estado_vehiculo AS e ON e.EVEH_CODIGO=a.EVEH_CODIGO WHERE (a.EVEH_CODIGO= '".$estado."') ORDER BY a.VEH_CODIGO ASC;";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"],
                                        "VEH_NCHASIS"            =>$row["VEH_NCHASIS"],
                                        "EVEH_DESC"            =>$row["EVEH_DESC"]
                                    );
                        $i++;
                
            } 
                    return $data;
        }else {
            $cotid="error";
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();
    }

    //Este metodo devuelve todos los vehiculo que coincian con el dato a buscar.
    public function filtervehiculo($datobuscar,$estado,$text){
                if($estado==0){
                  $data = "error";
                  return $data;
                }else{
                  if($text == "" || $text == null || !isset($text)){
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.VEH_CODIGO, a.VEH_PATENTE,a.EVEH_CODIGO ,b.TCOMB_NOMBRE,c.TVEH_TIPOVEHICULO,d.MVEH_DESCRIPCION,e.EVEH_DESC,a.VEH_NCHASIS FROM vehiculo AS a INNER JOIN tipo_combustible AS b ON b.TCOMB_CODIGO=a.TCOMB_CODIGO INNER JOIN tipo_vehiculo AS c ON c.TVEH_CODIGO=a.TVEH_CODIGO INNER JOIN modelo_vehiculo AS d ON d.MVEH_CODIGO=a.MVEH_CODIGO INNER JOIN estado_vehiculo AS e ON e.EVEH_CODIGO=a.EVEH_CODIGO WHERE (a.EVEH_CODIGO='".$estado."') ORDER BY a.VEH_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"],
                                        "VEH_NCHASIS"            =>$row["VEH_NCHASIS"],
                                        "EVEH_DESC"            =>$row["EVEH_DESC"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }  
                        mysqli_close($Con);
                        $this->CON->desconectar();
                  }else{
                      $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.VEH_CODIGO, a.VEH_PATENTE,a.EVEH_CODIGO ,b.TCOMB_NOMBRE,c.TVEH_TIPOVEHICULO,d.MVEH_DESCRIPCION,e.EVEH_DESC,a.VEH_NCHASIS FROM vehiculo AS a INNER JOIN tipo_combustible AS b ON b.TCOMB_CODIGO=a.TCOMB_CODIGO INNER JOIN tipo_vehiculo AS c ON c.TVEH_CODIGO=a.TVEH_CODIGO INNER JOIN modelo_vehiculo AS d ON d.MVEH_CODIGO=a.MVEH_CODIGO INNER JOIN estado_vehiculo AS e ON e.EVEH_CODIGO=a.EVEH_CODIGO WHERE (a.EVEH_CODIGO='".$estado."' && ".$datobuscar." like '".$text."%') ORDER BY a.VEH_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"],
                                        "VEH_NCHASIS"            =>$row["VEH_NCHASIS"],
                                        "EVEH_DESC"            =>$row["EVEH_DESC"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  }
                }
    }

    //Este metodo obtiene todos los datos de un vehiculo por su id.
    public function getvehiculo($VEH_CODIGO){
               $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT a.VEH_CODIGO, a.VEH_PATENTE,a.EVEH_CODIGO ,b.TCOMB_NOMBRE,c.TVEH_TIPOVEHICULO,d.MVEH_DESCRIPCION,e.EVEH_DESC,a.TCOMB_CODIGO,a.TVEH_CODIGO,a.MVEH_CODIGO, a.FEC_DESHABILITAR,a.FEC_INGRESO,a.VEH_NCHASIS FROM vehiculo AS a INNER JOIN tipo_combustible AS b ON b.TCOMB_CODIGO=a.TCOMB_CODIGO INNER JOIN tipo_vehiculo AS c ON c.TVEH_CODIGO=a.TVEH_CODIGO INNER JOIN modelo_vehiculo AS d ON d.MVEH_CODIGO=a.MVEH_CODIGO INNER JOIN estado_vehiculo AS e ON e.EVEH_CODIGO=a.EVEH_CODIGO WHERE (a.VEH_CODIGO=".$VEH_CODIGO.");";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "FEC_DESHABILITAR"            =>$row["FEC_DESHABILITAR"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "MVEH_CODIGO"            =>$row["MVEH_CODIGO"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"],
                                        "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                        "FEC_INGRESO"            =>$row["FEC_INGRESO"],
                                        "VEH_NCHASIS"            =>$row["VEH_NCHASIS"],
                                        "EVEH_DESC"            =>$row["EVEH_DESC"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            } 
            mysqli_close($Con);
            $this->CON->desconectar(); 
    }

  //Este metodo devuelve todos los estados con su descripción.
    public function getestados(){
            $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT EVEH_CODIGO,EVEH_DESC FROM estado_vehiculo";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                        "EVEH_DESC"            =>$row["EVEH_DESC"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            } 
            mysqli_close($Con);
            $this->CON->desconectar();
    }

    //Este metodo de vuelve todos los combutibles disponibles.
    public function getcombustible(){
            $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT TCOMB_CODIGO,TCOMB_NOMBRE FROM tipo_combustible";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            } 
            mysqli_close($Con);
            $this->CON->desconectar();
    }

    public function getmodelos(){
            $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT MVEH_CODIGO,MVEH_DESCRIPCION FROM modelo_vehiculo";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "MVEH_CODIGO"            =>$row["MVEH_CODIGO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            } 
            mysqli_close($Con);
            $this->CON->desconectar();
    }

    public function gettipovehiculos(){
            $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT TVEH_CODIGO,TVEH_TIPOVEHICULO FROM tipo_vehiculo";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            } 
            mysqli_close($Con);
            $this->CON->desconectar();
    }

  //Este metodo se encarga de modificar el resgistro del vehiculo.
  public function modificarvehiculo($TCOMB_CODIGO,$TVEH_CODIGO,$MVEH_CODIGO,$VEH_PATENTE,$EVEH_CODIGO,$FEC_DESHABILITAR,$FEC_INGRESO,$VEH_NCHASIS,$VEH_CODIGO){
            $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE vehiculo SET "
                        . "TCOMB_CODIGO='".$TCOMB_CODIGO."', "
                        . "TVEH_CODIGO='".$TVEH_CODIGO."', "
                        . "MVEH_CODIGO='".$MVEH_CODIGO."', "
                        . "VEH_PATENTE='".$VEH_PATENTE."', "
                        . "EVEH_CODIGO='".$EVEH_CODIGO."', "
                        . "FEC_DESHABILITAR='".$FEC_DESHABILITAR."', "
                        . "FEC_INGRESO='".$FEC_INGRESO."', "
                        . "VEH_NCHASIS='".$VEH_NCHASIS."' "
                        . "WHERE VEH_CODIGO='".$VEH_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                  //echo $sql;
                    return true;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $resultado = false;
                    return $resultado;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }     
  }  

  //Este metodo cambia de estado el vehiculo.
  public function eliminarvehiculo($VEH_CODIGO,$FEC_DESHABILITAR){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE vehiculo SET "
                        . "EVEH_CODIGO='2', "
                        . "FEC_DESHABILITAR='".$FEC_DESHABILITAR."' "
                        . "WHERE VEH_CODIGO='".$VEH_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                }else{
                    $resultado = false;
                    return $resultado;
                }
      mysqli_close($Con);
      $this->CON->desconectar();               
  }

  //Este metodo habilita el estado del vehiculo.
  public function habilitarvehiculo($VEH_CODIGO){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE vehiculo SET "
                        . "EVEH_CODIGO='1', "
                        . "FEC_DESHABILITAR='' "
                        . "WHERE VEH_CODIGO='".$VEH_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                }else{
                    $resultado = false;
                    return $resultado;
                }
      mysqli_close($Con);
      $this->CON->desconectar();               
  }

}
?>
