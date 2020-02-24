<div id="body">
<?php echo anchor($controlador."/index/".$eventos_id, "Atras.", "class='btn btn-outline-danger'"); ?>
<?php echo form_open($controlador."/".$funcion."/".$eventos_id, "id=formulario"); ?>
<?php echo form_hidden('eventos_id', $eventos_id); ?>
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
					<?php echo form_input(array("name" => "fecha", "id" => "fecha", "placeholder" => "fecha", "type" => "date", "class"=>"form-control form-control-sm")); ?>
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
					  'value'       => '',
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