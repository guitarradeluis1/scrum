<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hacer extends CI_Controller {
     /*
     1. Nombre del controlado en minuscula
     2. Nombre de la clase en mayuscula la primera
     3. crear el costructor
     4. Cada funcion puede tener su propias vistas dirigiendo la ruta
     */
function __construct()
{
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->helper('general');
	$this->load->library('pagination');
	$this->load->model('hacer_model');
	$this->load->model('creador_model');
	$this->load->model('eventos_model');
}
//_____________________________________________________
    public function parametros()
    {
       #$id = $this->session->userdata("id");
       #if(isset($id) && $id !="")
       {
           $parametros = array();
           $parametros["total_registro"] = 20;
           $parametros["estilo"] = "cabeza";
           $parametros["controlador"] = "hacer";
           $parametros["titulo_general"] = "Hacer";
           $parametros["funcion"] = "";
           $parametros["carpeta"] = "hacer";
           $parametros["Mensaje_alerta"] = "";
           #$parametros["session"] = $this->variables_session();
           #if($parametros["session"]["tipousuario_id"]==1)
           {$parametros["menu"] = "Menu";}
           #else
           #{$parametros["menu"] = "Menu_acesor";}
           return $parametros;
       }
       #else
       #{redirect("/welcome/salir", 'location');}
    }
    #####################
    public function variables_session()
    {
       $lugares = campos_session();
       $datos_session = array();
       foreach($lugares as $texto)
       { $datos_session[$texto] = $this->session->userdata($texto);}
       return $datos_session;
	}
//_____________________________________________________
public function index($eventos_id)
{
   $datos = array();
   $parametros = $this->parametros();
   $parametros["funcion"] = "index";
   $datos = $parametros;
   $datos["Eventos"] = $this->eventos_model->consulto($eventos_id);
   $datos["Hacer"] = $this->hacer_model->todo($eventos_id);
   $this->load->view($parametros["estilo"],$datos);
   $this->load->view($parametros["carpeta"]."/".$parametros["funcion"], $datos);
   $this->load->view("footer");
}
//_____________________________________________________
public function vista($id)
{
    $datos = array();
    $parametros = $this->parametros();
    $parametros["funcion"] = "vista";
    $datos = $parametros;
    #$datos["Mensaje_alerta"] = $mensaje;
    $datos["Salida"] = $this->hacer_model->consulto($id);
    $this->load->view($parametros["estilo"],$datos);
    #$this->load->view($parametros["menu"]);
    $this->load->view($parametros["carpeta"]."/".$parametros["funcion"], $datos);
    #$this->load->view("botones_menu");
    $this->load->view("footer");
}
//_____________________________________________________
public function add($eventos_id)
{
    $datos = array();
    $parametros = $this->parametros();
    $parametros["funcion"] = "add";
    $datos = $parametros;
    if (isset($_POST["post"]) )
    {
        #if ($_POST['opcion']!="")
        {
            unset($_POST["post"]);
            #echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
            $resultado = $this->hacer_model->nuevo($_POST);
            if($resultado != "") 
            {
                redirect($parametros["controlador"]."/index/".$eventos_id);
            }
            else #if($resultado == 0)
            {
                echo "<script>alert('Error de creacion.');</script>";
                redirect($parametros["controlador"]."/add");
                #redirect("/".$datos["controlador"]."/234", 'location');
            }
        }
    }
	$datos["credores"] = $this->creador_model->todo();
	$datos["eventos_id"] = $eventos_id;
    $this->load->view($parametros["estilo"],$datos);
    $this->load->view($parametros["carpeta"]."/".$parametros["funcion"], $datos);
    $this->load->view("footer");
}
//_____________________________________________________
public function edit($id)
{
    $datos = array();
    $parametros = $this->parametros();
    $parametros["funcion"] = "edit";
    $datos = $parametros;
    $datos["Salida"] = $this->hacer_model->consulto($id);
    if (isset($_POST["post"]) )
    {
        #if ($_POST['opcion']!="")
        {
            unset($_POST["post"]);
			$retorno = $_POST["retorno"];
			unset($_POST["retorno"]);
			#echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
            $resultado = $this->hacer_model->actualizo($_POST);
            if($resultado == 1) 
            {
				if($retorno == 'on')
				{
					redirect($parametros["controlador"]."/edit/".$id);
				}
				else
				{
					redirect($parametros["controlador"]."/index/".$datos["Salida"]["eventos_id"]);
				}
            }
            else if($resultado == 0)
            {
                redirect($parametros["controlador"]."/edit/".$datos["Salida"]["id"]);
            }
        }
    }
    $datos["credores"] = $this->creador_model->todo();
    $this->load->view($parametros["estilo"],$datos);
    $this->load->view($parametros["carpeta"]."/".$parametros["funcion"], $datos);
    $this->load->view("footer");
}
//_____________________________________________________
}
?>