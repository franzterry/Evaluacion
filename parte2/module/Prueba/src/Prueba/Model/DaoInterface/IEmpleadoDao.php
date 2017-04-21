<?php

namespace Sistemas\Model\DaoInterface;

/**
 * Description of IAreaDao
 *
 * @author Franz Orbezo
 */

use Sistemas\Model\Entity\Area;

interface IAreaDao {
    
    public function listar();
    
    public function insertar(Area $area);
    
    public function modificar(Area $area);
    
    public function eliminar(Area $area);
    
    public function obtenerPorId($idArea);
    
}