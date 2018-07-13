<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require( APPPATH.'/libraries/REST_Controller.php');

class Facturacion extends REST_Controller
{
    public function factura_get()
    {
        $factura_id = $this->uri->segment(3);

        $this->load->database();

        $this->db->where('factura_id', $factura_id);
        $query = $this->db->get('facturacion');

        $factura = $query->row();

        $this->db->reset_query();

        $this->db->where('factura_id', $factura_id);
        $query = $this->db->get('facturacion_detalle');

        $detalle = $query->result();

        $respuesta = array(
            'err' => FALSE,
            'mensaje' => 'Factua cargada correctamente',
            'factura' => $query->row(),
            'detalle' => $detalle
        );

        $this->response($respuesta);
    }

}