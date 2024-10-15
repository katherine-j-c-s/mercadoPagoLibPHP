<?php
namespace Modelo;

require_once __DIR__ . '/conector/BaseDatos.php';  // Ajusta la ruta según la ubicación real del archivo
use Modelo\conector\BaseDatos;

class Producto {

    private $nombre;
    private $precio;
    private $cantidad;
    private $idProducto;

    public function __construct(){
        $this->nombre="";
        $this->precio="";
        $this->cantidad="";
        $this->idProducto ="";
    }

    public function cargar($nombre, $precio, $idProducto, $cantidad){
        $this->setNombre($nombre);
        $this->setPrecio($precio);
        $this->setIdProducto($idProducto);
        $this->setCantidad($cantidad);
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function setCantidad($cant){
        $this->cantidad = $cant;
    }

    public function getIdProducto(){
        return $this->idProducto;
    }

    public function setIdProducto($idProducto){
        $this->idProducto = $idProducto;
    }

    public function buscar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto WHERE nombre = ".$this->getNombre();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->cargar($row['nombre'], $row['precio'], $row['cantidad'], $row['idProducto']);
                    $resp = true;              
                }
            }
        } else {
            $this->setIdProducto("producto->listar: ".$base->getError());
        }
        return $resp;
    
        
    }

    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        if($this->getCantidad() != null){
            $sql="INSERT INTO producto(nombre, precio, cantidad, idProducto)  VALUES ('".$this->getNombre()."','".$this->getPrecio()."','".$this->getCantidad()."','".$this->getIdProducto()."')";
            if ($base->Iniciar()) {
                if ($nombre = $base->Ejecutar($sql)) {
                    $this->setNombre($nombre);
                    $resp = true;
                } else {
                    $this->setIdProducto("producto->insertar: ".$base->getError());
                }
            } else {
                $this->setIdProducto("producto->insertar: ".$base->getError());
            }
        }
        
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE auto SET cantidad = '".$this->getCantidad()."' WHERE nombre='". $this->getNombre()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setIdProducto("producto->modificar: ".$base->getError());
            }
        } else {
            $this->setIdProducto("producto->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE nombre=".$this->getNombre();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setIdProducto("producto->eliminar: ".$base->getError());
            }
        } else {
            $this->setIdProducto("producto->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Producto();
                    $obj->cargar($row['nombre'], $row['precio'], $row['cantidad'], $row['idProducto']);
                    array_push($arreglo, $obj);
                }
            }
            
        } else {
            self::setIdProducto("producto->listar: ".$base->getError());
        }
        return $arreglo;
    }
}

?>