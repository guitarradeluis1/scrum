<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Eventos_model extends CI_Model
{
    function __construct()
    {
       parent::__construct();
       $this->load->database();
       #$this->load->library('session');
       $this->load->model('targeta_model');
    }
//________________________________________________________________
function todo($targeta) 
{
    $this->db->select('*');
    #$this->db->from('eventos');
    #$this->db->join('tipousuario', 'tipousuario.id = usuarios.tipousuario_id', "inner"); #left inner
	$this->db->where("targeta_id", $targeta);
    $this->db->order_by('orden', 'asc');
    $consulta = $this->db->get('eventos');
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
				'creador_id' => $info->creador_id,
				'descripcion' => $info->descripcion,
				'terminado' => $info->terminado,
				'puntos' => $info->puntos,
				'orden' => $info->orden,
				'sprint' => $info->sprint,
				'semana' => $info->semana,
				'ultimocambio' => $info->ultimocambio,
				#################################
				'creador' => $this->creador_model->consulto($info->creador_id),
				'targeta' => $this->targeta_model->consulto($info->targeta_id),
				#################################
            );
        }
        return $retorno;
    }
}
//______________________________________________________________________
function nuevo($datos)
{
    $this->db->insert('eventos', $datos); 
    $id = $this->db->insert_id();
    return $id;
}
//______________________________________________________________________
function actualizo($datos)
{
    $this->db->where('id', $datos["id"]);
    $datos['ultimocambio'] = date("Y-m-d");
    return $this->db->update('eventos', $datos); 
}
//______________________________________________________________________
function consulto($id)
{
    #$this->db->join('rol', 'usuarios.rol_id = rol.rol_id', "inner"); #left inner
    $this->db->select('*');
    $this->db->from('eventos');
    $this->db->where("id",$id);
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno = array
        (
			'id' => $info->id,
			'targeta_id' => $info->targeta_id,
			'creador_id' => $info->creador_id,
			'descripcion' => $info->descripcion,
			'terminado' => $info->terminado,
			'puntos' => $info->puntos,
			'orden' => $info->orden,
			'sprint' => $info->sprint,
			'semana' => $info->semana,
			'ultimocambio' => $info->ultimocambio,
			#################################
			'creador' => $this->creador_model->consulto($info->creador_id),
			'targeta' => $this->targeta_model->consulto($info->targeta_id),
			#################################
       );
    }
	return $retorno;
}
//______________________________________________________________________
function delete($id)
{
    $this->db->delete('eventos', array('id' => $id));
}
//______________________________________________________________________
function terminados($id)
{
	$retorno = array();
	
	$this->db->select('SUM(puntos) as suma');
	$this->db->where("terminado",1);
	$this->db->where("targeta_id",$id);
	$consulta = $this->db->get('eventos');
	foreach($consulta->result() as $info)
    {
        $retorno["terminado"] = $info->suma;
    }
	
	$this->db->select('SUM(puntos) as suma');
	$this->db->where("terminado",0);
	$this->db->where("targeta_id",$id);
	$consulta = $this->db->get('eventos');
	foreach($consulta->result() as $info)
    {
        $retorno["pendiente"] = $info->suma;
    }
	return $retorno;
}
//______________________________________________________________________
}
?>