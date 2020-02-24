<div id="body">
	<?php echo anchor("inicio/", "Atras", "class='btn btn-dark my-1'"); ?>
	<div class="container">
		<div class="card">
			<form class="form-inline">
				<div class="form-group mx-sm-3 mb-2">
					<label for="texto" class="sr-only">Fecha Inicio</label>
					<?php echo form_input(array("name" => "fechaInicio", "id" => "fechaInicio", "placeholder" => "fecha Inicio", "type" => "date", "class"=>"form-control form-control-sm")); ?>
				</div>
				<div class="form-group mx-sm-3 mb-2">
					<label for="texto" class="sr-only">Fecha Fin</label>
					<?php echo form_input(array("name" => "fechaFin", "id" => "fechaFin", "placeholder" => "fecha Fin", "type" => "date", "class"=>"form-control form-control-sm")); ?>
				</div>
				<button onclick="obj.buscar()" type="button" class="btn btn-info mb-2">Buscar</button>
			</form>
		</div>
		<div class="card" id="div_consulta">
		</div>
	</div>
</div>
<script>
let obj= {
	htmlLoader: `<div class="progress">
	  <div class="progress-bar progress-bar-indeterminate" role="progressbar"></div>
	</div>`,
	buscar: () => {
		$("#div_consulta").html(obj.htmlLoader);
		let texto = $("#texto").val();
		let fechaInicio = $(`#fechaInicio`).val();
		let fechaFin = $(`#fechaFin`).val();
	 	$("#div_consulta").load(`../reporte/buscar/${fechaInicio}/${fechaFin}`, function(){});
  	},
};
</script>
<?php #echo "<pre>"; print_r($Salida); echo "</pre>"; ?>