<?php

namespace Control;
use Modelo\Producto;
use PDOException;
require __DIR__ . '../../Modelo/Producto.php';

class AbmProducto {
 


    public function __construct(){
    }

    //Obtener todas las Productos
    public function obtenerTodasLasProductos() {
        $Productos = Producto::listar();
        return $Productos;
    }

   
    // Obtener Producto por dni
    public function obtenerDatosProducto($nombre) {
        $Productos = Producto::listar("nombre = '" . $nombre . "'");
        $salida = "";
        if (count($Productos) > 0) {
            $salida = $Productos[0];
        } else {
            $salida = null;
        }
        return $salida;
    }

    public function agregarNuevoProducto($nombre, $cantidad, $precio) {
        $salida = "";
        if (!($this->obtenerDatosProducto($nombre) !== null)) {
            try {
                $objProducto = new Producto();
                $objProducto->cargar($nombre,$precio,$cantidad);
                $objProducto->insertar();
                $salida = "Producto registrada con éxito.";
            } catch (PDOException $e) {
                $salida = "Error al registrar la Producto: " . $e->getMessage();
            }
        } else {
            $salida = "La Producto ya está registrada.";
        }
        return $salida;
    }

    public function modificarDatosProducto($nombre, $cantidad, $precio) {
        $salida = "";
    
        // Verifica si la Producto existe en la base de datos
        $abmProducto = new AbmProducto();
        $Producto = new Producto();
        $Producto->cargar( $nombre, $cantidad, $precio);
    
        if (!($abmProducto->obtenerDatosProducto($nombre) === null)) {
            try {
                $Producto->modificar();
                $salida = "Producto modificada con éxito.";
            } catch (PDOException $e) {
                $salida = "Error al modificar la Producto: " . $e->getMessage();
            }
        } else {
            $salida = "La Producto no existe en la base de datos.";
        }
    
        return $salida;
    }

}