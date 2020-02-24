<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hacer_model extends CI_Model
{
    function __construct()
    {
       parent::__construct();
       $this->load->database();
       #$this->load->library('session');
       $this->load->model('creador_model');
       $this->load->model('eventos_model');
    }
//________________________________________________________________
function todo($eventos_id) 
{
    $this->db->select('*');
    #$this->db->from('eventos');
    #$this->db->join('tipousuario', 'tipousuario.id = usuarios.tipousuario_id', "inner"); #left inner
	$this->db->where("eventos_id", $eventos_id);
    $this->db->order_by('fecha', 'desc');
    $consulta = $this->db->get('hacer');
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
				'eventos_id' => $info->eventos_id,
				'fecha' => $info->fecha,
				'texto' => $info->texto,
				'terminado' => $info->terminado,
				#################################
				#'eventos' => $this->eventos_model->consulto($info->eventos_id),
				'creador' => $this->creador_model->consulto($info->creador_id),
				#################################
            );
        }
        return $retorno;
    }
}
//______________________________________________________________________
function nuevo($datos)
{
    $this->db->insert('hacer', $datos); 
    $id = $this->db->insert_id();
    return $id;
}
//______________________________________________________________________
function actualizo($datos)
{
    $this->db->where('id', $datos["id"]);
    return $this->db->update('hacer', $datos); 
}
//______________________________________________________________________
function consulto($id)
{
    #$this->db->join('rol', 'usuarios.rol_id = rol.rol_id', "inner"); #left inner
    $this->db->select('*');
    $this->db->from('hacer');
    $this->db->where("id",$id);
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno = array
        (
			'id' => $info->id,
			'creador_id' => $info->creador_id,
			'eventos_id' => $info->eventos_id,
			'fecha' => $info->fecha,
			'texto' => $info->texto,
			'terminado' => $info->terminado,
			#################################
			#'eventos' => $this->eventos_model->consulto($info->eventos_id),
			'creador' => $this->creador_model->consulto($info->creador_id),
			#################################
       );
    }
	return $retorno;
}
//______________________________________________________________________
function consultoRango($inicio, $fin)
{
    $this->db->select('id, creador_id, fecha, texto, terminado, eventos_id');
    $this->db->from('hacer');
    $this->db->where("fecha BETWEEN '{$inicio}' AND '{$fin}'");
	$consulta = $this->db->get();
    $retorno = array();
    foreach($consulta->result() as $info)
    {
        $retorno[] = array
        (
			'id' => $info->id,
			'creador_id' => $info->creador_id,
			'fecha' => $info->fecha,
			'texto' => $info->texto,
			'terminado' => $info->terminado == 1? 'SI': 'NO',
			#################################
			'eventos' => $this->eventos_model->consulto($info->eventos_id),
			'creador' => $this->creador_model->consulto($info->creador_id),
			#################################
       );
    }
	return $retorno;
}
//______________________________________________________________________
//______________________________________________________________________
}
?>