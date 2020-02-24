<div id="body">
	<?php echo anchor("eventos/index/".$Eventos["targeta"]["id"], "Atras", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor("eventos/edit/".$Eventos["id"], "Editar Evento", "class='btn btn-dark my-1'"); ?>
	<?php echo anchor($controlador."/add/".$Eventos["id"], "Nuevo Hacer", "class='btn btn-dark my-1'"); ?>
	<button class="btn btn-success" onclick="obj.mostrar();">
		Datos del Evento
	</button>
	<div class="card">
		<div class="card-body" style="display: none" id="collapse">
			<blockquote class="blockquote mb-0">
				<p><?php echo $Eventos["descripcion"];?></p>
				<footer class="blockquote-footer">
					<b>Targeta:</b> <?php echo $Eventos["targeta"]["titulo"]; ?><br/>
					<cite title="Source Title"><?php echo $Eventos["creador"]["nombre"]; ?></cite>
				</footer>
			</blockquote>
		</div>
	</div>
	<div class="container">
		<table class="table">
		  <thead class="thead-light">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">FECHA</th>
			  <th scope="col">CREADOR</th>
			  <th scope="col">TEXTO</th>
			  <th scope="col">TERMINADO</th>
			  <th></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			if($Hacer)
			{
				foreach ($Hacer as $info) 
				{
					$info["texto"] = str_replace("<blockquote>", '<div class="alert alert-light border border-success" role="alert">', $info["texto"]);
					$info["texto"] = str_replace("</blockquote>", '</div>', $info["texto"]);
				?>
				<tr>
					<th scope="row"><?php echo $info["id"]; ?></th>
					<td><?php echo $info["fecha"]; ?></td>
					<td><?php echo $info["creador"]["nombre"]; ?></td>
					<td><?php
					if(strlen($info["texto"])>600)
					{
						?>
						<button class="btn btn-dark btn-sm btnMuestra<?php echo $info["id"]; ?>" onclick="obj.mostrarMas(<?php echo $info["id"]; ?>);">
							Cambiar tamaño
						</button>
						<div class="card">
							<div class="card-body" style="display: none" id="collapseMas<?php echo $info["id"]; ?>">
								<?php echo $info["texto"]; ?>
							</div>
						</div>
						<div class="card">
							<div class="card-body" style="display: show" id="collapseMenos<?php echo $info["id"]; ?>">
								<?php echo substr($info["texto"], 0, 600)."<br/><b>Continua...</b>"; ?>
							</div>
						</div>
						<button class="btn btn-dark btn-sm btnMuestra<?php echo $info["id"]; ?>" onclick="obj.mostrarMas(<?php echo $info["id"]; ?>);">
							Cambiar tamaño
						</button>
						<?php
					}
					else
					{echo $info["texto"]; }
					?></td>
					<td><b>
						<?php
						if($info["terminado"] == 0){echo "<p class='text-success'>Pendiente</p>";}
						else {echo "Terminado";}
						?></b>
					</td>
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
<script type="text/javascript">
let obj ={
	mostrar:()=>{
		$(`#collapse`).toggle(`slow`);
	},
	mostrarMas:id=>{
		$(`#collapseMenos${id}`).toggle(`slow`);
		$(`#collapseMas${id}`).toggle(`slow`);
	}
};
</script>
<?php #echo "<pre>"; print_r($Eventos); echo "</pre>"; ?>
<?php #echo "<pre>"; print_r($Hacer); echo "</pre>"; ?>