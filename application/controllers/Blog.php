<?php
/**
 * Created by PhpStorm.
 * User: Lessner
 * Date: 7/11/2018
 * Time: 6:55 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function index()
    {
        echo 'Hello World!';
    }

    public function comentarios($id)
    {
        if (!is_numeric($id)) {
            $respuesta = array('Err' => true, 'Mensaje' => 'El id no es numerico');
            echo json_encode($respuesta);
            return;
        }

        $comentarios = array(
            array('id' => 1, 'mensaje' => 'lorem ipsum dolor sit amet.'),
            array('id' => 2, 'mensaje' => 'Lorem'),
            array('id' => 3, 'mensaje' => 'lorem ipsum sit amet.')
        );

        if ($id >= count($comentarios) OR $id < 0 ){
            $respuesta = array('Err' => true, 'Mensaje' => 'El id no existe');
            echo json_encode($respuesta);
            return;
        }

        echo json_encode($comentarios[$id]);


    }
}