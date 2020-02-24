<div id="body">
	<?php echo anchor("creador/index", "Creadores", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor("categoria/index", "Categoria", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor($controlador."/add", "Nueva tarjeta.", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor("proyecto/index", "Proyecto", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor("reporte/index", "Reportes", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor("reporte/hacer", "Consulta Hacer", "class='btn btn-dark my-1'"); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm border border-dark">
				<div class="alert alert-info" role="alert">Pendiente</div>
				<?php
				if($Targetas)
				{
					foreach ($Targetas as $info) 
					{
						if($info["posicion"] == 1 && $info["visible"] == 1)
						{
							$semana = date("W",strtotime($info["semana"])); //Sabemos en que semana nos encontramos del año.
							$any_anterior=date("Y",strtotime($info["semana"]." -1 year")); //Sabemos el año anterior 
							$la_fecha = date("Y-m",strtotime(($any_anterior+1)."-W".$semana));
						?>
						<div class="card border border-success" style="width: 20rem;">
							<div class="card-body">
								<h4 class="card-title"><?php echo $info["titulo"]; ?></h4>
								<p class="card-text">
									<?php echo $info["categoria"]["nombre"]." (".$info["creador"]["nombre"].")"; ?><hr/>
									<?php echo $info["quien"]; ?><br/>
									<?php echo $info["que"]; ?><br/>
									<?php echo $info["para_que"]; ?><br/>
									<b>Semana Inicio :</b><?php echo $la_fecha. " #".$semana; ?><br/>
									<b>Prioridad :</b><?php echo $info["prioridad"]; ?>
									<b>Puntos :</b><?php echo $info["puntos"]; ?>
									<b>Sprint :</b><?php echo $info["sprint"]; ?><br/>
									<b>Estado : </b><?php echo $info["terminados"]["terminado"]."/".$info["sprint"]; ?><br/>
									<span class="badge badge-dark"><?php echo $info["ultimocambio"]; ?></span>
								</p>
							</div>
							<div class="card-actions">
								<?php echo anchor($controlador."/edit/".$info["id"], "Editar", "class='btn btn-info my-1'"); ?>
								<?php echo anchor("eventos/index/".$info["id"], "Eventos", "class='btn btn-success my-1'"); ?>
							</div>
						</div>
						<?php
						}
					}
				}
				?>
				<br/>
			</div>
			<div class="col-sm border border-dark">
				<div class="alert alert-info" role="alert">En desarrollo</div>
				<?php
				if($Targetas)
				{
					foreach ($Targetas as $info) 
					{
						if($info["posicion"] == 2 && $info["visible"] == 1)
						{
							$semana = date("W",strtotime($info["semana"])); //Sabemos en que semana nos encontramos del año.
							$any_anterior=date("Y",strtotime($info["semana"]." -1 year")); //Sabemos el año anterior 
							$la_fecha = date("Y-m",strtotime(($any_anterior+1)."-W".$semana));
						?>
						<div class="card border border-success" style="width: 20rem;">
							<div class="card-body">
								<h4 class="card-title"><?php echo $info["titulo"]; ?></h4>
								<p class="card-text">
									<?php echo $info["categoria"]["nombre"]." (".$info["creador"]["nombre"].")"; ?><hr/>
									<?php echo $info["quien"]; ?><br/>
									<?php echo $info["que"]; ?><br/>
									<?php echo $info["para_que"]; ?><br/>
									<b>Semana Inicio :</b><?php echo $la_fecha. " #".$semana; ?><br/>
									<b>Prioridad :</b><?php echo $info["prioridad"]; ?>
									<b>Puntos :</b><?php echo $info["puntos"]; ?>
									<b>Sprint :</b><?php echo $info["sprint"]; ?><br/>
									<b>Estado : </b><?php echo $info["terminados"]["terminado"]."/".$info["sprint"]; ?><br/>
									<span class="badge badge-dark"><?php echo $info["ultimocambio"]; ?></span>
								</p>
							</div>
							<div class="card-actions">
								<?php echo anchor($controlador."/edit/".$info["id"], "Editar", "class='btn btn-info my-1'"); ?>
								<?php echo anchor("eventos/index/".$info["id"], "Eventos", "class='btn btn-success my-1'"); ?>
							</div>
						</div>
						<?php
						}
					}
				}
				?>
				<br/>
			</div>
			<div class="col-sm border border-dark">
				<div class="alert alert-info" role="alert">Terminado</div>
				<?php
				if($Targetas)
				{
					foreach ($Targetas as $info) 
					{
						if($info["posicion"] == 3 && $info["visible"] == 1)
						{
							$semana = date("W",strtotime($info["semana"])); //Sabemos en que semana nos encontramos del año.
							$any_anterior=date("Y",strtotime($info["semana"]." -1 year")); //Sabemos el año anterior 
							$la_fecha = date("Y-m",strtotime(($any_anterior+1)."-W".$semana));
						?>
						<div class="card border border-success" style="width: 20rem;">
							<div class="card-body">
								<h4 class="card-title"><?php echo $info["titulo"]; ?></h4>
								<p class="card-text">
									<?php echo $info["categoria"]["nombre"]." (".$info["creador"]["nombre"].")"; ?><hr/>
									<?php echo $info["quien"]; ?><br/>
									<?php echo $info["que"]; ?><br/>
									<?php echo $info["para_que"]; ?><br/>
									<b>Semana Inicio :</b><?php echo $la_fecha. " #".$semana; ?><br/>
									<b>Prioridad :</b><?php echo $info["prioridad"]; ?>
									<b>Puntos :</b><?php echo $info["puntos"]; ?>
									<b>Sprint :</b><?php echo $info["sprint"]; ?><br/>
									<b>Estado : </b><?php echo $info["terminados"]["terminado"]."/".$info["sprint"]; ?><br/>
									<span class="badge badge-dark"><?php echo $info["ultimocambio"]; ?></span>
								</p>
							</div>
							<div class="card-actions">
								<?php echo anchor($controlador."/edit/".$info["id"], "Editar", "class='btn btn-info my-1'"); ?>
								<?php echo anchor("eventos/index/".$info["id"], "Eventos", "class='btn btn-success my-1'"); ?>
							</div>
						</div>
						<?php
						}
					}
				}
				?>
				<br/>
			</div>
		</div>
		<hr/>
		<table class="table table-sm">
		  <thead class="thead-light">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">TITULO</th>
			  <th scope="col">SEMENA</th>
			  <th scope="col">ESTADO</th>
			  <th scope="col">ULTIMO CAMBIO</th>
			  <th scope="col">SPRINT</th>
			  <th scope="col"></th>
			  <th scope="col"></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			if($Targetas)
			{
				foreach ($Targetas as $info) 
				{
					if($info["visible"] == 0 || $info["posicion"] == 4)
					{
						$semana = date("W",strtotime($info["semana"])); //Sabemos en que semana nos encontramos del año.
						$any_anterior=date("Y",strtotime($info["semana"]." -1 year")); //Sabemos el año anterior 
						$la_fecha = date("Y-m",strtotime(($any_anterior+1)."-W".$semana));
					?>
			  		<tr>
					  	<th scope="row"><?php echo $info["id"]; ?></th>
					  	<td><?php echo $info["titulo"]; ?></td>
					  	<td><?php echo $la_fecha. " #".$semana; ?></td>
						<td><b>
							<?php
							if($info["posicion"] == 1){echo "<p class='text-success'>Pendiente</p>";}
							else if($info["posicion"] == 2){echo "<p class='text-danger'>En desarrollo</p>";}
							else if($info["posicion"] == 3){echo "<p class='text-info'>Terminado</p>";}
							else if($info["posicion"] == 4){echo "Cerrado";}
							?></b>
						</td>
						<td>
							<span class="badge badge-dark"><?php echo $info["ultimocambio"]; ?></span>
						</td>
						<td><?php echo $info["terminados"]["terminado"]."/".$info["sprint"]; ?></td>
					  	<td>
					  		<?php echo anchor($controlador."/edit/".$info["id"], "Editar", "class='btn btn-info my-1'"); ?>
						</td>
						<td>
							<?php echo anchor("eventos/index/".$info["id"], "Eventos", "class='btn btn-success my-1'"); ?>
						</td>
					</tr>
					<?php
					}
				}
			}
			?>
		  </tbody>
		</table>
	</div>
</div>
<?php #echo "<pre>"; print_r($Targetas); echo "</pre>"; ?>