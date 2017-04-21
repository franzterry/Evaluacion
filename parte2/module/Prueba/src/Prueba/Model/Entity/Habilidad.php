<?php

namespace Prueba\Model\Entity;

/**
 * Description of Habilidad
 *
 * @author Franz Orbezo
 */

class Habilidad {
    
    private $descripcion;
    
    public function __construct($descripcion = null) {
        $this->descripcion = $descripcion;
    }
    
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    public function exchangeArray($data) {
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
    
}
