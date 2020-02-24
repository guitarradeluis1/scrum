<div id="body">
	<?php echo anchor("inicio/", "Atras", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor($controlador."/add", "Nueva Categoria", "class='btn btn-dark my-1'"); ?>
	<div class="container">
		<table class="table">
		  <thead class="thead-light">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">NOMBRE</th>
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
					<td>
						<?php echo anchor($controlador."/edit/".$info["id"], "Editar", "class='btn btn-info my-1'"); ?>
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
<?php #echo "<pre>"; print_r($Eventos); echo "</pre>"; ?>
<?php #echo "<pre>"; print_r($Hacer); echo "</pre>"; ?>