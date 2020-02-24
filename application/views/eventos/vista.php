<div id="body">
<?php echo anchor("inicio/vista/".$Salida["carpeta_id"], "Atras.", "class='plata'"); ?>
<?php echo anchor($controlador."/edit/".$Salida["id"], "Editar.", "class='plata'"); ?>
    <table>
        <tr>
            <td><b>ID : </b><?php echo $Salida["id"]; ?></td>
            <td><b>NOMBRE : </b><?php echo $Salida["nombre"]; ?></td>
            <td rowspan="4"><?php echo img("img/tra.gif"); ?></td>
        </tr>
        <tr>
            <td colspan="2"><b>DESCRIPCION : </b><br /><pre><?php echo $Salida["descripcion"]; ?></pre></td>
        </tr>
        <tr>
            <td><b>CREADO : </b><?php echo $Salida["creado"]; ?></td>
            <td><b>EDITADO : </b><?php echo $Salida["cambio"]; ?></td>
        </tr>
        <tr>
            <td><b>ESTIMADO : </b><?php echo $Salida["estimado"]; ?> horas</td>
            <td><b>ECHO : </b><?php echo $Salida["echo"]; ?></td>
        </tr>
    </table>
    <hr />
    <b>SEGUIMIENTO.</b>
    <hr />
    <?php echo anchor("seguimiento/add/".$Salida["id"], "Nueva seguimiento.", "class='plata'"); ?>
    <br />
    <a href="#" class="desplegar plata" despliego="t_segui" >Lista seguimientos.</a>
    <table id="t_segui" style="display: none;">
        <tr>
            <th colspan="5"><b>LISTA SEGUIMIENTOS</b></th>
        </tr>
        <tr>
            <th><b>ID</b></th>
            <th><b>TIEMPO</b></th>
            <th><b>COMENTARIO</b></th>
            <th><b>INICIO</b></th>
            <th><b>FIN</b></th>
        </tr>
        <?php
        $suma_tiempo = "00:00:00";
        if($Seguimientos)
        {
        foreach($Seguimientos as $Seguimiento)
        {
        ?>
        <tr>
            <td><?php echo $Seguimiento["id"]; ?></td>
            <td><?php echo $Seguimiento["tiempo"]; ?></td>
            <td><pre><?php echo $Seguimiento["comentario"]; ?></pre></td>
            <td><?php echo $Seguimiento["inicio"]; ?> Horas</td>
            <td><?php echo $Seguimiento["fin"]; ?></td>
        </tr>
        <?php
            $sumo = $Seguimiento["tiempo"];
            $suma_tiempo = suma_tiempos($suma_tiempo, $sumo);
        }
        }
        ?>
        <tr>
            <th colspan="5"><b>TOTAL </b><?php echo $suma_tiempo; ?></th>
        </tr>
    </table>
</div>
<?php 
    #echo "<pre>"; print_r($Salida); echo "</pre>";
    #echo "<pre>"; print_r($Seguimientos); echo "</pre>";
?>