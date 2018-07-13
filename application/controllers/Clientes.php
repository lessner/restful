<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require( APPPATH.'/libraries/REST_Controller.php');


class Clientes extends REST_Controller
{

    public function __construct()
    {
        //Llamado del contructor del Padre
        parent::__construct();

        $this->load->database();

        $this->load->model('Cliente_model');

        //$this->load->helper('utilidades');
    }

    public function cliente_get()
    {
        //Lleva el orden de la url http://localhost:8080/restful/index.php/1-clientes/2-cliente/3-5
        $cliente_id = $this->uri->segment(3);

        //Validar el cliente ID
        if (!isset($cliente_id)){
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Es necesario el id del cliente.'
            );
            $this->response( $respuesta, REST_Controller::HTTP_BAD_REQUEST );
            return;
        }

        $cliente = $this->Cliente_model->get_cliente($cliente_id);

        if (isset($cliente)){
            //unset( $cliente-> telefono1);

            $respuesta = array(
                'err' => FALSE,
                'mensaje' => 'Registo cargado correctamente.',
                'cliente' => $cliente
            );
            $this->response($respuesta);
        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'El registro con el id ' . $cliente_id . ', no existe.',
                'cliente' => null
            );
            $this->response( $respuesta, REST_Controller::HTTP_NOT_FOUND );
        }
    }

    public function paginar_get()
    {
        $this->load->helper('paginacion');

        $pagina = $this->uri->segment(3);
        $por_pagina = $this->uri->segment(4);

        //Se mandan los campos que se desean que se muestren
        $campos = array('id', 'nombre', 'telefono1');

        $respuesta = paginar_todo('clientes', $pagina, $por_pagina, $campos);

        $this->response($respuesta);

    }

    public function cliente_put()
    {
        $data = $this->put();

        $this->load->library('form_validation');

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('cliente_put')){ //true: ok, false: falta una regla
            //Todo OK
            $cliente = $this->Cliente_model->set_datos($data);

            $respuesta = $cliente->insert();

            if ($respuesta['err']){
                $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $this->response($respuesta);
            }

        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Hay errores en el envio de información',
                'errores' => $this->form_validation->get_errores_arreglo()
            );
            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        }

        $this->response($data);
    }

    public function cliente_post()
    {

        $cliente_id = $this->uri->segment(3);

        $data = $this->post();
        $data['id'] = $cliente_id;

        $this->load->library('form_validation');

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('cliente_post')){ //true: ok, false: falta una regla
            //Todo OK
            $cliente = $this->Cliente_model->set_datos($data);

            $respuesta = $cliente->update();

            if ($respuesta['err']){
                $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $this->response($respuesta);
            }

        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Hay errores en el envio de información',
                'errores' => $this->form_validation->get_errores_arreglo()
            );
            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        }

        $this->response($respuesta);
    }

    public function cliente_delete()
    {
        $cliente_id = $this->uri->segment(3);

        $respuesta = $this->Cliente_model->delete($cliente_id);

        $this->response($respuesta);
    }

}