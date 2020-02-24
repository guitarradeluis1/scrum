<?php
//__________________________________________________________________________________
function img($src = null, $estilo = null, $idcampo = null, $valor = null ) 
{
    $img = "<img src='".base_url()."".$src."' ";
    if($estilo!="")
    { $img .= " class = '".$estilo."' "; }
    if($idcampo!="")
    { $img .= " id = '".$idcampo."' "; }
    if($valor!="")
    { $img .= " valor = '".$valor."' "; }
    $img .= "' />";
    return $img;
}
//__________________________________________________________________________________
function campos_session()
{
    $datos = array
    (
        "id",
        "id_usuario",
        "tipousuario_id",
        "nombreusuario",
        "correo",
        "nombre_apellido"
    );
    return $datos;
}
//__________________________________________________________________________________
function creador_selector($nombre, $Opciones, $otro)
{
    $selec = '';
    $selec .= '<select size="1" name = "'.$nombre.'" '.$otro.'>';
    foreach($Opciones as $Opcione)
    {
        #echo "<pre>"; print_r($Opcione); echo "</pre>"; exit;
        $selec .= '<option value="'.$Opcione.'">'.$Opcione.'</option>';
    }
    $selec .= '</select>';
    return $Opciones;
}
//__________________________________________________________________________________
function creador_selector_id($nombre, $Opciones, $otro)
{
    $selec = '';
    $selec .= '<select size="1" name = "'.$nombre.'" '.$otro.'>';
    foreach($Opciones as $Opcione)
    {
        echo "<pre>"; print_r($Opcione); echo "</pre>"; exit;
        $selec .= '<option value="'.$Opcione->id.'">'.$Opcione->opcion.'</option>';
    }
    $selec .= '</select>';
    return $Opciones;
}
//__________________________________________________________________________________
function suma_tiempos($time1, $time2)
{
    #............................................
    list($hour1, $min1, $sec1) = parteHora($time1);
    #............................................
    list($hour2, $min2, $sec2) = parteHora($time2);
    #............................................
    $salida = date('H:i:s', mktime( $hour1 + $hour2, $min1 + $min2, $sec1 + $sec2));
    #$salida = strtotime($salida );
    #return date("h:i a", $salida);
    return $salida;
}
function parteHora( $hora )
{
    $horaSplit = explode(":", $hora);
    if( count($horaSplit) < 3 )
    {
        $horaSplit[2] = 0;
    }
    return $horaSplit;
}
//__________________________________________________________________________________
?>