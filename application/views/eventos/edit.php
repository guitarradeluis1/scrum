<div id="body">
<?php echo anchor($controlador."/index/".$Salida["targeta_id"], "Atras.", "class='btn btn-outline-danger'"); ?>
<?php echo form_open($controlador."/".$funcion."/".$Salida["id"], "id=formulario"); ?>
<?php echo form_hidden('id', $Salida["id"]); ?>
<?php echo form_hidden('targeta_id', $Salida["targeta_id"]); ?>
	<div class="card">
		<div class="card-body">
			<table>
			<tr>
				<td>
					<p><b>Orden : </b><br /> 
					<?php echo form_input(array("name" => "orden", "id" => "orden", "placeholder" => "orden", "type" => "number", "value" => $Salida["orden"], "class"=>"form-control form-control-sm")); ?>
					</p>
				</td>
				<td>
					<p><b>Puntos : </b><br /> 
					<?php echo form_input(array("name" => "puntos", "id" => "puntos", "placeholder" => "puntos", "type" => "number", "value" => $Salida["puntos"], "class"=>"form-control form-control-sm")); ?>
					</p>
				</td>
				<td>
					<p><b>Sprint : </b><br /> 
					<?php echo form_input(array("name" => "sprint", "id" => "sprint", "placeholder" => "sprint", "type" => "number", "value" => $Salida["sprint"], "class"=>"form-control form-control-sm")); ?>
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p><b>Estado : </b><br /> 
					<select name="terminado" id="terminado" class="form-control form-control-sm">
						<option value="0">Pendiente</option>
						<option value="1">Terminado</option>
					</select>
					</p>
				</td>
				<td>
					<p><b>Semana : </b><br /> 
					<?php echo form_input(array("name" => "semana", "id" => "semana", "placeholder" => "semana", "type" => "week", "value" => $Salida["semana"], "class"=>"form-control form-control-sm")); ?>
					</p>
				</td>
				<td>
					<p><b>Creador : </b><br />
					<select id="creador_id" name="creador_id" class="form-control form-control-sm">
						<?php
						if($credores)
						{
							foreach ($credores as $info) 
							{
								?><option value="<?php echo $info["id"]; ?>"><?php echo $info["nombre"]; ?></option><?php
							}
						}
						?>
					</select>
				</p>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<p><b>Descripci&oacute;n : </b><br /> 
					<?php 
					$data = array(
					  'name'        => "descripcion",
					  'id'          => "descripcion",
					  'value'       => $Salida["descripcion"],
					  "placeholder" => "descripcion",
					  'rows'        => '10',
					  'cols'        => '80',
					  'style'       => 'width:100%'
					);
					echo form_textarea($data);
					?>
					</p>
				</td>
			</tr>
			</table>
			<?php echo form_submit("post", "Enviar", "class='btn btn-success'"); ?>
			<?php echo form_close(); ?>
			<br />
			<?php #echo anchor('usuario/', 'Ingresar', array('title' => 'Ingresa a Yuno!')); ?>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function()
{
	$("#terminado").val(<?php echo $Salida["terminado"]; ?>);
	$("#creador_id").val(<?php echo $Salida["creador_id"]; ?>);
	$("#terminado").val(<?php echo  $Salida["terminado"]; ?>);
	ClassicEditor.create( document.querySelector( '#descripcion' ), {
		// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
	} )
	.then( editor => {
		window.editor = editor;
	} )
	.catch( err => {
		console.error( err.stack );
	} );
  //.................................
    $("#formulario").validate({
        // Specify the validation rules
        rules: {
            nombre: "required",
            descripcion : "required",
            estimado : "required",
        },
        
        // Specify the validation error messages
        messages: {  
            
        },
        
        submitHandler: function(form){
            form.submit();
        }
    });
    //.................................
});
</script>