<div id="body">
	<?php echo anchor($controlador."/index", "Atras", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor($controlador."/edit/".$Salida["id"], "Nuevo Proyecto", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor($controlador."/targeta/".$Salida["id"], "Agregar Tarjeta", "class='btn btn-dark my-1'"); ?>
	<div class="card">
		<div class="card-body">
			<blockquote class="blockquote mb-0">
				<p><?php echo $Salida["nombre"];?></p>
				<footer class="blockquote-footer">
					<b>Fechas:</b> <?php echo $Salida["inicio"]." ".$Salida["fin"]; ?><br/>
					<b>Semanas:</b> <?php echo date("W", strtotime($Salida["inicio"]))." A ".date("W", strtotime($Salida["fin"])); ?><br/>
					<cite title="Source Title">
					<?php
					if($Salida["prioridad"] == 0)
					{echo "Pendiente";}
					else if($Salida["prioridad"] == 1)
					{
						?><span class="badge badge-danger">Alta</span><?php
					}
					else if($Salida["prioridad"] == 2)
					{
						?><span class="badge badge-secondary">Media</span><?php
					}
					else if($Salida["prioridad"] == 3)
					{
						?><span class="badge badge-dark">Baja</span><?php
					}
					?>
					</cite>
				</footer>
			</blockquote>
		</div>
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">TITULO</th>
					<th scope="col">SEMANA</th>
					<th scope="col">ASIGNADO</th>
					<th scope="col">CATEGORIA</th>
					<th scope="col">ESTADO</th>
					<th scope="col">PORCENTAJE</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($Tarjetas)
				{
					foreach ($Tarjetas as $info) 
					{
					?>
						<tr>
							<th scope="row"><?php echo $info["tarjeta"]["id"]; ?></th>
							<td><?php echo $info["tarjeta"]["titulo"]; ?></td>
							<td><?php echo $info["tarjeta"]["semana"]; ?></td>
							<td><?php echo $info["tarjeta"]["creador"]["nombre"]; ?></td>
							<td><?php echo $info["tarjeta"]["categoria"]["nombre"]; ?></td>
							<td><?php
							if($info["tarjeta"]["posicion"] == 0)
							{echo "Pendiente";}
							else if($info["tarjeta"]["posicion"] == 1)
							{
								?><span class="badge badge-warning">Pendiente</span><?php
							}
							else if($info["tarjeta"]["posicion"] == 2)
							{
								?><span class="badge badge-success">En desarrollo</span><?php
							}
							else if($info["tarjeta"]["posicion"] == 3)
							{
								?><span class="badge badge-dark">Terminado</span><?php
							}
							?></td>
							<td>
								<input onchange="obj.porcentaje(this)" type="number" min="1" max="100" value="<?php echo $info["porcentaje"]; ?>"
							   proyecto_id="<?php echo $info["proyecto_id"]; ?>" targeta_id="<?php echo $info["targeta_id"]; ?>">
								%
							</td>
							<td>
								<?php echo anchor($controlador."/eliminarTarjeta/".$info["tarjeta"]["id"]."/".$Salida["id"], "Eliminar", "class='btn btn-danger my-1'"); ?>
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
	$hoy = date("Ymd");
	$semanaActual = date("W",strtotime($hoy));
	echo " <b>Semana Actual:</b> #".$semanaActual;
	?>
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col">#</th>
				<th scope="col">TITULO</th>
				<th scope="col">ASIGNADO</th>
				<?php
				for ($i = date("W", strtotime($Salida["inicio"])); $i <= date("W", strtotime($Salida["fin"])); $i++) {
					if($semanaActual == $i)
					{echo '<th scope="col"><span class="badge badge-pill badge-info">'.$i.'</span></th>';}
					else
					{echo '<th scope="col">'.$i.'</th>';}
				}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
			if($Tarjetas)
			{
				foreach ($Tarjetas as $info) 
				{
				?>
					<tr>
						<th scope="row"><?php echo $info["tarjeta"]["id"]; ?></th>
						<td><?php echo $info["tarjeta"]["titulo"]; ?></td>
						<td><?php echo $info["tarjeta"]["creador"]["nombre"]; ?></td>
						<?php
						for ($i = date("W", strtotime($Salida["inicio"])); $i <= date("W", strtotime($Salida["fin"])); $i++) {
							foreach ($Tarjetas as $inter)
							{
								if($info["tarjeta"]["id"] == $inter["tarjeta"]["id"])
								{
									if($inter["eventos"])
									{
										foreach ($inter["eventos"] as $evento)
										{
											$numSemana = date("W", strtotime($evento["semana"]));
											if($numSemana == $i)
											{
												if($evento["terminado"] == 0)
												{
													echo '<td class="table-danger" colspan="'.($evento["sprint"]).'">';
													echo '<b>sprint :</b> '.$evento["sprint"].'<br/>';
													echo '<b>puntos :</b> '.$evento["puntos"];
													echo '</td>';
												}
												else if($evento["terminado"] == 1)
												{
													echo '<td class="table-success" colspan="'.($evento["sprint"]).'">';
													echo '<b>sprint :</b> '.$evento["sprint"].'<br/>';
													echo '<b>puntos :</b> '.$evento["puntos"];
													echo '</td>';
												}
											}
										}
									}
									else
									{
										echo '<td>';
										echo '</td>';
									}
								}
							}
						}
						?>
					</tr>
				<?php
				}
			}
			?>
		</tbody>
	</table>
	<br/>
	<div class="row">
		<div class="col border">
			<div id="grafico2"></div>
		</div>
		<div class="col border">
			<div id="grafico"></div>
		</div>
	</div>
<?php
    #echo "<pre>"; print_r($Salida); echo "</pre>";
    #echo "<pre>"; print_r($Tarjetas); echo "</pre>";
?>
<script src="<?php echo base_url('js/highcharts/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('js/highcharts/modules/series-label.js'); ?>"></script>
<script src="<?php echo base_url('js/highcharts/modules/exporting.js'); ?>"></script>
<script src="<?php echo base_url('js/highcharts/modules/export-data.js'); ?>"></script>
<script type="text/javascript">
let obj = {
	porcentaje: (campo) => {
		let valor = $(campo).val();
		let proyecto_id = $(campo).attr(`proyecto_id`);
		let targeta_id = $(campo).attr(`targeta_id`);
		window.location.href = `../porcentaje/${proyecto_id}/${targeta_id}/${valor}`;
	}
};
let Tarjeta =<?php echo json_encode($Tarjetas); ?>;
let Salida =<?php echo json_encode($Salida); ?>;
let datos = [];
Tarjeta.map(v=>{
	var temporal = [v.tarjeta.titulo, parseInt(v.porcentaje)];
	datos.push(temporal);
});
//----------------------------------
Highcharts.chart('grafico', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 20,
            beta: 0
        }
    },
    title: {
        text: `${Salida.nombre}`
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
	series: [{
        type: 'pie',
        name: 'Porcentaje ',
        data: [
	   		<?php
			if($Tarjetas)
			{
				foreach ($Tarjetas as $info) 
				{
					$texto = "";
					$texto .= $info["tarjeta"]["titulo"];
					if($info["tarjeta"]["posicion"] == 0)
					{$texto = " <b>Pendiente </b>";}
					else if($info["tarjeta"]["posicion"] == 1)
					{
						$texto .= ' <b>Pendiente</b>';
					}
					else if($info["tarjeta"]["posicion"] == 2)
					{
						$texto .= ' <b>En desarrollo</b>';
					}
					else if($info["tarjeta"]["posicion"] == 3)
					{
						$texto .= ' <b>Terminado</b>';
					}
					echo "['".$texto."', ".$info["porcentaje"]."],";
				}
			}
			?>
        ]
    }]
});
//----------------------------------
Highcharts.chart('grafico2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false,
		//height:"20%"
		//width:"100%",
    },
    title: {
        text: `Actividades<br/>${Salida.nombre}`,
        align: 'center',
        verticalAlign: 'middle',
        y: 40
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br/>Puntos: <b>{point.Puntos}</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%'],
            size: '110%'
        }
    },
    series: [{
        type: 'pie',
        name: 'Porcentaje',
        innerSize: '50%',
        data: [
            <?php
			$diferencia = 0;
			#$diferencia = date("W", strtotime($Salida["fin"])) - date("W", strtotime($Salida["inicio"]));
			if($Tarjetas)
			{
				foreach ($Tarjetas as $inter)
				{
					if($inter["eventos"])
					{
						foreach ($inter["eventos"] as $evento)
						{$diferencia = $diferencia + $evento["puntos"];}
					}
				}
			}
			$valosUin = ( (1*100)/$diferencia );
			$semanasTerminado = 0;
			$terminado = 0;
			$semanasPendiente = 0;
			$pendiente = 0;
			if($Tarjetas)
			{
				foreach ($Tarjetas as $inter)
				{
					if($inter["eventos"])
					{
						foreach ($inter["eventos"] as $evento)
						{
							if($evento["terminado"] == 0)
							{
								$semanasPendiente = $semanasPendiente + $evento["puntos"];
								$pendiente = $pendiente + ($evento["puntos"]*$valosUin);
							}
							else if($evento["terminado"] == 1)
							{
								$semanasTerminado = $semanasTerminado + $evento["puntos"];
								$terminado = $terminado + ($evento["puntos"]*$valosUin);
							}
						}
					}

				}

			}
			#echo "['Terminado', ".$terminado."],";
			echo "{
                name: 'Terminado',
                y: ".$terminado.",
                Puntos: ".$semanasTerminado.",
				color: '#8EF07D',
                dataLabels: {
                    enabled: true
                }
            },";
			#echo "['Pendiente', ".$pendiente."]";
			echo "{
                name: 'Pendiente',
                y: ".$pendiente.",
				Puntos: ".$semanasPendiente.",
				color: '#F07D7D',
                dataLabels: {
                    enabled: true
                }
            },";
			?>
        ]
    }]
});
</script>