<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categoria_model extends CI_Model
{
    function __construct()
    {
       parent::__construct();
       $this->load->database();
       #$this->load->library('session');
       #$this->load->model('paquetes_model');
    }
//________________________________________________________________
function todo_carpeta($carpeta_id)
{
    $this->db->select('*');
    $this->db->order_by('nombre', 'desc');
    $consulta = $this->db->get('categoria');
    if($consulta->num_rows()>0)
    {
        $data = array();
        foreach($consulta->result() as $fila)
        {$data[] = $fila;}
        $retorno = array();
        foreach ($data as $info)
        {
            $retorno[] = array
            (
               'id' => $info->id,
               'nombre' => $info->nombre,
            );
        }
        return $retorno;
    }
}
//________________________________________________________________
function todo()
{
   	$this->db->select('*');
    $this->db->order_by('nombre', 'desc');
    $consulta = $this->db->get('categoria');
    if($consulta->num_rows()>0)
    {
        $data = array();
        foreach($consulta->result() as $fila)
        {$data[] = $fila;}
        $retorno = array();
        foreach ($data as $info)
        {
            $retorno[] = array
            (
               'id' => $info->id,
               'nombre' => $info->nombre,
            );
        }
        return $retorno;
    }
}
function todo_paginados($por_pagina,$segmento) 
{
    $this->db->select('*');
    #$this->db->from('usuarios');
    #$this->db->join('tipousuario', 'tipousuario.id = usuarios.tipousuario_id', "inner"); #left inner
    $this->db->order_by('nombre', 'desc');
    $consulta = $this->db->get('categoria',$por_pagina,$segmento);
    if($consulta->num_rows()>0)
    {
        $data = array();
        foreach($consulta->result() as $fila)
        {$data[] = $fila;}
        $retorno = array();
        foreach ($data as $info)
        {
            $retorno[] = array
            (
               'id' => $info->id,
               'nombre' => $info->nombre
            );
        }
        return $retorno;
    }
}
//______________________________________________________________________
function nuevo($datos)
{
    $this->db->insert('categoria', $datos); 
    $id = $this->db->insert_id();
    return $id;
}
//______________________________________________________________________
function actualizo($datos)
{
    $this->db->where('id', $datos["id"]);
    return $this->db->update('categoria', $datos); 
}
//______________________________________________________________________
function consulto($id)
{
    #$this->db->join('rol', 'usuarios.rol_id = rol.rol_id', "inner"); #left inner
    $this->db->select('*');
    $this->db->from('categoria');
    $this->db->where("id",$id);
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno = array
        (
           'id' => $info->id,
           'nombre' => $info->nombre
       );
    }
	return $retorno;
}
//______________________________________________________________________
//______________________________________________________________________
//______________________________________________________________________
}
?>