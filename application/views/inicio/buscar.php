<div class="container">
	<table class="table">
	  <thead class="thead-light">
		<tr>
			<th scope="col">#</th>
			<th scope="col">TITULO</th>
			<th scope="col">SEMANA</th>
			<th scope="col">ASIGNADO</th>
			<th scope="col">CATEGORIA</th>
			<th scope="col">PORCENTAJE</th>
			<th scope="col"></th>
		</tr>
	  </thead>
	  <tbody>
		<?php
		if($datos)
		{
			foreach ($datos as $info) 
			{
			?>
			<tr>
				<th scope="row"><?php echo $info["id"]; ?></th>
				<td><?php echo $info["titulo"]; ?></td>
				<td><?php echo $info["semana"]; ?></td>
				<td><?php echo $info["creador"]["nombre"]; ?></td>
				<td><?php echo $info["categoria"]["nombre"]; ?></td>
				<td>
					<?php echo anchor("proyecto/addTarjeta/".$info["id"]."/".$proyecto_id, "Agregar", "class='btn btn-info my-1'"); ?>
				</td>
			</tr>
			<?php
			}
		}
		?>
	  </tbody>
	</table>
</div>
<?php 
    #echo "<pre>"; print_r($datos); echo "</pre>";
?>