<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller
{
    public function index()
    {
        $this->load->helper('utilidades');

        $data = array(
            'nombre' => 'lessner garcia',
            'contacto' => 'angie zepeda',
            'direccion' => 'residencial lomas'
        );

        $campos_capitalizar = array('nombre', 'contacto');

        $data = capitalizarArreglo($data, $campos_capitalizar);


        echo json_encode($data);

    }

    public function cliente($id)
    {
        $this->load->model('Cliente_model');

        $cliente = $this->Cliente_model->get_cliente($id);

        echo json_encode($cliente);

    }

}