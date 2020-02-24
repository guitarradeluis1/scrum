<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categoria extends CI_Controller {
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
   $this->load->model('categoria_model');
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
           $parametros["controlador"] = "categoria";
           $parametros["titulo_general"] = "Categoria";
           $parametros["funcion"] = "";
           $parametros["carpeta"] = "categoria";
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
public function index()
{
	$datos = array();
    $parametros = $this->parametros();
    $parametros["funcion"] = "index";
    $datos = $parametros;
    $datos["Salida"] = $this->categoria_model->todo();
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
    $datos["Salida"] = $this->categoria_model->consulto($id);
    $this->load->view($parametros["estilo"],$datos);
    $this->load->view($parametros["carpeta"]."/".$parametros["funcion"], $datos);
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
            $resultado = $this->categoria_model->nuevo($_POST);
            if($resultado != "") 
            {
                redirect($parametros["controlador"]."/index");
            }
            else #if($resultado == 0)
            {
                echo "<script>alert('Error de creacion.');</script>";
                redirect($parametros["controlador"]."/add");
            }
        }
    }
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
    $datos["Salida"] = $this->categoria_model->consulto($id);
    if (isset($_POST["post"]) )
    {
        #if ($_POST['opcion']!="")
        {
            unset($_POST["post"]);
            #echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
            $resultado = $this->categoria_model->actualizo($_POST);
            if($resultado == 1) 
            {
                #echo "<script>alert('Neuvo registro creado.');</script>";
                redirect($parametros["controlador"]."/index");
            }
            else if($resultado == 0)
            {
                #echo "<script>alert('nuevoregitra');</script>";
                redirect($parametros["controlador"]."/edit/".$id);
            }
        }
    }
    $this->load->view($parametros["estilo"],$datos);
    $this->load->view($parametros["carpeta"]."/".$parametros["funcion"], $datos);
    $this->load->view("footer");
}
//_____________________________________________________
public function eliminar($id)
{
    $datos = array();
    $parametros = $this->parametros();
    $parametros["funcion"] = "edit";
    $datos = $parametros;
    $datos["Salida"] = $this->categoria_model->consulto($id);
	$this->eventos_model->delete($id);
    redirect($parametros["controlador"]."/index/".$datos["Salida"]["targeta_id"]);;
}
//_____________________________________________________
}
?>