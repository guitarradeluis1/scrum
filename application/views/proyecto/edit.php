<div id="body">
<?php echo anchor($controlador."/index", "Atras.", "class='btn btn-outline-danger'"); ?>
<?php echo form_open($controlador."/".$funcion, "id=formulario"); ?>
<?php echo form_hidden('id', $Salida["id"]); ?>
<div class="card">
	<div class="card-body">
		<table>
		<tr>
			<td>
				<p><b>Nombre : </b><br /> 
				<?php echo form_input(array("name" => "nombre", "id" => "nombre", "placeholder" => "nombre", "type" => "text", "value" => $Salida["nombre"], "class"=>"form-control form-control-sm")); ?>
				</p>
			</td>
			<td>
				<p><b>Inicio : </b><br /> 
				<?php echo form_input(array("name" => "inicio", "id" => "inicio", "placeholder" => "inicio", "type" => "date", "value" => $Salida["inicio"], "class"=>"form-control form-control-sm")); ?>
				</p>
			</td>
			<td>
				<p><b>Fin : </b><br /> 
				<?php echo form_input(array("name" => "fin", "id" => "fin", "placeholder" => "fin", "type" => "date", "value" => $Salida["fin"], "class"=>"form-control form-control-sm")); ?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p><b>Prioridad : </b><br />
					<select id="prioridad" name="prioridad" class="form-control form-control-sm">
						<option value="0">Pendiente</option>
						<option value="1">Alta</option>
						<option value="2">Media</option>
						<option value="3">Baja</option>
					</select>
				</p>
			</td>	
		</tr>
		</table>
		<?php echo form_submit("post", "Enviar", "class='btn btn-success'"); ?>
		<?php echo form_close(); ?>
		<br />
	</div>
</div>
</div>
<?php #echo "<pre>"; print_r($credores); echo "</pre>"; ?>
<script>
jQuery(document).ready(function()
{
	$("#prioridad").val(<?php echo $Salida["prioridad"]; ?>);
  	//.................................
    $("#formulario").validate({
        // Specify the validation rules
        rules: {
            nombre: "required"
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