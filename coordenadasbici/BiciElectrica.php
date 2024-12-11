<?php
class BiciElectrica {
    private $id;
    private $coordx;
    private $coordy;
    private $bateria;
    private $operativa;

    // Constructor
    public function __construct($id, $coordx, $coordy, $bateria, $operativa) {
        $this->id = $id;
        $this->coordx = $coordx;
        $this->coordy = $coordy;
        $this->bateria = $bateria;
        $this->operativa = $operativa;
    }

    // Métodos mágicos para getters y setters
    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    // Método para calcular distancia desde un punto dado
    public function distancia($x, $y) {
        return sqrt(pow($this->coordx - $x, 2) + pow($this->coordy - $y, 2));
    }

    // Método __toString
    public function __toString() {
        return "Identificador: $this->id, Batería: $this->bateria%";
    }
}
?>
