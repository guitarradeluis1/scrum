<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Targeta_model extends CI_Model
{
    function __construct()
    {
       parent::__construct();
       $this->load->database();
       #$this->load->library('session');
       $this->load->model('creador_model');
       $this->load->model('categoria_model');
    }
//________________________________________________________________
function todo($creador = null) 
{
    $this->db->select('*');
    #$this->db->from('targeta');
    #$this->db->join('tipousuario', 'tipousuario.id = usuarios.tipousuario_id', "inner"); #left inner
	if($creador)
	{$this->db->where("creador_id", $creador);}
    $this->db->order_by('id', 'desc');
    $consulta = $this->db->get('targeta');
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
				'creador_id' => $info->creador_id,
				'categoria_id' => $info->categoria_id,
				'titulo' => $info->titulo,
				'quien' => $info->quien,
				'que' => $info->que,
				'para_que' => $info->para_que,
				'semana' => $info->semana,
				'prioridad' => $info->prioridad,
				'puntos' => $info->puntos,
				'sprint' => $info->sprint,
				'posicion' => $info->posicion,
				'visible' => $info->visible,
				'ultimocambio' => $info->ultimocambio,
				#################################
				'creador' => $this->creador_model->consulto($info->creador_id),
				'categoria' => $this->categoria_model->consulto($info->categoria_id),
				'terminados' => $this->eventos_model->terminados($info->id),
				#################################
            );
        }
        return $retorno;
    }
}
//______________________________________________________________________
function nuevo($datos)
{
    $this->db->insert('targeta', $datos); 
    $id = $this->db->insert_id();
    return $id;
}
//______________________________________________________________________
function actualizo($datos)
{
	$this->db->where('id', $datos["id"]);
	$datos['ultimocambio'] = date("Y-m-d");
    return $this->db->update('targeta', $datos); 
}
//______________________________________________________________________
function consulto($id)
{
    #$this->db->join('rol', 'usuarios.rol_id = rol.rol_id', "inner"); #left inner
    $this->db->select('*');
    $this->db->from('targeta');
    $this->db->where("id",$id);
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno = array
        (
           	'id' => $info->id,
			'creador_id' => $info->creador_id,
			'categoria_id' => $info->categoria_id,
			'titulo' => $info->titulo,
			'quien' => $info->quien,
			'que' => $info->que,
			'para_que' => $info->para_que,
			'semana' => $info->semana,
			'prioridad' => $info->prioridad,
			'puntos' => $info->puntos,
			'sprint' => $info->sprint,
			'posicion' => $info->posicion,
			'visible' => $info->visible,
			'ultimocambio' => $info->ultimocambio,
			#################################
			'creador' => $this->creador_model->consulto($info->creador_id),
			'categoria' => $this->categoria_model->consulto($info->categoria_id),
			'terminados' => $this->eventos_model->terminados($info->id),
			#################################
       );
    }
	return $retorno;
}
//______________________________________________________________________
function consultoLigero($id)
{
    #$this->db->join('rol', 'usuarios.rol_id = rol.rol_id', "inner"); #left inner
    $this->db->select('*');
    $this->db->from('targeta');
    $this->db->where("id",$id);
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno = array
        (
           	'id' => $info->id,
			'creador_id' => $info->creador_id,
			'categoria_id' => $info->categoria_id,
			'titulo' => $info->titulo,
			'quien' => $info->quien,
			'que' => $info->que,
			'para_que' => $info->para_que,
			'semana' => $info->semana,
			'posicion' => $info->posicion,
			'ultimocambio' => $info->ultimocambio,
			#################################
			'creador' => $this->creador_model->consulto($info->creador_id),
			'categoria' => $this->categoria_model->consulto($info->categoria_id)
			#################################
       );
    }
	return $retorno;
}
//______________________________________________________________________
function buscar($texto)
{
    $this->db->select('*');
    $this->db->from('targeta');
    #$this->db->where("id",$id);
	$this->db->like('titulo', $texto);
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno[] = array
        (
           	'id' => $info->id,
			'creador_id' => $info->creador_id,
			'categoria_id' => $info->categoria_id,
			'titulo' => $info->titulo,
			'quien' => $info->quien,
			'que' => $info->que,
			'para_que' => $info->para_que,
			'semana' => $info->semana,
			'prioridad' => $info->prioridad,
			'puntos' => $info->puntos,
			'sprint' => $info->sprint,
			'posicion' => $info->posicion,
			'visible' => $info->visible,
			#################################
			'creador' => $this->creador_model->consulto($info->creador_id),
			'categoria' => $this->categoria_model->consulto($info->categoria_id),
			'terminados' => $this->eventos_model->terminados($info->id),
			#################################
       );
    }
	return $retorno;
}
//______________________________________________________________________
//______________________________________________________________________
}
?>