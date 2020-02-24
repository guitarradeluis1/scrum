<div id="body">
	<?php echo anchor("inicio/index", "Tarjeta", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor("inicio/edit/".$Tarjeta["id"], "Editar tarjeta", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor($controlador."/add/".$Tarjeta["id"], "Nuevo Evento", "class='btn btn-dark my-1'"); ?>
	<div class="container">
		<div class="alert alert-info" role="alert">
			<?php 
				$semana = date("W",strtotime($Tarjeta["semana"])); //Sabemos en que semana nos encontramos del año.
				$any_anterior=date("Y",strtotime($Tarjeta["semana"]." -1 year")); //Sabemos el año anterior 
				$la_fecha = date("Y-m",strtotime(($any_anterior+1)."-W".$semana));
				echo "<b>".$Tarjeta["creador"]["nombre"]."</b> | ";
				echo "<b>Tarjeta:</b> ".$Tarjeta["titulo"];
				echo " <b>Puntos:</b> ".$Tarjeta["puntos"];
				echo " <b>Sprint:</b> ".$Tarjeta["sprint"];
				echo " <b>Fecha Inicio:</b> ".$la_fecha. " #".$semana;
				$hoy = date("Ymd");
				$semanaActual = date("W",strtotime($hoy));
				echo " <b>Semana Actual:</b> #".$semanaActual;
			?>
			<span class="badge badge-dark"><?php echo $Tarjeta["ultimocambio"]; ?></span>
		</div>
		<table class="table table-sm">
		  <thead class="thead-light">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">SEMANA</th>
			  <th scope="col">A CARGO</th>
			  <th scope="col">SPRINT</th>
			  <th scope="col">PUNTOS</th>
			  <th scope="col">DESC</th>
			  <th scope="col">ESTADO</th>
			  <th></th>
			  <th></th>
			  <th></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			if($Eventos)
			{
				$sprint = 0;
				$puntos = 0;
				$anterior = 0;
				foreach ($Eventos as $info) 
				{
					?>
					<tr>
						<th scope="row"><?php echo $info["orden"]; ?></th>
						<td>
							<?php 
							$semanaRegistro = $semanaActual;
							if($info["semana"])
							{
								$semana = date("W",strtotime($info["semana"])); //Sabemos en que semana nos encontramos del año.
								
								$anterior = 1;
								$any_anterior=date("Y",strtotime($info["semana"]." -1 year")); //Sabemos el año anterior 
								$la_fecha = date("Y-m",strtotime(($any_anterior+1)."-W".$semana));
								if($info["terminado"] == 0)
								{
									if($semana >= $semanaActual && $semana <= ($info["sprint"]+$semana)  )
									{ ?><span class="badge badge-dark"><?php }
									else
									{ ?><span class="badge badge-success"><?php }
								}
								else if($info["terminado"] == 1)
								{ ?><span class="badge badge-dark"><?php }
									if($info["sprint"]>1)
									{echo $la_fecha." #".$semana." A ".($info["sprint"]+$semana-1);}
									else
									{echo $la_fecha." #".$semana;}
									$semanaRegistro = $semana;
								?></span><?php
							}
							?>
						</td>
						<td><b><?php echo $info["creador"]["nombre"]; ?></b></td>
						<td><?php echo $info["sprint"]; ?></td>
						<td><?php echo $info["puntos"]; ?></td>
						<td><?php echo $info["descripcion"]; ?></td>
						<td><b>
							<?php
							if($info["terminado"] == 0){echo "<p class='text-success'>Pendiente</p>";}
							else if($info["terminado"] == 1) {echo "Terminado";}
							?></b>
							<br/>
							<span class="badge badge-dark"><?php echo $info["ultimocambio"]; ?></span>
						</td>
						<td>
							<?php
							#if($semanaRegistro >= $semanaActual)
							{echo anchor($controlador."/edit/".$info["id"], "Editar", "class='btn btn-info my-1'"); }
							?>
						</td>
						<td>
							<?php
							#if($semanaRegistro >= $semanaActual)
							{echo anchor($controlador."/eliminar/".$info["id"], "Borrar", "class='btn btn-danger my-1'"); }
							?>
						</td>
						<td>
							<?php
							#if($semanaRegistro >= $semanaActual)
							{echo anchor("hacer/index/".$info["id"], "Hacer", "class='btn btn-success my-1'"); }
							?>
						</td>
					</tr>
					<?php
					$sprint = $sprint + $info["sprint"];
					$puntos = $puntos + $info["puntos"];
				}
				?>
			<tr>
				<th></th>
				<td></td>
				<td></td>
				<td class="text-white-50 bg-dark"><?php echo $sprint." / ".$Tarjeta["sprint"]; ?></td>
				<td class="text-white-50 bg-dark"><?php echo $puntos." / ".$Tarjeta["puntos"]; ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php
			}
			?>
		  </tbody>
		</table>
		<br/>
		<div id="grafico"></div>
	</div>
</div>
<?php #echo "<pre>"; print_r($Eventos); echo "</pre>"; ?>
<?php #echo "<pre>"; print_r($Tarjeta); echo "</pre>"; ?>