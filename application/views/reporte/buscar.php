<div id="body">
	<div class="card">
		<div class="row">
		<?php
		if($Salida)
		{
			?>
			<table class="table mb-0">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">TARJETA</th>
						<th scope="col">FECHA</th>
						<th scope="col">CREADOR</th>
						<th scope="col">ESTADO</th>
						<th scope="col">DESC</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($Salida)
				{
					foreach ($Salida as $dato) 
					{
						$dato["texto"] = str_replace("<blockquote>", '<div class="alert alert-light border border-success" role="alert">', $dato["texto"]);
						$dato["texto"] = str_replace("</blockquote>", '</div>', $dato["texto"]);
					?>
					<tr>
						<th scope="row"><?php echo $dato["id"]; ?></th>
						<td><?php echo $dato["eventos"]["targeta"]["titulo"]; ?></td>
						<td><?php echo $dato["fecha"]; ?></td>
						<td><?php echo $dato["creador"]["nombre"]; ?></td>
						<td><b><?php echo $dato["terminado"]; ?></b></td>
						<td><?php echo $dato["texto"]; ?></td>
					</tr>
					<?php
					}
				}
				?>
				</tbody>
			</table>
			<?php
		}
		?>
		</div>
	</div>
</div>
<?php 
    #echo "<pre>"; print_r($Salida); echo "</pre>";
?>
