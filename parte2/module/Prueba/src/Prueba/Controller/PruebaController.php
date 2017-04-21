<?php

namespace Prueba\Controller;

/**
 * Description of PruebaController
 *
 * @author Franz Orbezo
 */

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Prueba\Model\Entity\Empleado;
use Prueba\Model\Entity\Habilidad;


class PruebaController extends AbstractActionController {
    
    const WSDL_URI = "http://localhost/parte2/public/prueba/prueba/soap";
    private $config;
    private $empleadoDao;
    
    public function __construct($config = null) {
        $this->config = $config;
    }

    public function setEmpleadoDao($areaDao) {
        $this->empleadoDao = $empleadoDao;
    }
    
    public function getEmpleadoDao() {
        return $this->empleadoDao;
    }

    public function listarAction() {
        $data = file_get_contents("..".$this->getRequest()->getBaseUrl()."/doc/employees.json");
        $datos = json_decode($data, true);
        $empleados = new \ArrayObject();
        if (!$this->request->isPost()) :
            foreach ($datos as $key => $empleado) :
                $habilidades = new \ArrayObject();
                foreach ($empleado["skills"] as $key => $habilidad) :
                    $habilidades->append(new Habilidad($habilidad["skill"]));
                endforeach;
                $empleados->append(new Empleado($empleado["id"], $empleado["isOnline"], $empleado["salary"], $empleado["age"], $empleado["position"], $empleado["name"], $empleado["gender"], $empleado["email"], $empleado["phone"], $empleado["address"], $habilidades));
            endforeach;
            return new ViewModel(array('titulo' => $this->config->titulo->prueba->prueba->listar, 
            'tituloAlterno' => $this->config->tituloAlterno->prueba->prueba->listar, 
            'tituloTabla' => $this->config->tituloTabla->prueba->prueba->listar, 
            'empleados' => $empleados));
        else :
            $data = $this->request->getPost();
            if (!empty($data["email"])) :
                foreach ($datos as $key => $empleado) :
                    if (strstr($empleado["email"], $data["email"])) :
                        $habilidades = new \ArrayObject();
                        foreach ($empleado["skills"] as $key => $habilidad) :
                            $habilidades->append(new Habilidad($habilidad["skill"]));
                        endforeach;
                        $empleados->append(new Empleado($empleado["id"], $empleado["isOnline"], $empleado["salary"], $empleado["age"], $empleado["position"], $empleado["name"], $empleado["gender"], $empleado["email"], $empleado["phone"], $empleado["address"], $habilidades));
                    endif;
                endforeach;
                return new ViewModel(array('titulo' => $this->config->titulo->prueba->prueba->listar, 
                'tituloAlterno' => $this->config->tituloAlterno->prueba->prueba->listar, 
                'tituloTabla' => $this->config->tituloTabla->prueba->prueba->listar, 
                'empleados' => $empleados, 'email' => $data["email"]));
            else :
                return $this->redirect()->toRoute('prueba/default', array('controller' => 'prueba', 'action' => 'listar'));
            endif;
        endif;
    }
    
    public function detalleAction() {
        $id = $this->params()->fromRoute('id', null);
        $data = file_get_contents("..".$this->getRequest()->getBaseUrl()."/doc/employees.json");
        $datos = json_decode($data, true);
        foreach ($datos as $key => $fila) :
            if ($fila["id"] === $id) :
                $habilidades = new \ArrayObject();
                foreach ($fila["skills"] as $key => $habilidad) :
                    $habilidades->append(new Habilidad($habilidad["skill"]));
                endforeach;
                $empleado = new Empleado($fila["id"], $fila["isOnline"], $fila["salary"], $fila["age"], $fila["position"], $fila["name"], $fila["gender"], $fila["email"], $fila["phone"], $fila["address"], $habilidades);
            endif;
        endforeach;
        if (!empty($empleado)) :
            $view = new ViewModel(array(
                'titulo' => $this->config->titulo->prueba->prueba->detalle, 
                'empleado' => $empleado));
            $view->setTerminal(true);
            return $view;
        else : 
            return $this->redirect()->toRoute('prueba/default', array('controller' => 'prueba', 'action' => 'listar'));
        endif;
        return $this->redirect()->toRoute('prueba/default', array('controller' => 'prueba', 'action' => 'listar'));
    }

    public function soapAction() {
        $this->getResponse()->getHeaders()->addHeaderLine("Content-type", "text/xml");
        if (isset($_GET["wsdl"])) :
            $autodiscover = new AutoDiscover();
            $autodiscover->setClass("Prueba\Model\salario")
                ->setUri(self::WSDL_URI)
                ->setServiceName("SalarioWsSoapService");
            $wsdl = $autodiscover->generate();
            $this->getResponse()->setContent($wsdl->toXml());
        else :
            $soap = new Server(self::WSDL_URI."?wsdl");
            $soap->setClass("Prueba\Model\salario");
            $soap->handle();
        endif;
        return $this->getResponse();
    }
    
}
