<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

class createPagoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nombre_empleado = request::getInstance()->getPost(pagoEmpleadosTableClass::getNameField(pagoEmpleadosTableClass::NOMBRE, FALSE));
                $id_empleado = request::getInstance()->getPost(pagoEmpleadosTableClass::getNameField(pagoEmpleadosTableClass::ID_EMPLEADO, false));
                $fecha_ini = request::getInstance()->getPost(pagoEmpleadosTableClass::getNameField(pagoEmpleadosTableClass::FECHA_INICIO, false));
                $fecha_fin = request::getInstance()->getPost(pagoEmpleadosTableClass::getNameField(pagoEmpleadosTableClass::FECHA_FIN, false));
                $fecha_pago = request::getInstance()->getPost(pagoEmpleadosTableClass::getNameField(pagoEmpleadosTableClass::FECHA_PAGO, false));
                $total = request::getInstance()->getPost(pagoEmpleadosTableClass::getNameField(pagoEmpleadosTableClass::PAGO, false));



                $data = array(
                    pagoEmpleadosTableClass::NOMBRE => $nombre_empleado,
                    pagoEmpleadosTableClass::ID_EMPLEADO => $id_empleado,
                    PagoEmpleadosTableClass::FECHA_INICIO => $fecha_ini,
                    PagoEmpleadosTableClass::FECHA_FIN => $fecha_fin,
                    PagoEmpleadosTableClass::FECHA_PAGO => $fecha_pago,
                    PagoEmpleadosTableClass::TOTAL => $total
                );

                PagoEmpleadosTableClass::insert($data);
                log::register(i18n::__('create'), PagoEmpleadosTableClass::getNameTable());
                routing::getInstance()->redirect('pago', 'indexPago');
            } else {
                log::register(i18n::__('create'), pagoEmpleadosTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('pago', 'indexPago');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
