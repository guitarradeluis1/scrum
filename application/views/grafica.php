<!--div id="grafico"></div-->
<?php #echo "<pre>"; print_r($Eventos); echo "</pre>"; ?>
<?php #echo "<pre>"; print_r($Tarjeta); echo "</pre>"; ?>
<script src="<?php echo base_url('js/highcharts/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('js/highcharts/modules/series-label.js'); ?>"></script>
<script src="<?php echo base_url('js/highcharts/modules/exporting.js'); ?>"></script>
<script src="<?php echo base_url('js/highcharts/modules/export-data.js'); ?>"></script>
<script type="text/javascript">
let Tarjeta =<?php echo json_encode($Tarjeta); ?>;
let Eventos =<?php echo json_encode($Eventos); ?>;	
let bajada = [];
let adelantos = [];
let totalSprint = parseInt(Tarjeta.sprint);

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

Highcharts.chart('grafico', {
	chart: {
		//type: 'spline',
		//height:"20%",
		//width:"100%",
		scrollablePlotArea: {
			//minWidth: 700,
			//scrollPositionX: 1
		}
	},
	title: {
		text: Tarjeta.titulo
	},
	subtitle: {
		text: Tarjeta.categoria.nombre
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
</script>