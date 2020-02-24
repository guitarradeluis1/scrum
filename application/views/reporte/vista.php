<div id="body">
	<?php echo anchor($controlador."/index", "Atras", "class='btn btn-dark my-1'"); ?>
	<?php 
	$hoy = date("d/m/Y");
	echo anchor($controlador."/clonar/".$Tarjeta["id"], "Nuevo Reporte ".$hoy, "class='btn btn-dark my-1'"); ?>
	<div class="card">
		<div class="card-body">
			<blockquote class="blockquote mb-0">
				<p><?php echo $Tarjeta["titulo"];?></p>
				<footer class="blockquote-footer">
					<b>Categoria:</b> <?php echo $Tarjeta["categoria"]["nombre"]; ?>
					<b>Puntos:</b> <?php echo $Tarjeta["puntos"]; ?>
					<b>Sprint:</b> <?php echo $Tarjeta["sprint"]; ?>
					<br/>
					<cite title="Source Title"><?php echo $Tarjeta["creador"]["nombre"]; ?></cite>
				</footer>
			</blockquote>
		</div>
	</div>
	<div class="card">
		<div class="row">
		<?php
		if($Salida)
		{
			foreach ($Salida as $info) 
			{
				?>
				<div class="col-12 col-sm-3">
					<button class="btn btn-success" onclick="obj.mostrar(<?php echo $info["id"]; ?>);">
						Pendientes
				  	</button>
					<div style="display: none" id="collapseExample<?php echo $info["id"]; ?>">
						<div class="card">
							<table class="table mb-0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">PENDIENTE</th>
									</tr>
								</thead>
								<tbody>
								<?php
								if($Salida)
								{
									foreach ($info["datos"] as $datos) 
									{
										if($datos["terminado"] == 0)
										{
								?>
									<tr>
										<th scope="row"><?php echo $datos["orden"]; ?></th>
										<td><?php echo $datos["descripcion"]; ?></td>
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
					<div id="grafico<?php echo $info["id"]; ?>">
						grafico<?php echo $info["id"]; ?>
					</div>
				</div>
				<?php
			}
		}
		?>
		</div>
	</div>
</div>
<?php 
    #echo "<pre>"; print_r($Tarjeta); echo "</pre>";
    #echo "<pre>"; print_r($Salida); echo "</pre>";
?>
<script src="<?php echo base_url('js/highcharts/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('js/highcharts/modules/series-label.js'); ?>"></script>
<script src="<?php echo base_url('js/highcharts/modules/exporting.js'); ?>"></script>
<script src="<?php echo base_url('js/highcharts/modules/export-data.js'); ?>"></script>
<script type="text/javascript">
let Tarjeta =<?php echo json_encode($Tarjeta); ?>;
<?php
if($Salida)
{
	foreach ($Salida as $info) 
	{
		?>
		var id = `<?php echo $info["id"]; ?>`;
		var textFecha = `<?php echo $info["fecha"]; ?>`;
		var Eventos =<?php echo json_encode($info['datos']); ?>;
		var bajada = [];
		var adelantos = [];
		var totalSprint = parseInt(Tarjeta.sprint);

		var x;
		for (x = parseInt(Tarjeta.sprint); x >= 0; x--) { 
			bajada.push(x);
		}
		adelantos.push(parseInt(Tarjeta.sprint));
		Eventos.map(v=>{
			if(parseInt(v.terminado) === 1)
			{
				totalSprint = totalSprint - parseInt(v.sprint);
			}
			if(parseInt(v.sprint) === 1)
			{
				adelantos.push(totalSprint);
			}
			else
			{
				for (x = parseInt(v.sprint); x > 0; x--) { 
					adelantos.push(totalSprint);
				}
			}

		});
		
		Highcharts.chart(`grafico${id}`, {
			chart: {
				//type: 'spline',
				//height:"20%",
				//width:"100%",
				scrollablePlotArea: {
					//minWidth: 700,
					scrollPositionX: 1
				}
			},
			title: {
				text: textFecha
			},
			subtitle: {
				text:  `${Tarjeta.titulo} - ${Tarjeta.categoria.nombre}`
			},
			xAxis: {
				type: 'number',
				labels: {
					overflow: 'justify'
				}
			},
			yAxis: {
				tickWidth: 1,
				title: {
				  text: 'Puntos'
				},
				lineWidth: 1,
				//opposite: true
			},
			tooltip: {
				valueSuffix: '',
				split: true
			},
			plotOptions: {
				spline: {
					lineWidth: 4,
					states: {
						hover: {
							//lineWidth: 5
						}
					},
					marker: {
						//enabled: false
					},
					pointInterval: 1, // one hour
					pointStart: Date.UTC(2015, 4, 31, 0, 0, 0)
				}
			},
			series: [{
				name: 'SPRINT',
				data: bajada
			}, {
				name: 'ADELANTOS',
				data: adelantos
			}]
		});
<?php
	}
}
?>
let obj ={
	mostrar:id =>{
		$(`#collapseExample${id}`).toggle(`slow`);
	}
};
</script>