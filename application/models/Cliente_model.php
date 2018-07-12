<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model
{
    public $id; public $nombre; public $correo;

    public function get_cliente($id)
    {
        $this->id = intval($id);
        $this->nombre = 'Lessner';
        $this->correo = 'camilessner@gmail.com';

        return $this;

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