<div id="body">
	<?php echo anchor("inicio/", "Atras", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor($controlador."/add", "Nuevo Proyecto", "class='btn btn-dark my-1'"); ?>
	<div class="container">
		<table class="table">
		  <thead class="thead-light">
			<tr>
				<th scope="col">#</th>
				<th scope="col">NOMBRE</th>
				<th scope="col">INICIO</th>
				<th scope="col">FIN</th>
				<th scope="col">TARGETAS</th>
				<th scope="col">PRIORIDAD</th>
			  	<th></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			if($Salida)
			{
				foreach ($Salida as $info) 
				{
				?>
				<tr>
					<th scope="row"><?php echo $info["id"]; ?></th>
					<td><?php echo $info["nombre"]; ?></td>
					<td><?php echo $info["inicio"]; ?></td>
					<td><?php echo $info["fin"]; ?></td>
					<td><?php echo $info["conteo"]; ?></td>
					<td><?php
					if($info["prioridad"] == 0)
					{echo "Pendiente";}
					else if($info["prioridad"] == 1)
					{
						?><span class="badge badge-danger">Alta</span><?php
					}
					else if($info["prioridad"] == 2)
					{
						?><span class="badge badge-secondary">Media</span><?php
					}
					else if($info["prioridad"] == 3)
					{
						?><span class="badge badge-dark">Baja</span><?php
					}
					?></td>
					<td>
						<?php echo anchor($controlador."/edit/".$info["id"], "Editar", "class='btn btn-info my-1'"); ?>
						<?php echo anchor($controlador."/vista/".$info["id"], "Vista", "class='btn btn-success my-1'"); ?>
					</td>
				</tr>
				<?php
				}
			}
			?>
		  </tbody>
		</table>
	</div>
</div>
<?php #echo "<pre>"; print_r($Salida); echo "</pre>"; ?>