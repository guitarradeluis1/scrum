<div id="body">
<?php echo anchor($controlador."/index/".$Salida["eventos_id"], "Atras.", "class='btn btn-outline-danger'"); ?>
<?php echo form_open($controlador."/".$funcion."/".$Salida["id"], "id=formulario"); ?>
<?php echo form_hidden('id', $Salida["id"]); ?>
	<div class="card">
		<div class="card-body">
			<table>
			<tr>
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
				<td>
					<p><b>Fecha : </b><br /> 
					<?php echo form_input(array("name" => "fecha", "id" => "fecha", "placeholder" => "fecha", "type" => "date", "value" => $Salida["fecha"], "class"=>"form-control form-control-sm")); ?>
					</p>
				</td>
				<td>
					<p><b>Estado : </b><br /> 
					<select name="terminado" id="terminado" class="form-control form-control-sm">
						<option value="0">Pendiente</option>
						<option value="1">Terminado</option>
					</select>
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<p><b>Descripci&oacute;n : </b><br /> 
					<?php 
					$data = array(
					  'name'        => "texto",
					  'id'          => "texto",
					  'value'       => $Salida["texto"],
					  "placeholder" => "texto",
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
			<div class="custom-control custom-switch">
				<input class="custom-control-input" id="retorno" name="retorno" type="checkbox">
				<span class="custom-control-track"></span>
				<label class="custom-control-label" for="retorno">Solo guardar datos</label>
			</div>
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
	$("#creador_id").val(<?php echo  $Salida["creador_id"]; ?>);
	$("#terminado").val(<?php echo  $Salida["terminado"]; ?>);
	ClassicEditor.create( document.querySelector( '#texto' ), {
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