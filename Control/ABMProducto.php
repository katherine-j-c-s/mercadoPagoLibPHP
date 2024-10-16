<?php
use function PHPSTORM_META\sql_injection_subst;
use Modelo\conector\BaseDatos;

class ABMProducto
{
    private $nombre;
    private $precio;
    private $cantidad;
    private $idProducto;
    private $baseDatos;


    public function __construct()
    {
        $this->baseDatos = new BaseDatos();
        $this->nombre = "";
        $this->precio = "";
        $this->cantidad = "";
        $this->idProducto = "";
    }



    public function getNombre() {
		return $this->nombre;
	}

	public function setNombre($value) {
		$this->nombre = $value;
	}

	public function getPrecio() {
		return $this->precio;
	}

	public function setPrecio($value) {
		$this->precio = $value;
	}

	public function getCantidad() {
		return $this->cantidad;
	}

	public function setCantidad($value) {
		$this->cantidad = $value;
	}

	public function getIdProducto() {
		return $this->idProducto;
	}

	public function setIdProducto($value) {
		$this->idProducto = $value;
	}

	public function getBaseDatos() {
		return $this->baseDatos;
	}

	public function setBaseDatos($value) {
		$this->baseDatos = $value;
	}


    //crear un nuevo producto
    public function crear()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO auto (nombre, cantidad) VALUES (?, ?)";
        if ($base->Iniciar()) {
            try {
                if ($base->Ejecutar($sql, [$this->getNombre(), $this->getCantidad()])) {
                    $resp = true;
                } else {
                    $this->setIdProducto("producto->crear: " . $base->getError());
                }
            } catch (Exception $e) {
                $this->setIdProducto("producto->crear: Error - " . $e->getMessage());
            }
        } else {
            $this->setIdProducto("producto->crear: " . $base->getError());
        }
        return $resp;
    }

    //listar todos los productos
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE auto SET cantidad = '" . $this->getCantidad() . "' WHERE nombre='" . $this->getNombre() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setIdProducto("producto->modificar: " . $base->getError());
            }
        } else {
            $this->setIdProducto("producto->modificar: " . $base->getError());
        }
        return $resp;
    }

    //eliminar un producto
    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE nombre=" . $this->getNombre();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setIdProducto("producto->eliminar: " . $base->getError());
            }
        } else {
            $this->setIdProducto("producto->eliminar: " . $base->getError());
        }
        return $resp;
    }



}