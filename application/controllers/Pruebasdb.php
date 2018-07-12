<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pruebasdb extends CI_Controller
{

    public function __construct()
    {
        //Llamado del contructor del Padre
        parent::__construct();

        $this->load->database();

        $this->load->helper('utilidades');
    }

    public function tabla()
    {
        $this->db->select('pais, count(*) as clientes');
        $this->db->from('clientes');


        $query = $this->db->get();


        echo json_encode($query->result());
    }
    
    public function clientes_beta()
    {

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

    public function insertar()
    {
        //Insertar un registro a la vez
//        $data = array(
//            'nombre' => 'lessner',
//            'apellido' => 'garcia'
//        );
//
//        $data = capitalizarTodo($data);
//
//        $this->db->insert('test', $data);
//
//        $respuesta = array(
//            'err' => FALSE,
//            'id_insertado' => $this->db->insert_id()
//        );
//
//        echo json_encode($respuesta);


        //Insertar multiples registros
        $data = array(
            array(
                'nombre' => 'juan',
                'apellido' => 'perez'
            ),
            array(
                'nombre' => 'maria',
                'apellido' => 'herrera'
            )
        );

        $this->db->insert_batch('test', $data);

        echo $this->db->affected_rows();

    }

    public function actualizar()
    {
        $data = array(
            'nombre' => 'Karla',
            'apellido' => 'Reyes'
        );

        $data = capitalizarTodo($data);

        $this->db->where('id', 1);
        $this->db->update('test', $data);

        echo 'Todo ok!';

    }

    public function eliminar()
    {
        $this->db->where('id', 1);
        $this->db->delete('test');

        echo 'Registro eliminado';
        
    }
}