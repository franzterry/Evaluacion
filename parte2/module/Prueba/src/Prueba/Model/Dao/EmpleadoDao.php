<?php

namespace Prueba\Model\Dao;

/**
 * Description of EmpleadoDao
 *
 * @author Franz Orbezo
 */

use Sistemas\Model\Entity\Empleado;
use Sistemas\Model\DaoInterface\IEmpleadoDao;

class EmpleadoDao implements IEmpleadoDao {

    protected $empleados;

    public function __construct($empleados = null) {
        $this->empleados = $empleados;
    }
    
    public function empleadosRango($min, $max) {
        $resultado = new \ArrayObject();
        foreach ($this->empleados as $empleado) :
            if ($min<$empleado->getSalary() and $empleado->getSalary()<$max) :
                $resultado->append(new Empleado($empleado));
            endif;
        endforeach;
        return $resultado;
    }
    
}