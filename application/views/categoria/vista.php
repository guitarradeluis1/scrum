<div id="body">
<?php echo anchor($controlador."/index", "Atras.", "class='plata'"); ?>
<?php echo anchor($controlador."/edit/".$Salida["id"], "Editar.", "class='plata'"); ?>
    <table>
        <tr>
            <td><b>ID : </b><?php echo $Salida["id"]; ?></td>
            <td><b>NOMBRE : </b><?php echo $Salida["nombre"]; ?></td>
        </tr>
        <tr>
            <td colspan="2"><b>DESCRIPCION : </b><br /><pre><?php echo $Salida["descripcion"]; ?></pre></td>
        </tr>
        <tr>
            <td><b>CREADO : </b><?php echo $Salida["creado"]; ?></td>
            <td><b>MODIFICADO : </b><?php echo $Salida["cambio"]; ?></td>
        </tr>
    </table>
    <hr />
    <b>TAREAS.</b>
    <hr />
    <?php echo anchor("tarea/add/".$Salida["id"], "Nueva tarea.", "class='plata'"); ?>
    <br />
    <a href="#" class="desplegar plata" despliego="t_noecho">Lista pendientes</a>
    <table id="t_noecho" style="display: ;">
        <tr>
            <th colspan="5"><b>LISTA PENDIENTES</b></th>
        </tr>
        <tr>
            <th><b>ID</b></th>
            <th><b>CREADO</b></th>
            <th><b>ESTIMADO</b></th>
            <th><b>ECHO</b></th>
			<th><b>TITULO</b></th>
            <th><b>DESCRIPCION</b></th>
        </tr>
        <?php
        if($Tareas)
        {
        foreach($Tareas as $Tarea)
        {
            if($Tarea["echo"] == 0)
            {
        ?>
        <tr>
            <td><?php echo anchor("tarea/vista/".$Tarea["id"], $Tarea["id"]); ?></td>
            <td><?php echo $Tarea["creado"]; ?></td>
            <td><?php echo $Tarea["estimado"]; ?> Horas</td>
            <td><?php echo $Tarea["echo"]; ?></td>
			<td><?php echo $Tarea["nombre"]; ?></td>
            <td><pre><?php echo $Tarea["descripcion"]; ?></pre></td>
        </tr>
        <?php
            }
        }
        }
        ?>
    </table>
    <br />
    <a href="#" class="desplegar plata" despliego="t_echo"">Lista terminada</a>
    <table id="t_echo" style="display: none;">
        <tr>
            <th colspan="5"><b>LISTA TERMINADOS</b></th>
        </tr>
        <tr>
            <th><b>ID</b></th>
            <th><b>CREADO</b></th>
            <th><b>ESTIMADO</b></th>
            <th><b>ECHO</b></th>
            <th><b>DESCRIPCION</b></th>
        </tr>
        <?php
        if($Tareas)
        {
        foreach($Tareas as $Tarea)
        {
                if($Tarea["echo"] == 1)
                {
        ?>
        <tr>
            <td><?php echo anchor("tarea/vista/".$Tarea["id"], $Tarea["id"]); ?></td>
            <td><?php echo $Tarea["creado"]; ?></td>
            <td><?php echo $Tarea["estimado"]; ?> Horas</td>
            <td><?php echo $Tarea["echo"]; ?></td>
            <td><pre><?php echo $Tarea["descripcion"]; ?></pre></td>
        </tr>
        <?php
            }
        }
        }
        ?>
    </table>
</div>
<?php 
    #echo "<pre>"; print_r($Salida); echo "</pre>";
    #echo "<pre>"; print_r($Tareas); echo "</pre>";
?>