<?php
include_once('Conexion.php');
class Proveedor {
   var $CON;
   
       public function ListarRazonSocialPROV(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM razon_social WHERE (TIP_CODIGO='PRO') OR (TIP_CODIGO='CPR') ORDER BY RAZ_NOMBRE asc";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"           =>$row["RAZ_CODIGO"],
                                        "tipcod"           =>$row["TIP_CODIGO"],
					"rut"           =>$row["RAZ_RUT"],
                                        "nom"           =>$row["RAZ_NOMBRE"],
					"dire"          =>$row["RAZ_DIRECCION"],
					"ema"           =>$row["RAZ_CORREO"],
					"ciu"           =>$row["RAZ_CIUDAD"],
					"fono"          =>$row["RAZ_TELEFONO"],
                                        "cven"          =>$row["RAZ_CONDVENTA"],
                                        "giro"          =>$row["RAZ_GIRO"],
                                        "efact"          =>$row["RAZ_ENTGFACTURA"],
                                        "estpago"          =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "esp"          =>$row["RAZ_ESPECIAL"]
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
   
   
   
   
   
   function listProveedor(){
            $this->CON =new Conexion();
             $Con=$this->CON->conectar();
              $sql = "SELECT * FROM proveedor ORDER BY PROV_CODIGO asc";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"           =>$row["PROV_CODIGO"],
                                        "codrs"           =>$row["RAZ_CODIGO"],
					"nompro"           =>$row["PROV_DESCRIPCION"],
                                        "valuni"           =>$row["PROV_PRECIOUNI"],
					"descuento"          =>$row["PROV_DESCUENTO"]
			
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
   
   function BusqProvId($codrs){
            $this->CON =new Conexion();
             $Con=$this->CON->conectar();
              $sql = "SELECT * FROM proveedor WHERE RAZ_CODIGO=".$codrs;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"           =>$row["PROV_CODIGO"],
                                        "codrs"           =>$row["RAZ_CODIGO"],
					"pro"           =>$row["PROV_PRODUCTO"],
                                        "valuni"           =>$row["PROV_PRECIOUNI"],
					"descuento"          =>$row["PROV_DESCUENTO"]
			
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
   
   
   function AgregarProveedor($codrs, $nomprod, $valuni, $descuento){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO proveedor (RAZ_CODIGO,PROV_PRODUCTO,PROV_PRECIOUNI,PROV_DESCUENTO) "
                  . " VALUES (".$codrs.",'".$nomprod."',".$valuni.",".$descuento.")";
             $resultado=mysqli_query($Con, $sql);
     /*       if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     */     mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
   }
   function EditarESPProveedor($codrs,$esp){
        $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE razon_social SET "
                     . "RAZ_ESPECIAL='".$esp."' "
                     . " WHERE RAZ_CODIGO=".$codrs;
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
   
   function EditarProveedor($provcod,$nomprod,$valuni,$desc){
        $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE proveedor SET "
                     . "PROV_PRODUCTO='".$nomprod."', "
                     . "PROV_PRECIOUNI=".$valuni.", "
                     . "PROV_DESCUENTO=".$desc
                     . " WHERE PROV_CODIGO=".$provcod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
              //  echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
   }
   function BorrarElemProv($cod){
       $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM proveedor WHERE PROV_CODIGO=".$cod;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
   }
}
