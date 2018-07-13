<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model
{
    public $id; public $nombre; public $activo; public $correo; public $zip;
    public $telefono1; public $telefono2; public $pais; public $direccion;

    public function get_cliente($id)
    {
        $this->db->where( array( 'id' => $id, 'activo' => 1) );

        $query = $this->db->get('clientes');

        $row = $query->custom_row_object(0, 'Cliente_model');

        if (isset($row)){
            $row->id = intval($row->id);
            $row->activo = intval($row->activo);
        }

        return $row;

    }

    public function set_datos($data_cruda)
    {
        foreach ($data_cruda as $nombre_campo => $valor_campo) {

            if (property_exists('Cliente_model', $nombre_campo))
            {
                $this->$nombre_campo = $valor_campo;
            }
        }

        if ($this->activo == NULL)
        {
            $this->activo = 1;
        }

        $this->nombre = strtoupper($this->nombre);

        return $this;
        
    }

    public function insert()
    {
        //Verificar el correo
        $query = $this->db->get_where('clientes', array('correo' => $this->correo));

        $cliente_correo = $query->row();

        if (isset($cliente_correo)) {
            //existe
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'El correo electrónico ya esta registrado'
            );

            return $respuesta;
        }

        $hecho = $this->db->insert('clientes', $this);

        if ($hecho){
            //insertado
            $respuesta = array(
                'err' => FALSE,
                'mensaje' => 'Registro insertado correctamente',
                'cliente_id' => $this->db->insert_id()
            );
        } else {
            //no insertado
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Error al insertar',
                'error: ' => $this->db->error_message(),
                'error_num' => $this->db->error_number()
            );

        }

        return $respuesta;

    }

    public function update()
    {
        return 'actualizado';

    }

    public function delete()
    {
        return 'eliminado';

    }



}