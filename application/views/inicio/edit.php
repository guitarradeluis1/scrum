<div id="body">
<?php echo anchor($controlador."/index", "Atras.", "class='btn btn-outline-danger'"); ?>
<?php echo anchor("eventos/index/".$Salida["id"], "Eventos", "class='btn btn-outline-danger'"); ?>
<?php echo form_open($controlador."/".$funcion."/".$Salida["id"], "id=formulario"); ?>
<?php echo form_hidden('id', $Salida["id"]); ?>
<div class="card">
	<div class="card-body">
		<table>
		<tr>
			<td>
				<p><b>Titulo : </b><br /> 
				<?php echo form_input(array("name" => "titulo", "id" => "titulo", "placeholder" => "titulo", "type" => "text", "value" => $Salida["titulo"], "class"=>"form-control form-control-sm")); ?>
				</p>
			</td>
			<td>
				<p><b>Semana : </b><br /> 
				<?php echo form_input(array("name" => "semana", "id" => "semana", "placeholder" => "semana", "type" => "week", "value" => $Salida["semana"], "class"=>"form-control form-control-sm")); ?>
				</p>
			</td>
			<td>
				<p><b>Prioridad : </b><br /> 
				<?php echo form_input(array("name" => "prioridad", "id" => "prioridad", "placeholder" => "prioridad", "type" => "number", "value" => $Salida["prioridad"], "class"=>"form-control form-control-sm")); ?>
				</p>
			</td>
		</tr>
		<tr>
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
			<td>
				<p><b>Posicion : </b><br />
					<select id="posicion" name="posicion" class="form-control form-control-sm">
						<option value="1">Pendiente</option>
						<option value="2">En desarrollo</option>
						<option value="3">Terminado</option>
						<option value="4">Cerrado</option>
					</select>
				<?php #echo creador_selector('creador_selector_id', array("is","23"), 'form');#echo creador_selector_id("name", {1:"uno","luis"}); ?>
				</p>
			</td>
		</tr>
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
				<p><b>Categoria : </b><br />
					<select id="categoria_id" name="categoria_id" class="form-control form-control-sm">
						<?php
						if($categorias)
						{
							foreach ($categorias as $info) 
							{
								?><option value="<?php echo $info["id"]; ?>"><?php echo $info["nombre"]; ?></option><?php
							}
						}
						?>
					</select>
				</p>
			</td>
			<td>
				<p><b>Visible : </b><br />
					<select id="visible" name="visible" class="form-control form-control-sm">
						<option value="1">si</option>
						<option value="0">no</option>
					</select>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p><b>Quien : </b><br /> 
				<?php 
					$data = array(
					  'name'        => "quien",
					  'id'          => "quien",
					  'value'       => $Salida["quien"],
					  "placeholder" => "quien",
					  'rows'        => '10',
					  'cols'        => '120',
					  'style'       => 'width:80%'
					);
					echo form_textarea($data);
				?>
				</p>
			</td>
			<td>
				<p><b>Que : </b><br /> 
				<?php 
					$data = array(
					  'name'        => "que",
					  'id'          => "que",
					  'value'       => $Salida["que"],
					  "placeholder" => "que",
					  'rows'        => '10',
					  'cols'        => '120',
					  'style'       => 'width:80%'
					);
					echo form_textarea($data);
				?>
				</p>
			</td>
			<td>
				<p><b>Para que : </b><br /> 
				<?php 
					$data = array(
					  'name'        => "para_que",
					  'id'          => "para_que",
					  'value'       => $Salida["para_que"],
					  "placeholder" => "Para que",
					  'rows'        => '10',
					  'cols'        => '120',
					  'style'       => 'width:80%'
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
	</div>
</div>
</div>
<?php #echo "<pre>"; print_r($credores); echo "</pre>"; ?>
<script>
jQuery(document).ready(function()
{
	$("#posicion").val(<?php echo $Salida["posicion"]; ?>);
	$("#creador_id").val(<?php echo $Salida["creador_id"]; ?>);
	$("#categoria_id").val(<?php echo $Salida["categoria_id"]; ?>);
	$("#visible").val(<?php echo $Salida["visible"]; ?>);
	ClassicEditor.create( document.querySelector( '#quien' ), {
		// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
	} )
	.then( editor => {
		window.editor = editor;
	} )
	.catch( err => {
		console.error( err.stack );
	} );
	ClassicEditor.create( document.querySelector( '#que' ), {
		// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
	} )
	.then( editor => {
		window.editor = editor;
	} )
	.catch( err => {
		console.error( err.stack );
	} );
	ClassicEditor.create( document.querySelector( '#para_que' ), {
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
            descripcion : "required"
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