<?php
class P_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function verproyectos()
    {
        //Hacemos una consulta
        $consulta = $this->db->query("SELECT * FROM project WHERE stat_pro=1");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }
    public function delproyecto($id)
    {
        $consulta = $this->db->query("UPDATE project SET stat_pro=0 WHERE id='$id'");
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }
    public function creproyecto(
        $data
    ) {
        //$date_ini = date('Y-m-s');
        //$sql = "INSERT INTO project ('name', 'description', 'date_ini', 'stat_pro') VALUES('$nombre','$description','$date_ini',1)";
        $consulta = $this->db->insert( "project", $data );
         //$consulta = $this->db->query($sql);
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }
    public function verempleados()
    {
        //Hacemos una consulta
        $consulta = $this->db->query("SELECT * FROM user WHERE role_id=2");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }
    public function delempleados($id)
    {
        $consulta = $this->db->query("UPDATE user SET role_id=0 WHERE id='$id'");
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }
}