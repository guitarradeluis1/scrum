<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proyecto_model extends CI_Model
{
    function __construct()
    {
       parent::__construct();
       $this->load->database();
       #$this->load->library('session');
       $this->load->model('targeta_model');
       $this->load->model('eventos_model');
    }
//_______________________________________________________________
//________________________________________________________________
function todo()
{
	$this->db->select('*');
	$this->db->order_by('nombre', 'desc');
	$consulta = $this->db->get('proyecto');
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
			   	'inicio' => $info->inicio,
			   	'fin' => $info->fin,
			   	'prioridad' => $info->prioridad,
				'conteo' => $this->conteo_targeta($info->id)
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
    $this->db->order_by('proyecto', 'desc');
    $consulta = $this->db->get('creador',$por_pagina,$segmento);
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
    $this->db->insert('proyecto', $datos); 
    $id = $this->db->insert_id();
    return $id;
}
//______________________________________________________________________
function actualizo($datos)
{
    $this->db->where('id', $datos["id"]);
    return $this->db->update('proyecto', $datos); 
}
//______________________________________________________________________
function consulto($id)
{
    #$this->db->join('rol', 'usuarios.rol_id = rol.rol_id', "inner"); #left inner
    $this->db->select('*');
    $this->db->from('proyecto');
    $this->db->where("id",$id);
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno = array
        (
           	'id' => $info->id,
           	'nombre' => $info->nombre,
			'inicio' => $info->inicio,
		   	'fin' => $info->fin,
		   	'prioridad' => $info->prioridad,
			'conteo' => $this->conteo_targeta($info->id)
       );
    }
	return $retorno;
}
//______________________________________________________________________
function conteo_targeta($proyecto_id)
{
    $this->db->select('COUNT(proyecto_id) AS conteo');
    $this->db->from('proyecto_targeta');
    $this->db->where("proyecto_id",$proyecto_id);
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno = array
        (
           	'conteo' => $info->conteo
       );
    }
	return $retorno['conteo']; 
}
//______________________________________________________________________
function consulto_targeta($proyecto_id)
{
    $this->db->select('*');
    $this->db->from('proyecto_targeta');
    $this->db->where("proyecto_id", $proyecto_id);
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno[] = array
        (
           	'proyecto_id' => $info->proyecto_id,
           	'targeta_id' => $info->targeta_id,
           	'porcentaje' => $info->porcentaje,
			'tarjeta' => $this->targeta_model->consultoLigero($info->targeta_id),
			'eventos' => $this->eventos_model->todo($info->targeta_id)
       );
    }
	return $retorno; 
}
//______________________________________________________________________
function nueva_targeta($proyecto_id, $targeta_id, $porcentaje)
{
	$datos["proyecto_id"] = $proyecto_id;
	$datos["targeta_id"] = $targeta_id;
	$datos["porcentaje"] = 0;
    $this->db->insert('proyecto_targeta', $datos); 
    $id = $this->db->insert_id();
    return $id;
}
//______________________________________________________________________
function delete_targeta($proyecto_id, $targeta_id)
{
	$this->db->delete('proyecto_targeta', array('proyecto_id' => $proyecto_id, 'targeta_id' => $targeta_id));
}
//______________________________________________________________________
function porcentaje($proyecto_id, $targeta_id, $porcentaje)
{
	$datos["proyecto_id"] = $proyecto_id;
	$datos["targeta_id"] = $targeta_id;
	$datos["porcentaje"] = $porcentaje;
    $this->db->where('proyecto_id', $proyecto_id);
    $this->db->where('targeta_id', $targeta_id);
    return $this->db->update('proyecto_targeta', $datos); 
}
//______________________________________________________________________
}
?>