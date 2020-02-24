<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inicio extends CI_Controller {
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
   #$this->load->library('session');
   $this->load->library('pagination');
   $this->load->model('targeta_model');
   $this->load->model('creador_model');
   $this->load->model('categoria_model');
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
           $parametros["controlador"] = "inicio";
           $parametros["titulo_general"] = "Tarjetas.";
           $parametros["funcion"] = "";
           $parametros["carpeta"] = "inicio";
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
public function index($paguina = null)
{
   $datos = array();
   $parametros = $this->parametros();
   $parametros["funcion"] = "index";
   $datos = $parametros;
   $datos["Targetas"] = $this->targeta_model->todo();
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
    $datos["Salida"] = $this->carpeta_model->consulto($id);
    $datos["Tareas"] = $this->tarea_model->todo_carpeta($id);
    $this->load->view($parametros["estilo"],$datos);
    #$this->load->view($parametros["menu"]);
    $this->load->view($parametros["carpeta"]."/".$parametros["funcion"], $datos);
    #$this->load->view("botones_menu");
    $this->load->view("footer");
}
//_____________________________________________________
public function add()
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
            $resultado = $this->targeta_model->nuevo($_POST);
            if($resultado != "") 
            {
                #echo "<script>alert('Neuvo registro creado.');</script>";
                redirect($parametros["controlador"]."/index");
            }
            else #if($resultado == 0)
            {
                echo "<script>alert('Error de creacion.');</script>";
                redirect($parametros["controlador"]."/index/");
                #redirect("/".$datos["controlador"]."/234", 'location');
            }
        }
    }
	$datos["credores"] = $this->creador_model->todo();
	$datos["categorias"] = $this->categoria_model->todo();
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
    $datos["Salida"] = $this->targeta_model->consulto($id);
    if (isset($_POST["post"]) )
    {
        #if ($_POST['opcion']!="")
        {
            unset($_POST["post"]);
            #echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
            $resultado = $this->targeta_model->actualizo($_POST);
            if($resultado == 1) 
            {
                #echo "<script>alert('Neuvo registro creado.');</script>";
                redirect("eventos/index/".$id);
            }
            else if($resultado == 0)
            {
                #echo "<script>alert('nuevoregitra');</script>";
                redirect($parametros["controlador"]."/index");
                #redirect("/".$datos["controlador"]."/234", 'location');
            }
        }
    }
    $datos["credores"] = $this->creador_model->todo();
	$datos["categorias"] = $this->categoria_model->todo();
    $this->load->view($parametros["estilo"],$datos);
    $this->load->view($parametros["carpeta"]."/".$parametros["funcion"], $datos);
    $this->load->view("footer");
}
//_____________________________________________________
public function buscar($texto, $proyecto_id)
{
	$datos = array();
	$parametros = $this->parametros();
	$parametros["funcion"] = "buscar";
	$datos = $parametros;
	$datos["datos"] = $this->targeta_model->buscar($texto);
	$datos["proyecto_id"] = $proyecto_id;
	$this->load->view($parametros["carpeta"]."/".$parametros["funcion"], $datos);
}
//_____________________________________________________
}
?>