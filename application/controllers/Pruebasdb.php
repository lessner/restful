<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pruebasdb extends CI_Controller
{

    public function clientes_beta()
    {
        $this->load->database();

        $query = $this->db->query('SELECT id, nombre, correo FROM clientes limit 10');

        /*foreach ($query->result() as $row)
        {
            echo $row->id;
            echo $row->nombre;
            echo $row->correo;
        }

        echo 'Total Registros: ' . $query->num_rows();*/

        $respuesta = array(
            'err' => FALSE,
            'mensaje' => 'Registros cargados correctamente',
            'total_registros' => $query->num_rows(),
            'clientes' => $query->result()
        );

        echo json_encode($respuesta);

    }

    public function cliente($id)
    {
        $this->load->database();

        $query = $this->db->query('SELECT * FROM clientes WHERE id ='. $id);

        $fila = $query->row();

        if (isset($fila)){
            $respuesta = array(
                'err' => FALSE,
                'mensaje' => 'Registro cargado correctamente',
                'total_registros' => 1,
                'cliente' => $fila
            );
        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'El registro con el id: '. $id .' no existe',
                'total_registros' => 0,
                'cliente' => null
            );
        }

        echo json_encode($respuesta);
    }

}