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

    public function insert()
    {
        return 'insertado';

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