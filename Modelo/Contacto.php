<?php
include_once('Conexion.php');

class Contacto{
    var $CON;
    
function generarCodigoAleatorio($longitud) {
 $key = '';
 $pattern = '1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) {
 $key .= $pattern[mt_rand(0,$max)];
  }
 return $key;
}
 
 
function generarCodigoSecuencial(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql="SELECT MAX(CON_CODIGO) as valor FROM contacto"; 
             $resultado=mysqli_query($Con, $sql);
             $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "val"           =>$row["valor"]
					);
                        $i++;
		}
             $cod=$data[0]['val']+1;
             return $cod;
}

    public function validarRutrs($rutrs){
      
        if(strlen($rutrs)==10){
        $NumVal=[3,2,7,6,5,4,3,2];
        $Suma=0;
        $Numero= substr($rutrs,0,8);
        $Digito= substr($rutrs,-1);
        $RutNum = str_split($Numero);
        $i=0;
        while($i< strlen($Numero)){
            $Prod=$RutNum[$i]*$NumVal[$i];
            $Suma=$Suma+$Prod;
          $i++;  
        }
        $Modulo=$Suma%11; //calculo de modulo
        $DigCalculo=11-$Modulo;
       if($DigCalculo==11){
                $DigCalculo=0;
            }else if($DigCalculo==10){
                $DigCalculo="K";
            }
        if (strval($DigCalculo)==strval($Digito)){
            return $Valida=true;
            }else{
            return $Valida=false;
            }
        }else if(strlen($rutrs)==9){
        $NumVal=[2,7,6,5,4,3,2]; //6226980-4
        $Suma=0;
        $Numero= substr($rutrs,0,7);
        $Digito= substr($rutrs,-1);
        $RutNum = str_split($Numero);
        $i=0;
        while($i< strlen($Numero)){
            $Prod=$RutNum[$i]*$NumVal[$i];
            $Suma=$Suma+$Prod;
          $i++;  
        }
        $Modulo=$Suma%11; //calculo de modulo
        $DigCalculo=11-$Modulo;
            if($DigCalculo==11){
                $DigCalculo=0;
            }else if($DigCalculo==10){
                $DigCalculo="K";
            }
        if (strval($DigCalculo)==strval($Digito)){
            return $Valida=true;
            }else{
            return $Valida=false;
            }
            
        
        }else{
            return $Valida=false;
            
        }        
        
        }
     
    public function validarCodigors($codrs){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT COUNT(*) as cantidad FROM contacto WHERE CON_CODIGO=".$codrs;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro encontrado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
    }
    
    public function AgregarContacto($codcli,$estcod,$codrs,$codsx,$nomcli,$apecli,$fonocli,$celcli,$cargo,$mailcli,$obs){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO contacto (CON_CODIGO,EST_CODIGO,RAZ_CODIGO,SEX_CODIGO,CON_NOMBRE,CON_APELLIDO,CON_TELEFONO,CON_CELULAR,CON_CARGO,CON_CORREO,CON_OBS) "
                  . " VALUES (".$codcli.",".$estcod.",".$codrs.",'".$codsx."','".$nomcli."','".$apecli."',".$fonocli.",".$celcli.",'".$cargo."','".$mailcli."','".$obs."')";
             $resultado=mysqli_query($Con, $sql);
          /*  if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
          */
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
    }
    
     public function EditarCliente($codcli,$estcodcli,$codrs,$codsx,$nomcli,$apecli,$fonocli,$celcli,$cargo,$mailcli,$obs){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE contacto SET "
                     . "EST_CODIGO=".$estcodcli.", "
                     . "RAZ_CODIGO=".$codrs.", "
                     . "SEX_CODIGO='".$codsx."', "
                     . "CON_NOMBRE='".$nomcli."', "
                     . "CON_APELLIDO='".$apecli."', "
                     . "CON_TELEFONO=".$fonocli.", "
                     . "CON_CELULAR=".$celcli.", "
                     . "CON_CARGO='".$cargo."', "
                     . "CON_CORREO='".$mailcli."', "
                     . "CON_OBS='".$obs."'"
                     . "WHERE CON_CODIGO=".$codcli;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    public function EditarContactos($codcli,$estcodcli,$codsx,$nomcli,$apecli,$fonocli,$celcli,$cargo,$mailcli,$obs){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE contacto SET "
                     . "EST_CODIGO=".$estcodcli.", "
                     . "SEX_CODIGO='".$codsx."', "
                     . "CON_NOMBRE='".$nomcli."', "
                     . "CON_APELLIDO='".$apecli."', "
                     . "CON_TELEFONO=".$fonocli.", "
                     . "CON_CELULAR=".$celcli.", "
                     . "CON_CARGO='".$cargo."', "
                     . "CON_CORREO='".$mailcli."', "
                     . "CON_OBS='".$obs."' "
                     . "WHERE CON_CODIGO=".$codcli;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    
     public function BorrarCliente($codcli){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM contacto WHERE CON_CODIGO=".$codcli;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    public function ContarContactos($razcod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT COUNT(*) AS cantidad  FROM contacto WHERE (RAZ_CODIGO=".$razcod.") AND not(EST_CODIGO=3)";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cant"            =>$row["cantidad"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
      public function ListarContacto($razcod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM contacto AS c "
                   . " INNER JOIN razon_social AS r "
                   . " ON c.RAZ_CODIGO = r.RAZ_CODIGO "
                   . " INNER JOIN estado_usuario AS est "
                   . " ON c.EST_CODIGO = est.EST_CODIGO"
                   . " INNER JOIN sexo AS sx "
                   . " ON c.SEX_CODIGO = sx.SEX_CODIGO"  
                   . " WHERE c.RAZ_CODIGO=".$razcod;
              $sql.=" ORDER BY CON_CODIGO ASC ";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["CON_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cel"            =>$row["CON_CELULAR"],
                                        "cargo"            =>$row["CON_CARGO"],
                                        "mail"            =>$row["CON_CORREO"],
                                        "obs"            =>$row["CON_OBS"],
                                        "rutrs"            =>$row["RAZ_RUT"],
                                        "nomrs"            =>$row["RAZ_NOMBRE"],
					"dirers"           =>$row["RAZ_DIRECCION"],
					"emars"            =>$row["RAZ_CORREO"],
					"fonors"           =>$row["RAZ_TELEFONO"],
                                        "sexo"            =>$row["SEX_NOMBRE"],
                                        "direreal"          =>$row["RAZ_DIRERAZON"],
                                        "estado"          =>$row["EST_ESTADOUSER"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
    
    public function ListarCliente(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM contacto ORDER BY CON_APELLIDO asc";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["CON_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cel"            =>$row["CON_CELULAR"],
                                        "cargo"            =>$row["CON_CARGO"],
                                        "mail"            =>$row["CON_CORREO"],
                                        "obs"            =>$row["CON_OBS"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
      
      public function ListarClienteConRazonSocial(){
          $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql=" SELECT * FROM contacto AS c "
             . " INNER JOIN razon_social AS r "
             . " ON c.RAZ_CODIGO = r.RAZ_CODIGO";
          $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["CLI_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "tipc"           =>$row["TIP_CODIGO"],
					"razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cel"            =>$row["CON_CELULAR"],
                                        "mail"           =>$row["CON_CORREO"],
                                        "cargo"           =>$row["CON_CARGO"],
                                        "obs"           =>$row["CON_OBS"],
                                        "cven"           =>$row["RAZ_CONDVENTA"],
					"giro"           =>$row["RAZ_GIRO"],
					"efact"          =>$row["RAZ_ENTGFACTURA"],
					"rutrs"            =>$row["RAZ_RUT"],
                                        "nomrs"            =>$row["RAZ_NOMBRE"],
					"dirers"           =>$row["RAZ_DIRECCION"],
					"emars"            =>$row["RAZ_CORREO"],
					"ciurs"            =>$row["RAZ_CIUDAD"],
                                        "esp"             =>$row["RAZ_ESPECIAL"],
                                        "estpago"         =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "direreal"          =>$row["RAZ_DIRERAZON"],
					"fonors"           =>$row["RAZ_TELEFONO"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
      
      
    
    public function BuscarClienteRut($rut){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM contacto AS c "
                  . " INNER JOIN razon_social AS r "
                  . " ON c.RAZ_CODIGO = r.RAZ_CODIGO "
                  . "GROUP BY RAZ_RUT ORDER BY CON_APELLIDO asc";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["CON_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "tipc"           =>$row["TIP_CODIGO"],
					"razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cven"           =>$row["RAZ_CONDVENTA"],
					"giro"           =>$row["RAZ_GIRO"],
					"efact"          =>$row["RAZ_ENTGFACTURA"],
                                        "esp"             =>$row["RAZ_ESPECIAL"],
                                        "estpago"         =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "direreal"          =>$row["RAZ_DIRERAZON"],
					"cel"            =>$row["CON_CELULAR"],
                                        "mail"            =>$row["CON_CORREO"],
                                        "obs"            =>$row["CON_OBS"],
                                        "cargo"            =>$row["CON_CARGO"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
      
        public function ListarClienteFULL(){
          $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql=" SELECT * FROM razon_social AS r "
             . " INNER JOIN contacto AS c "
             . " ON r.RAZ_CODIGO = c.RAZ_CODIGO"
             . " INNER JOIN tipo_usuario AS tusu "
             . " ON r.TIP_CODIGO = tusu.TIP_CODIGO"
             . " INNER JOIN estado_usuario AS est "
             . " ON c.EST_CODIGO = est.EST_CODIGO"
             . " INNER JOIN sexo AS sx "
             . " ON c.SEX_CODIGO = sx.SEX_CODIGO"
             . " INNER JOIN cliente_servicio AS s "
             . " ON r.RAZ_CODIGO = s.RAZ_CODIGO"
             . " INNER JOIN tipo_servicio AS tser "
             . " ON s.TIPS_CODIGO = tser.TIPS_CODIGO";
             
          $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["CON_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "tipc"           =>$row["TIP_CODIGO"],
					"razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
                                        "tips"           =>$row["TIPS_CODIGO"],
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cel"            =>$row["CON_CELULAR"],
                                        "mail"           =>$row["CON_CORREO"],
                                        "cargo"           =>$row["CON_CARGO"],
                            		"obsc"           =>$row["CON_OBS"],
                                        "cven"           =>$row["RAZ_CONDVENTA"],
					"giro"           =>$row["RAZ_GIRO"],
					"efact"          =>$row["RAZ_ENTGFACTURA"],
	                                "rutrs"           =>$row["RAZ_RUT"],
                                        "nomrs"           =>$row["RAZ_NOMBRE"],
					"dirers"          =>$row["RAZ_DIRECCION"],
					"emars"           =>$row["RAZ_CORREO"],
					"ciurs"           =>$row["RAZ_CIUDAD"],
					"fonors"          =>$row["RAZ_TELEFONO"],
                                        "esp"             =>$row["RAZ_ESPECIAL"],
                                        "estpago"         =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "direreal"          =>$row["RAZ_DIRERAZON"],
                                        "serc"            =>$row["CSER_CODIGO"],
                                        "vbanho"          =>$row["CSER_VALORARRIENDOBANHO"],
					"cbanho"          =>$row["CSER_CANTBANHO"],
					"msemana"         =>$row["CSER_MANTSEMANAL"],
					"fact"            =>$row["CSER_FECHACIERREFACTURA"],
					"vlimpf"          =>$row["CSER_VALORLIMPFOSA"],
                                        "area"            =>$row["CSER_AREA"],
					"otro"            =>$row["CSER_OTROS"],
                                        "obs"             =>$row["CSER_OBS"],
                                        "vale"            =>$row["CSER_VALORENTREGA"],
					"valr"           =>$row["CSER_VALORRETIRO"],
                                        "sexo"            =>$row["SEX_NOMBRE"],
                                        "estado"          =>$row["EST_ESTADOUSER"],
                                        "tipusu"          =>$row["TIP_TIPOUSER"],
                                        "tipser"          =>$row["TIPS_NOMBRE"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
        public function ListarClienteFULL3(){
          $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql=" SELECT * FROM razon_social AS r "
             . " INNER JOIN contacto AS c "
             . " ON r.RAZ_CODIGO = c.RAZ_CODIGO"
             . " INNER JOIN tipo_usuario AS tusu "
             . " ON r.TIP_CODIGO = tusu.TIP_CODIGO"
             . " INNER JOIN estado_usuario AS est "
             . " ON c.EST_CODIGO = est.EST_CODIGO"
             . " INNER JOIN sexo AS sx "
             . " ON c.SEX_CODIGO = sx.SEX_CODIGO"
             . " INNER JOIN cliente_servicio AS s "
             . " ON r.RAZ_CODIGO = s.RAZ_CODIGO"
             . " INNER JOIN tipo_servicio AS tser "
             . " ON s.TIPS_CODIGO = tser.TIPS_CODIGO"
             . " GROUP BY r.RAZ_CODIGO ORDER BY r.RAZ_NOMBRE ASC";
          $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["CON_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "tipc"           =>$row["TIP_CODIGO"],
					"razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
                                        "tips"           =>$row["TIPS_CODIGO"],
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cel"            =>$row["CON_CELULAR"],
                                        "mail"           =>$row["CON_CORREO"],
                                        "cargo"           =>$row["CON_CARGO"],
                            		"obsc"           =>$row["CON_OBS"],
                                        "cven"           =>$row["RAZ_CONDVENTA"],
					"giro"           =>$row["RAZ_GIRO"],
					"efact"          =>$row["RAZ_ENTGFACTURA"],
	                                "rutrs"           =>$row["RAZ_RUT"],
                                        "nomrs"           =>$row["RAZ_NOMBRE"],
					"dirers"          =>$row["RAZ_DIRECCION"],
					"emars"           =>$row["RAZ_CORREO"],
					"ciurs"           =>$row["RAZ_CIUDAD"],
					"fonors"          =>$row["RAZ_TELEFONO"],
                                        "esp"             =>$row["RAZ_ESPECIAL"],
                                        "estpago"         =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "direreal"          =>$row["RAZ_DIRERAZON"],
                                        "serc"            =>$row["CSER_CODIGO"],
                                        "vbanho"          =>$row["CSER_VALORARRIENDOBANHO"],
					"cbanho"          =>$row["CSER_CANTBANHO"],
					"msemana"         =>$row["CSER_MANTSEMANAL"],
					"fact"            =>$row["CSER_FECHACIERREFACTURA"],
					"vlimpf"          =>$row["CSER_VALORLIMPFOSA"],
                                        "area"            =>$row["CSER_AREA"],
					"otro"            =>$row["CSER_OTROS"],
                                        "obs"             =>$row["CSER_OBS"],
                                        "vale"            =>$row["CSER_VALORENTREGA"],
					"valr"           =>$row["CSER_VALORRETIRO"],
                                        "sexo"            =>$row["SEX_NOMBRE"],
                                        "estado"          =>$row["EST_ESTADOUSER"],
                                        "tipusu"          =>$row["TIP_TIPOUSER"],
                                        "tipser"          =>$row["TIPS_NOMBRE"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
          public function ListarClienteFULL2(){
          $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql=" SELECT * FROM razon_social AS r "
             . " INNER JOIN contacto AS c "
             . " ON r.RAZ_CODIGO = c.RAZ_CODIGO"
             . " INNER JOIN tipo_usuario AS tusu "
             . " ON r.TIP_CODIGO = tusu.TIP_CODIGO"
             . " INNER JOIN estado_usuario AS est "
             . " ON c.EST_CODIGO = est.EST_CODIGO"
             . " INNER JOIN sexo AS sx "
             . " ON c.SEX_CODIGO = sx.SEX_CODIGO"
             . " INNER JOIN cliente_servicio AS s "
             . " ON r.RAZ_CODIGO = s.RAZ_CODIGO"
             . " INNER JOIN tipo_servicio AS tser "
             . " ON s.TIPS_CODIGO = tser.TIPS_CODIGO"
             . " GROUP BY r.RAZ_CODIGO ";
          $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["CON_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "tipc"           =>$row["TIP_CODIGO"],
					"razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
                                        "tips"           =>$row["TIPS_CODIGO"],
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cel"            =>$row["CON_CELULAR"],
                                        "mail"           =>$row["CON_CORREO"],
                                        "cargo"           =>$row["CON_CARGO"],
                            		"obsc"           =>$row["CON_OBS"],
                                        "cven"           =>$row["RAZ_CONDVENTA"],
					"giro"           =>$row["RAZ_GIRO"],
					"efact"          =>$row["RAZ_ENTGFACTURA"],
	                                "rutrs"           =>$row["RAZ_RUT"],
                                        "nomrs"           =>$row["RAZ_NOMBRE"],
					"dirers"          =>$row["RAZ_DIRECCION"],
					"emars"           =>$row["RAZ_CORREO"],
					"ciurs"           =>$row["RAZ_CIUDAD"],
					"fonors"          =>$row["RAZ_TELEFONO"],
                                        "esp"             =>$row["RAZ_ESPECIAL"],
                                        "estpago"         =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "direreal"          =>$row["RAZ_DIRERAZON"],
                                        "serc"            =>$row["CSER_CODIGO"],
                                        "vbanho"          =>$row["CSER_VALORARRIENDOBANHO"],
					"cbanho"          =>$row["CSER_CANTBANHO"],
					"msemana"         =>$row["CSER_MANTSEMANAL"],
					"fact"            =>$row["CSER_FECHACIERREFACTURA"],
					"vlimpf"          =>$row["CSER_VALORLIMPFOSA"],
                                        "area"            =>$row["CSER_AREA"],
					"otro"            =>$row["CSER_OTROS"],
                                        "obs"             =>$row["CSER_OBS"],
                                        "vale"            =>$row["CSER_VALORENTREGA"],
					"valr"           =>$row["CSER_VALORRETIRO"],
                                        "sexo"            =>$row["SEX_NOMBRE"],
                                        "estado"          =>$row["EST_ESTADOUSER"],
                                        "tipusu"          =>$row["TIP_TIPOUSER"],
                                        "tipser"          =>$row["TIPS_NOMBRE"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
      
      public function BusqCliDato($op,$dato,$tusu){
          $this->CON =new Conexion();
          $Con=$this->CON->conectar();
        $sql=" SELECT * FROM razon_social AS r "
             . " INNER JOIN contacto AS c "           //CONTACTO
             . " ON r.RAZ_CODIGO = c.RAZ_CODIGO"
             . " INNER JOIN tipo_usuario AS tusu "    //TIPO USUARIO
             . " ON r.TIP_CODIGO = tusu.TIP_CODIGO"
             . " INNER JOIN estado_usuario AS est "   //ESTADO USUARIO
             . " ON c.EST_CODIGO = est.EST_CODIGO"
             . " INNER JOIN sexo AS sx "              //SEXO
             . " ON c.SEX_CODIGO = sx.SEX_CODIGO"
             . " INNER JOIN cliente_servicio AS s "   //CLIENTE SERVICIO
             . " ON r.RAZ_CODIGO = s.RAZ_CODIGO"
             . " INNER JOIN tipo_servicio AS tser "   //TIPO SERVICIO
             . " ON s.TIPS_CODIGO = tser.TIPS_CODIGO";
          switch($op){
              case 0 : $sql.=" WHERE r.TIP_CODIGO='". $tusu."' AND r.RAZ_CODIGO=".$dato;
              break;
              case 1 : $sql.= " WHERE r.TIP_CODIGO='".$tusu."' AND r.RAZ_RUT LIKE '%".$dato."%'";
              break;
              case 2 : $sql.= " WHERE r.TIP_CODIGO='".$tusu."' AND r.RAZ_NOMBRE LIKE '%".$dato."%'";
              break;
              case 3 : $sql.= " WHERE r.TIP_CODIGO='".$tusu."' AND r.RAZ_CORREO LIKE '%".$dato."%'";
              break;
              case 4 : $sql.= " WHERE r.TIP_CODIGO='".$tusu."' AND c.CON_NOMBRE LIKE '%".$dato."%'";
              break;
              case 5 : $sql.= " WHERE r.TIP_CODIGO='".$tusu."' AND c.CON_APELLIDO LIKE '%".$dato."%'";
              break;
              case 6 : $sql.=" WHERE r.TIP_CODIGO='". $tusu."' AND c.CON_CORREO LIKE '%".$dato."%'";
              break;
              case 7 : $sql.=" WHERE TIP_TIPOUSER LIKE '%".$dato."%'";
              break;
              case 8 : $sql.=" WHERE r.TIP_CODIGO='". $tusu."' AND tser.TIPS_NOMBRE LIKE '%".$dato."%'";
              break;
              case 9 : $sql.=" WHERE RAZ_RUT='".$dato."'";
              break;
              default: $sql.=" ";
              break;
          }
          $sql.=" GROUP BY r.RAZ_CODIGO ";
          
          $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		       $data[$i]=array(
                                        "cod"            =>$row["CON_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "tipc"           =>$row["TIP_CODIGO"],
					"razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
                                        "tips"           =>$row["TIPS_CODIGO"],
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cel"            =>$row["CON_CELULAR"],
                                        "mail"           =>$row["CON_CORREO"],
                                        "cargo"          =>$row["CON_CARGO"],
                            		"obsc"           =>$row["CON_OBS"],
                                        "cven"           =>$row["RAZ_CONDVENTA"],
					"giro"           =>$row["RAZ_GIRO"],
					"efact"          =>$row["RAZ_ENTGFACTURA"],
	                                "rutrs"          =>$row["RAZ_RUT"],
                                        "nomrs"           =>$row["RAZ_NOMBRE"],
					"dirers"          =>$row["RAZ_DIRECCION"],
					"emars"           =>$row["RAZ_CORREO"],
					"ciurs"           =>$row["RAZ_CIUDAD"],
					"fonors"          =>$row["RAZ_TELEFONO"],
                                        "esp"             =>$row["RAZ_ESPECIAL"],
                                        "estpago"         =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "estpago"         =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "direreal"        =>$row["RAZ_DIRERAZON"],
                                        "serc"            =>$row["CSER_CODIGO"],
                                        "vbanho"          =>$row["CSER_VALORARRIENDOBANHO"],
					"cbanho"          =>$row["CSER_CANTBANHO"],
					"msemana"         =>$row["CSER_MANTSEMANAL"],
					"fact"            =>$row["CSER_FECHACIERREFACTURA"],
					"vlimpf"          =>$row["CSER_VALORLIMPFOSA"],
                                        "area"            =>$row["CSER_AREA"],
					"otro"            =>$row["CSER_OTROS"],
                                        "obs"             =>$row["CSER_OBS"],
                                        "vale"            =>$row["CSER_VALORENTREGA"],
					"valr"           =>$row["CSER_VALORRETIRO"],
                                        "sexo"            =>$row["SEX_NOMBRE"],
                                        "estado"          =>$row["EST_ESTADOUSER"],
                                        "tipusu"          =>$row["TIP_TIPOUSER"],
                                        "tipser"          =>$row["TIPS_NOMBRE"],
                                        //cliente servicio duchas y fosas
                                        "cser_cantfosas"  =>$row["CSER_CANTFOSAS"],
                                        "cser_cantducha"  =>$row["CSER_CANTDUCHA"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
      
      
}