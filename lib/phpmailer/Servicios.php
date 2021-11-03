<?php
include_once('Conexion.php');

class Servicios{
        var $CON;
        
    public function ServicioExiste($codcli){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = $sql = "SELECT COUNT(*) as cantidad FROM cliente_servicio WHERE CLI_CODIGO=".$codcli;
             $resultado=mysqli_query($Con, $sql);
             if ($resultado) {
                 $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "val"            =>$row["cantidad"]
					);
                        $i++;
		}
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
    }


    
    public function AgrearServicio($codrs,$tipscod,$serValorBanho,$serCantbanho,$serMant,$serFact,$serValFosa,
    $serArea,$serOtro,$serObs,$vale,$valr,$cser_cantfosas,$cser_cantducha){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO cliente_servicio(RAZ_CODIGO, TIPS_CODIGO, CSER_VALORARRIENDOBANHO, ". 
             "CSER_CANTBANHO, CSER_MANTSEMANAL, CSER_FECHACIERREFACTURA, CSER_VALORLIMPFOSA, CSER_AREA, ". 
             "CSER_OTROS, CSER_OBS, CSER_VALORENTREGA, CSER_VALORRETIRO, CSER_CANTFOSAS, CSER_CANTDUCHA) ".
             "VALUES (".$codrs.",".$tipscod.",".$serValorBanho.",".$serCantbanho.",".$serMant.",'".$serFact."',".
             $serValFosa.",'".$serArea."','".$serOtro."','".$serObs."',".$vale.",".$valr.",".
             $cser_cantfosas.",".$cser_cantducha.")";
             $resultado=mysqli_query($Con, $sql);
          if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
         
     
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
    }
    
     public function EditarServicio($codser,$tipser, $serValorBanho, $serCantbanho, $serMant, $serFact,
     $serValFosa, $serArea, $serOtro, $serObs,$vale, $valr, $cser_cantfosas, $cser_cantducha){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE cliente_servicio SET "
                     . "TIPS_CODIGO= ".$tipser.", "
                     . "CSER_VALORARRIENDOBANHO=".$serValorBanho.", "
                     . "CSER_CANTBANHO=".$serCantbanho.", "
                     . "CSER_MANTSEMANAL=".$serMant.", "
                     . "CSER_FECHACIERREFACTURA='".$serFact."', "
                     . "CSER_VALORLIMPFOSA=".$serValFosa.", "
                     . "CSER_AREA='".$serArea."', "
                     . "CSER_OTROS='".$serOtro."', "
                     . "CSER_OBS='".$serObs."', "
                     . "CSER_VALORENTREGA=".$vale.", "
                     . "CSER_VALORRETIRO=".$valr.", "
                     . "CSER_CANTFOSAS=".$cser_cantfosas.", "
                     . "CSER_CANTDUCHA=".$cser_cantducha." "
                     . "WHERE CSER_CODIGO=".$codser;
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
    
     public function BorrarServicio($sercod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM cliente_servicio WHERE CSER_CODIGO=".$sercod;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    public function ListarServicios(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM cliente_servicio ORDER BY CSER_CODIGO asc";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "sercod"            =>$row["CSER_CODIGO"],
					"clicod"           =>$row["RAZ_CODIGO"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "vbanho"           =>$row["CSER_VALORARRIENDOBANHO"],
					"cbanho"           =>$row["CSER_CANTBANHO"],
					"msemana"           =>$row["CSER_MANTSEMANAL"],
					"fact"            =>$row["CSER_FECHACIERREFACTURA"],
					"vlimpf"            =>$row["CSER_VALORLIMPFOSA"],
                                        "area"            =>$row["CSER_AREA"],
					"otro"           =>$row["CSER_OTROS"],
                                        "obs"           =>$row["CSER_OBS"],
                                        "vale"            =>$row["CSER_VALORENTREGA"],
					"valr"           =>$row["CSER_VALORRETIRO"]
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
    
    public function BuscarServicio($sercod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM cliente_servicio WHERE CSER_CODIGO=".$sercod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "sercod"            =>$row["CSER_CODIGO"],
					"clicod"           =>$row["RAZ_CODIGO"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "vbanho"           =>$row["CSER_VALORARRIENDOBANHO"],
					"cbanho"           =>$row["CSER_CANTBANHO"],
					"msemana"           =>$row["CSER_MANTSEMANAL"],
					"fact"            =>$row["CSER_FECHACIERREFACTURA"],
					"vlimpf"            =>$row["CSER_VALORLIMPFOSA"],
                                        "area"            =>$row["CSER_AREA"],
					"otro"           =>$row["CSER_OTROS"],
                                        "obs"           =>$row["CSER_OBS"],
                                        "vale"            =>$row["CSER_VALORENTREGA"],
					"valr"           =>$row["CSER_VALORRETIRO"]
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