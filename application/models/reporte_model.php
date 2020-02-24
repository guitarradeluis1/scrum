<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reporte_model extends CI_Model
{
    function __construct()
    {
       parent::__construct();
       $this->load->database();
       #$this->load->library('session');
       $this->load->model('targeta_model');
	   $this->load->model('proyecto_model');
       $this->load->model('eventos_model');
    }
//_______________________________________________________________
//________________________________________________________________
function todo()
{
	$this->db->select('*');
	$this->db->order_by('nombre', 'desc');
	$consulta = $this->db->get('reporte');
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
			   	'targeta_id' => $info->targeta_id,
			   	'fecha' => $info->fecha
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
    $consulta = $this->db->get('reporte',$por_pagina,$segmento);
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
			   'targeta_id' => $info->targeta_id,
			   'fecha' => $info->fecha
            );
        }
        return $retorno;
    }
}
//______________________________________________________________________
function nuevo($targeta_id)
{
	$hoy = date("Y-m-d");
    $this->db->select('id');
    $this->db->from('reporte');
    $this->db->where("fecha", $hoy);
    $this->db->where("targeta_id", $targeta_id);
	$consulta = $this->db->get();
	$id = 0;
 	foreach($consulta->result() as $info)
    {
		if(isset($info->id))
		{$id = $info->id;}
    }
 	if($id == 0)
	{
		$datos = array();
		$datos["targeta_id"] = $targeta_id;
		$datos["fecha"] = $hoy;
 		$this->db->insert('reporte', $datos); 
    	$reporte_id = $this->db->insert_id();
		# Clonar datos
		$this->db->select('*');
		$this->db->from('eventos');
		$this->db->where("targeta_id", $targeta_id);
		$consulta = $this->db->get();
		foreach($consulta->result() as $info)
		{
			$registro = array
			(
				'reporte_id' => $reporte_id,
				'creador_id' => $info->creador_id,
				'descripcion' => $info->descripcion,
				'terminado' => $info->terminado,
				'puntos' => $info->puntos,
				'orden' => $info->orden,
				'sprint' => $info->sprint,
				'semana' => $info->semana
			);
			$salida = $this->db->insert('reporte_datos', $registro);
		}
		return 0;
	}
	else
	{
		return 1;
	}
}
//______________________________________________________________________
function actualizo($datos)
{
    $this->db->where('id', $datos["id"]);
    return $this->db->update('reporte', $datos); 
}
//______________________________________________________________________
function indexreportes()
{
    #$this->db->join('rol', 'usuarios.rol_id = rol.rol_id', "inner"); #left inner
    $this->db->select('id , titulo, posicion');
    $this->db->from('targeta');
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno[] = array
        (
           	'id' => $info->id,
           	'titulo' => $info->titulo,
			'posicion' => $info->posicion,
			'conteo' => $this->conteo_registros($info->id)
       );
    }
	return $retorno;
}
//______________________________________________________________________
function conteo_registros($targeta_id)
{
    $this->db->select('COUNT(id) AS conteo');
    $this->db->from('reporte');
    $this->db->where("targeta_id",$targeta_id);
	$this->db->group_by('targeta_id');
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
		if($info->conteo)
		{
			$retorno =  array('conteo' => $info->conteo);
		}
    }
	return (isset($retorno['conteo']))? $retorno['conteo'] : 0; 
}
//______________________________________________________________________
function consulto($targeta_id)
{
    #$this->db->join('rol', 'usuarios.rol_id = rol.rol_id', "inner"); #left inner
    $this->db->select('*');
    $this->db->from('reporte');
    $this->db->where("targeta_id",$targeta_id);
	$this->db->order_by('id', 'asc');
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno[] = array
        (
           	'id' => $info->id,
			'targeta_id' => $info->targeta_id,
			'fecha' => $info->fecha,
			'datos' => $this->datos($info->id)
       );
    }
	return $retorno;
}
//______________________________________________________________________
function datos($reporte_id)
{
    #$this->db->join('rol', 'usuarios.rol_id = rol.rol_id', "inner"); #left inner
    $this->db->select('*');
    $this->db->from('reporte_datos');
    $this->db->where("reporte_id", $reporte_id);
	$this->db->order_by('orden', 'asc');
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno[] = array
        (
           	'id' => $info->id,
           	'reporte_id' => $reporte_id,
			'creador_id' => $info->creador_id,
			'descripcion' => $info->descripcion,
			'terminado' => $info->terminado,
			'puntos' => $info->puntos,
			'orden' => $info->orden,
			'sprint' => $info->sprint,
			'semana' => $info->semana
       	);
    }
	return $retorno;
}
//______________________________________________________________________
}
?>