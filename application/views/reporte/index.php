<div id="body">
	<?php echo anchor("inicio/", "Atras", "class='btn btn-dark my-1'"); ?>
	<div class="container">
		<table class="table">
		  <thead class="thead-light">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">TITULO</th>
			  <th scope="col">POSICION</th>
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
					<td><?php echo $info["titulo"]; ?></td>
					<td><b>
						<?php
						if($info["posicion"] == 1){echo "<p class='text-success'>Pendiente</p>";}
						else if($info["posicion"] == 2){echo "<p class='text-danger'>En desarrollo</p>";}
						else if($info["posicion"] == 3){echo "<p class='text-info'>Terminado</p>";}
						else if($info["posicion"] == 4){echo "Cerrado";}
						?></b>
					</td>
					<td>
						<?php echo anchor($controlador."/vista/".$info["id"], "VISTA <span class='badge badge-light'>".$info["conteo"]."</span>", "class='btn btn-info my-1'"); ?>
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