<?php
include_once('Conexion.php');
//include("../Controlador/ctrl_alertas.php");

 class Agenda{
      var $CON;
       
     public function AgregarContactoAgenda($codsx, $name, $ape, $email, $cel, $fono, $dire, $obs, $face, $web, $twitter){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO agenda (SEX_CODIGO, AGE_NOMBRES, AGE_APELLIDOS, AGE_CORREO, AGE_CELULAR, AGE_TELEFONO, AGE_DIRECCION, AGE_OBS, AGE_FACEBOOK, AGE_WEB, AGE_TWITTER) "
                  . " VALUES ('".$codsx."','".$name."','".$ape."','".$email."',".$cel.",".$fono.",'".$dire."','".$obs."','".$face."','".$web."','".$twitter."')";
             $resultado=mysqli_query($Con, $sql);
            /*if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            */
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    
       public function EditarContactoAgenda($name, $ape, $fono, $email, $dire, $codigo){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE agenda SET "
                     . "AGE_NOMBRES='".$name."', "
                     . "AGE_APELLIDO='".$ape."', "
                     . "AGE_TELEFONO=".$fono.", "
                     . "AGE_CORREO='".$email."', "
                     . "AGE_DIRECCION='".$dire."' "
                     . "WHERE AGE_CODIGO=".$codigo;
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
    
     public function BorrarContactosAgenda($cod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM agenda WHERE AGE_CODIGO=".$cod;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    public function ListarContactosAgenda(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM agenda ORDER BY AGE_APELLIDO asc";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"           =>$row["AGE_CODIGO"],
					"nombre"	=>$row["AGE_NOMBRES"],
					"ape"           =>$row["AGE_APELLIDO"],
					"ema"           =>$row["AGE_CORREO"],
					"fono"          =>$row["AGE_TELEFONO"],
					"dire"          =>$row["AGE_DIRECCION"]
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
    
    public function BusquedaContactoAgendaLetra($letra){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM agenda WHERE AGE_APELLIDO LIKE '".$letra."%' ORDER BY AGE_APELLIDO asc";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
             //  echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"           =>$row["AGE_CODIGO"],
					"nombre"	=>$row["AGE_NOMBRES"],
					"ape"           =>$row["AGE_APELLIDO"],
					"ema"           =>$row["AGE_CORREO"],
					"fono"          =>$row["AGE_TELEFONO"],
					"dire"          =>$row["AGE_DIRECCION"]
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
    
    public function BusquedaContactoAgendaCodigo($codigo){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM agenda WHERE AGE_CODIGO =".$codigo;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
             //echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"           =>$row["AGE_CODIGO"],
					"nombre"	=>$row["AGE_NOMBRES"],
					"ape"           =>$row["AGE_APELLIDO"],
					"ema"           =>$row["AGE_CORREO"],
					"fono"          =>$row["AGE_TELEFONO"],
					"dire"          =>$row["AGE_DIRECCION"]
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