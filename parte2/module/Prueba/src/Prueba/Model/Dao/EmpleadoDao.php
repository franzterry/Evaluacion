<?php

namespace Prueba\Model\Dao;

/**
 * Description of EmpleadoDao
 *
 * @author Franz Orbezo
 */

use Prueba\Model\Entity\Empleado;
use Prueba\Model\DaoInterface\IEmpleadoDao;

class EmpleadoDao implements IEmpleadoDao {

    protected $empleados;

    public function __construct($empleados = null) {
        $this->empleados = $empleados;
    }
    
    public function empleadosRango($min, $max) {
        $resultado = new \ArrayObject();
        foreach ($this->empleados as $empleado) :
            if ($min<$empleado->getSalary() and $empleado->getSalary()<$max) :
                $resultado->append($empleado);
            endif;
        endforeach;
        return $resultado;
    }
    
}