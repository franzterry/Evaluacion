<?php

namespace Prueba\Model\DaoInterface;

/**
 * Description of IEmpleadoDao
 *
 * @author Franz Orbezo
 */

interface IEmpleadoDao {
    
    public function empleadosRango($min, $max);
    
}