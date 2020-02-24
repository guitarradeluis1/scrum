<div id="body">
	<?php echo anchor($controlador."/vista/".$Salida["id"], "Atras", "class='btn btn-dark my-1'"); ?>
	<div class="card">
		<div class="card-body">
			<blockquote class="blockquote mb-0">
				<p><?php echo $Salida["nombre"];?></p>
				<footer class="blockquote-footer">
					<b>Fechas:</b> <?php echo $Salida["inicio"]." ".$Salida["fin"]; ?><br/>
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
	</div>
	<div class="card">
		<form class="form-inline">
			<div class="form-group mx-sm-3 mb-2">
				<label for="texto" class="sr-only">Burcar</label>
				<input type="text" class="form-control" id="texto" placeholder="...">
			</div>
			<button onclick="obj.buscar()" type="button" class="btn btn-info mb-2">Buscar</button>
		</form>
	</div>
	<div class="card" id="div_consulta">

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
		let id = <?php echo $Salida["id"]; ?>;
	 	$("#div_consulta").load(`../../inicio/buscar/${texto}/${id}`, function(){});
  	},
};
</script>

<?php
    #echo "<pre>"; print_r($Salida); echo "</pre>";
    #echo "<pre>"; print_r($Tareas); echo "</pre>";
?>